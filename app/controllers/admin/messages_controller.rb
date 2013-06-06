class Admin::MessagesController < AdminController
  def create
    @user = User.find(params[:user_id])
    @message = @user.messages.create(params[:message])

    if @message.save
      redirect_to admin_users_path, notice: "Message was sent"
    else
      flash[:notice] = "Something went wrong."
    end
  end
end
