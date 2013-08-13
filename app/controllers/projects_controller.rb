class ProjectsController < ApplicationController
  before_filter :find_project, except: :index

	def index
    @projects = ProjectsDecorator.decorate(Project.page(params[:page]))
	end

  def show
  end

  def follow
    @project = Project.find(params[:id])
    @project.followed_by!(current_user)
    redirect_to action: :show
  end

  def unfollow
    @project = Project.find(params[:id])
    @project.unfollow!(current_user)
    redirect_to action: :show
  end

  private

  def find_project
    @project = Project.find(params[:id]).decorate
  end
end
