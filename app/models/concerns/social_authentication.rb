module SocialAuthentication
  extend ActiveSupport::Concern

  module ClassMethods
    def find_for_facebook(auth)
      user = Authentication.find_user_by_auth(auth)

      link = auth.info['urls']['Facebook']
      if user.present?
        user.facebook_link = link
        user.save
        user
      else
        create_user_by_auth(auth,
          facebook_avatar: "http://graph.facebook.com/#{auth.uid}/picture?type=large",
          name: auth.extra['raw_info']['name'],
          email: auth.info["email"]) do |user|

          user.facebook_link = link
        end
      end
    end

    def find_for_google(auth)
      user = Authentication.find_user_by_auth(auth)

      link = auth.info['urls']['Google']
      if user.present?
        user.google_plus_link = link
        user.save
        user
      else
        create_user_by_auth(auth,
          google_plus_avatar: auth.info['image'],
          name: auth.info["name"],
          email: auth.info["email"]) do |user|

          user.google_plus_link = link
        end
      end
    end

    def find_for_linkedin(auth)
      user = Authentication.find_user_by_auth(auth)

      return user if user.present?

      link = auth.info['urls']['public_profile']
      if user.present?
        user.linkedin_link = link
        user.save
        user
      else
        create_user_by_auth(auth,
          linkedin_avatar: auth.info['image'],
          name: auth.info["name"],
          email: auth.info["email"]) do |user|

          user.linkedin_link = link
        end
      end
    end

    def create_user_by_auth(auth, attributes, &block)
      user = User.find_by(email: auth.info['email'])

      unless user.present?
        user = User.new(attributes.merge(password: Devise.friendly_token[0,20]))
      end

      block.call(user)
      user.save

      if user.persisted?
        user.authentications.create(provider: auth.provider, uid: auth.uid, email: auth.info['email'])
        user
      end
    end
  end

end

