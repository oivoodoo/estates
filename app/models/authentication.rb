class Authentication < ActiveRecord::Base
  belongs_to :user

  validates :provider, :uid, :email, :user_id, presence: true

  def self.find_user_by_auth(auth)
    authentication = find_by(provider: auth.provider, uid: auth.uid, email: auth.info['email'])
    authentication.try(:user)
  end
end

