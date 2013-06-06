class Admin::MessagesController < AdminController
  def create
    @user = User.find(params[:user_id])
    @message = @user.messages.create(params[:message])

    unless @message.save
      flash.now[:error] = @message.errors.full_messages
    end
      redirect_to admin_users_path, notice: "Message was sent"
  end
end
