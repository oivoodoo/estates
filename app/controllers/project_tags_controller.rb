class ProjectTagsController < ApplicationController
  def index
    @projects = unless params[:tag].blank?
      Project.tagged_with(params[:tag]).paginate(page: params[:page])
    else
      Project.paginate(page: params[:page])
    end

    render 'projects/index'
  end
end
