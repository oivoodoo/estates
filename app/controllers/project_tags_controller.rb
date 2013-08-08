class ProjectTagsController < ApplicationController
  def index
    @projects = unless params[:tag].blank?
      Project.tagged_with(params[:tag]).page(params[:page])
    else
      Project.page(params[:page])
    end
    @projects = ProjectsDecorator.decorate(@projects)

    render 'projects/index'
  end
end
