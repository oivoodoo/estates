class ProjectsController < ApplicationController
  before_filter :find_project, except: :index
  before_filter :authenticate_user!, only: [:follow, :unfollow]

	def index
    @projects = ProjectsDecorator.decorate(Project.page(params[:page]))
	end

  def show
  end

  def follow
    current_user.follow(@project)
    render :nothing => true
  end

  def unfollow
    current_user.stop_following(@project)
    render :nothing => true
  end

  private

  def find_project
    @project = Project.find(params[:id]).decorate
  end
end
