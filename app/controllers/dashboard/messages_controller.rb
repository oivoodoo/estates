class Dashboard::MessagesController < DashboardController
  def index
    @messages = current_user.messages
  end

  def show
    @message = current_user.messages.find(params[:id])
    @message.open
  end
end
