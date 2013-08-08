class ProjectsSearchController < ApplicationController
  layout false

  def index
    @projects = Project.search(params[:query]).page(params[:page])
    @projects = ProjectsDecorator.decorate(@projects)
    render 'projects/index'
  end
end

