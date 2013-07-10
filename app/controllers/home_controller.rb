class HomeController < ApplicationController
  def index
    @projects = Project.all.decorate
    @users = User.where('users.id != ?', current_user).all
  end
end
