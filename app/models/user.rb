class User < ActiveRecord::Base
  devise :database_authenticatable, :registerable,
    :recoverable, :rememberable, :trackable, :validatable,
    :omniauthable, :omniauth_providers => [:facebook, :google_oauth2]

  # Setup accessible (or protected) attributes for your model
  attr_accessible :name, :email, :password, :password_confirmation, :remember_me, :provider, :uid

  validates :name, presence: true

  def role?(r)
    self.role == r
  end

  def self.find_for_facebook(auth)
    user = User.find_by(provider: auth.provider, uid: auth.uid)

    unless user
      user = User.create(
        name:     auth.extra['raw_info']['name'],
        provider: auth.provider,
        uid:      auth.uid,
        email:    auth.info['email'],
        password: Devise.friendly_token[0,20]
      )
    end

    user
  end

  def self.find_for_google(auth)
    user = User.find_by(provider: auth.provider, uid: auth.uid)

    unless user
      user = User.create(
        name:     auth.info["name"],
        email:    auth.info["email"],
        provider: auth.provider,
        uid:      auth.uid,
        password: Devise.friendly_token[0,20]
      )
    end

    user
  end
end

