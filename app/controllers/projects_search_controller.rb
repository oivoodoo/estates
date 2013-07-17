class ProjectsSearchController < ApplicationController
  layout false

  def index
    @projects = Project.search(params[:query]).page(params[:page])
    render 'projects/index'
  end
end

