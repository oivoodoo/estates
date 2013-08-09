class User < ActiveRecord::Base
  acts_as_messageable :required => [:body, :topic], dependent: :destroy

  devise :database_authenticatable, :registerable,
    :recoverable, :rememberable, :trackable, :validatable,
    :omniauthable, :omniauth_providers => [:facebook, :google_oauth2, :linkedin]

  attr_accessor :current_password

  validates :email, :status, presence: true

  has_many :authentications

  has_many :comments

  has_many :followers
  has_many :projects, through: :followers

  scope :recent, lambda { |count| order('users.created_at desc').limit(count) }

  mount_uploader :avatar, AvatarUploader

  def role?(r)
    self.role.to_s == r.to_s
  end

  def self.find_for_facebook(auth)
    user = Authentication.find_user_by_auth(auth)

    return user if user.present?

    create_user_by_auth(auth,
      social_avatar_url: "http://graph.facebook.com/#{auth.uid}/picture?type=large",
      name: auth.extra['raw_info']['name'],
      email: auth.info["email"])
  end

  def self.find_for_google(auth)
    user = Authentication.find_user_by_auth(auth)

    return user if user.present?

    create_user_by_auth(auth,
      social_avatar_url: auth.info['image'],
      name: auth.info["name"],
      email: auth.info["email"])
  end

  def self.find_for_linkedin(auth)
    user = Authentication.find_user_by_auth(auth)

    return user if user.present?

    create_user_by_auth(auth,
      social_avatar_url: auth.info['image'],
      name: auth.info["name"],
      email: auth.info["email"])
  end

  def self.create_user_by_auth(auth, attributes)
    user = User.find_by(email: auth.info['email'])

    unless user.present?
      user = User.create(attributes.merge(password: Devise.friendly_token[0,20]))
    end

    if user.persisted?
      user.authentications.create(provider: auth.provider, uid: auth.uid, email: auth.info['email'])
      user
    end
  end

  def profile_image
    if avatar?
      avatar.url(:thumb)
    elsif social_avatar_url?
      social_avatar_url
    else
      "default_avatar.png"
    end
  end

  def name
    "#{first_name} #{last_name} #{middle_name}".strip
  end

  #"James Bond Petrovich"
  def name=(full_name)
    names = full_name.to_s.split(/ /)
    self.first_name  = names[0]
    self.last_name   = names[1]
    self.middle_name = names[2]
  end
end

