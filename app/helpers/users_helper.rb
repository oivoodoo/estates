module UsersHelper
  def profile_user_json(user)
    user.to_json(only: [:short_bio, :title, :first_name, :last_name, :middle_name, :facebook_link, :twitter_link, :google_plus_link, :linkedin_link])
  end
end

