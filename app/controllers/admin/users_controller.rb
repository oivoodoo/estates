class Admin::UsersController < AdminController
  inherit_resources

  before_filter :find_messages, only: :show

  private

  def find_messages
    @messages = resource.messages
  end
end
