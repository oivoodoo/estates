class ProjectsController < ApplicationController
  before_filter :find_project, except: :index
  before_filter :authenticate_user!, only: [:follow, :unfollow]

	def index
    @projects = ProjectsDecorator.decorate(Project.page(params[:page]))
	end

  def show
    @project = @project.decorate
    @activities = @project.activities.includes(:owner).includes(:trackable).order('created_at desc').limit(7).load
    @investors = @project.investors.load # scope
    @followers = @project.followers # array
  end

  def follow
    current_user.follow(@project)
    @project.create_activity 'user_following', owner: current_user
    current_user.create_activity 'project_following', owner: @project
    render :json => current_user.to_json(only: :id, methods: [:name, :profile_image])
  end

  def unfollow
    current_user.stop_following(@project)
    render :json => current_user.to_json(only: :id)
  end

  private

  def find_project
    @project = Project.includes(:investors).find(params[:id])
  end
end
