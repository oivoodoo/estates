module UsersHelper
  def profile_user_json(user)
    json = user.as_json(only: [:id, :facebook_link, :twitter_link, :google_plus_link, :linkedin_link], methods: :profile_image)
    json['followed'] = current_user.following?(user)
    json.to_json
  end

  def profile_user_button_urls_json(user)
    {
      follow: follow_user_path(user),
      unfollow: unfollow_user_path(user)
    }.to_json
  end

  def followers_json(followers)
    followers.to_json(only: :id, methods: [:name, :profile_image])
  end
end

