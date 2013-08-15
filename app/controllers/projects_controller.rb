class ProjectsController < ApplicationController
  before_filter :find_project, except: :index
  before_filter :authenticate_user!, only: [:follow, :unfollow]

	def index
    @projects = ProjectsDecorator.decorate(Project.page(params[:page]))
	end

  def show
    @project = @project.decorate
  end

  def follow
    current_user.follow(@project)
    @project.create_activity 'following', owner: current_user
    current_user.create_activity 'following', owner: @project
    render :nothing => true
  end

  def unfollow
    current_user.stop_following(@project)
    render :nothing => true
  end

  private

  def find_project
    @project = Project.find(params[:id])
  end
end
