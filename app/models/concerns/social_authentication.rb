module SocialAuthentication
  extend ActiveSupport::Concern

  module ClassMethods
    def find_for_facebook(user, auth)
      user = user || Authentication.find_user_by_auth(auth)

      link = auth.info['urls']['Facebook']
      image = "http://graph.facebook.com/#{auth.uid}/picture?type=large"

      unless user.present?
        user = create_user_by_auth(auth, name: auth.extra['raw_info']['name'], email: auth.info["email"])
      end

      user.update_attributes(remote_facebook_avatar_url: image, facebook_link: link)

      user
    end

    def find_for_google(user, auth)
      user = user || Authentication.find_user_by_auth(auth)

      link = auth.info['urls']['Google']
      image = auth.info['image']

      unless user.present?
        user = create_user_by_auth(auth, name: auth.info["name"], email: auth.info["email"])
      end

      user.update_attributes(remote_google_plus_avatar_url: image, google_plus_link: link)

      user
    end

    def find_for_linkedin(user, auth)
      user = user || Authentication.find_user_by_auth(auth)

      link = auth.info['urls']['public_profile']
      image = auth.info['image']

      unless user.present?
        user = create_user_by_auth(auth, name: auth.info["name"], email: auth.info["email"])
      end

      user.update_attributes(remote_linkedin_avatar_url: image, linkedin_link: link)

      user
    end

    def create_user_by_auth(auth, attributes)
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

end

