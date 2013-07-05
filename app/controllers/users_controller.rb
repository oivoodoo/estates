class UsersController < ApplicationController
  before_filter :find_messages, only: :show

  def show
    @user = User.find(params[:id])
  end

  private

  def find_messages
    @messages = current_user.messages
  end
end

