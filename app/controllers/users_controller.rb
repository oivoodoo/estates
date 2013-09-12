class UsersController < ApplicationController
  before_filter :find_user

  def show
    @followers = @user.followers
  end

  def follow
    current_user.follow(@user)
    current_user.create_activity 'user_following', owner: @user
    @user.create_activity 'user_followed_by', owner: current_user
    render :json => current_user.to_json(only: :id, methods: [:name, :profile_image])
  end

  def unfollow
    current_user.stop_following(@user)
    render :json => current_user.to_json(only: :id)
  end

  private

  def find_user
    @user = User.find(params[:id])
  end
end

