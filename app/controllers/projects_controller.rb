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
    render partial: 'projects/follower', locals: { follower: current_user }
  end

  def unfollow
    @project = Project.find(params[:id])
    @project.unfollow!(current_user)
    render partial: 'projects/unfollow'
  end

  private

  def find_project
    @project = Project.find(params[:id]).decorate
  end
end
