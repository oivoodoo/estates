class UsersController < ApplicationController
  before_filter :find_messages, only: :show
  before_filter :find_user

  def show
  end

  def follow
    current_user.follow(@user)
    render :nothing => true
  end

  def unfollow
    current_user.stop_following(@user)
    render :nothing => true
  end

  private

  def find_messages
    @messages = current_user.messages
  end

  def find_user
    @user = User.find(params[:id])
  end
end

