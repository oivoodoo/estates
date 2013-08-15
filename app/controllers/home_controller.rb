class HomeController < ApplicationController
  def index
    @projects = Project.order('created_at desc').limit(10).decorate
  end
end

