class Admin::UsersController < AdminController
  inherit_resources

  before_filter :build_message, only: :show

  private

  def build_message
    @message = current_user.messages.build
  end
end
