class HomeController < ApplicationController
  def index
    @projects = Project.order('created_at desc').limit(2).decorate
  end
end

