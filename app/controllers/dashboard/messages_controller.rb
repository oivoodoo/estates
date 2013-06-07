class Dashboard::MessagesController < DashboardController
  def index
    @messages = current_user.messages
  end
end