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
    render :json => current_user.to_json(methods: :profile_image)
  end

  def unfollow
    current_user.stop_following(@project)
    render :json => current_user
  end

  private

  def find_project
    @project = Project.find(params[:id])
  end
end
