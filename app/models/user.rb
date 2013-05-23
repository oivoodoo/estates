class User < ActiveRecord::Base
  devise :database_authenticatable, :registerable,
    :recoverable, :rememberable, :trackable, :validatable,
    :omniauthable, :omniauth_providers => [:facebook, :google_oauth2]

  # Setup accessible (or protected) attributes for your model
  attr_accessible :name, :email, :password, :password_confirmation, :remember_me, :provider, :uid

  validates :name, presence: true

  has_many :authentications

  def role?(r)
    self.role == r
  end

  def self.find_for_facebook(auth)
    user = Authentication.find_user_by_auth(auth)

    return user if user.present?

    create_user_by_auth(auth, name: auth.extra['raw_info']['name'], email: auth.info["email"])
  end

  def self.find_for_google(auth)
    user = Authentication.find_user_by_auth(auth)

    return user if user.present?

    create_user_by_auth(auth, name: auth.info["name"], email: auth.info["email"])
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
end

