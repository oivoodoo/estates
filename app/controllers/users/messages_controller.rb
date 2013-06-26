class Users::MessagesController < ApplicationController
  def create
    @user = User.find(params[:user_id])
    current_user.send_message(@user, params[:message])
    MessageMailer.user_messages(@user).deliver

    redirect_to @user, notice: "Message was sent"
  end
end
