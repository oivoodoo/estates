class Admin::MessagesController < AdminController
  def create
    @user = User.find(params[:user_id])
    current_user.send_message(@user, params[:message])

    redirect_to [:admin, @user], notice: "Message was sent"
  end
end
