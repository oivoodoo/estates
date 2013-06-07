class DashboardController < ApplicationController
  def index
	end

  def message
    @messages = current_user.messages
  end
end
  