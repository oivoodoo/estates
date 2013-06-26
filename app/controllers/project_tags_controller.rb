class ProjectTagsController < ApplicationController
  def index
    @projects = unless params[:tag].blank?
      Project.tagged_with(params[:tag]).all
    else
      Project.all
    end

    render 'project_tags/index'
  end
end
