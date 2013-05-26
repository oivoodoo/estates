class AdminController < ApplicationController
  before_filter :authenticate_user!
  before_filter :check_authorization

  rescue_from CanCan::AccessDenied do |exception|
    redirect_to root_url, alert: exception.message
  end

  def index
  end

  private

  def check_authorization
    authorize!(:manage, :all)
  end
end

