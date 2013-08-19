class UsersController < ApplicationController
  before_filter :find_user

  def show
  end

  def follow
    current_user.follow(@user)
    current_user.create_activity 'user_following', owner: @user
    @user.create_activity 'user_followed_by', owner: current_user
    render :nothing => true
  end

  def unfollow
    current_user.stop_following(@user)
    render :nothing => true
  end

  private

  def find_user
    @user = User.find(params[:id])
  end
end

