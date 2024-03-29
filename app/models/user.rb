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

  def following_projects_ids
    @following_projects_ids ||= following_projects.map(&:id)
  end

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

  def invested_projects_equity
    total = invested_projects.count
    return 0 if total.zero?
    invested_projects.equity.count / total
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
    @profile_image ||= ProfileImage.new(self)
    @profile_image.url
  end

  require 'delegate'

  class ProfileImage < SimpleDelegator
    include ActionView::Helpers::AssetUrlHelper

    attr_reader :user

    def initialize(user)
      @user = user
    end

    def __getobj__
      @user
    end

    def url
      if avatar?
        avatar.url(:thumb)
      elsif facebook_avatar?
        facebook_avatar.url(:thumb)
      elsif google_plus_avatar?
        google_plus_avatar.url(:thumb)
      elsif linkedin_avatar?
        linkedin_avatar.url(:thumb)
      else
        "/images/mart.png"
      end
    end
  end

  def name
    [title.to_s, first_name.to_s, last_name.to_s, middle_name.to_s].map(&:strip).reject(&:blank?).join(' ')
  end

  def name=(full_name)
    names = full_name.to_s.split(/ /)
    self.first_name  = names[0]
    self.last_name   = names[1]
    self.middle_name = names[2]
  end
end

