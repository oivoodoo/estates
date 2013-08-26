class User < ActiveRecord::Base
  acts_as_messageable :required => [:body, :topic], dependent: :destroy

  devise :database_authenticatable, :registerable,
    :recoverable, :rememberable, :trackable, :validatable,
    :omniauthable, :omniauth_providers => [:facebook, :google_oauth2, :linkedin]

  attr_accessor :current_password

  validates :email, :status, presence: true

  has_many :authentications
  has_many :comments

  has_many :investments
  has_many :invested_projects, through: :investments, source: :project, uniq: true

  acts_as_followable
  acts_as_follower

  def investors
    # do not include self
    investments.map(&:project_investors).flatten.uniq - [self]
  end

  def total_invested
    investments.map(&:money).sum
  end

  def total_earnings
    0
  end

  def invested_projects_debt
    total = invested_projects.count
    return 0 if total.zero?
    invested_projects.debt.count / total
  end

  def invested_projects_loan
    total = invested_projects.count
    return 0 if total.zero?
    invested_projects.loan.count / total
  end

  scope :recent, lambda { |count| order('users.created_at desc').limit(count) }

  mount_uploader :avatar, AvatarUploader
  mount_uploader :facebook_avatar, FacebookAvatarUploader
  mount_uploader :linkedin_avatar, LinkedinAvatarUploader
  mount_uploader :google_plus_avatar, GooglePlusAvatarUploader
  mount_uploader :identification_document, IdentificationDocumentUploader

  def role?(r)
    self.role.to_s == r.to_s
  end

  include SocialAuthentication
  include Addressable

  include PublicActivity::Model
  tracked skip_defaults: true

  def profile_image
    return avatar.url(:thumb) if avatar?
    "/images/default_avatar.png"
  end

  def facebook_image
    return facebook_avatar.url(:thumb) if facebook_avatar?
    "/images/default_avatar.png"
  end

  def google_plus_image
    return google_plus_avatar.url(:thumb) if google_plus_avatar?
    "/images/default_avatar.png"
  end

  def linkedin_image
    return linkedin_avatar.url(:thumb) if linkedin_avatar?
    "/images/default_avatar.png"
  end

  def name
    [first_name.to_s, last_name.to_s, middle_name.to_s].map(&:strip).reject(&:blank?).join(' ')
  end

  def name=(full_name)
    names = full_name.to_s.split(/ /)
    self.first_name  = names[0]
    self.last_name   = names[1]
    self.middle_name = names[2]
  end
end

