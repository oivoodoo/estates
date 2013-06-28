class ProjectsController < ApplicationController
  before_filter :find_project, except: :index

	def index
		@projects = Project.paginate(page: params[:page])
	end

  def show
    @comment = Comment.new
    @comments = @project.comments.all.map(&:decorate)
    @followers = @project.users
  end

  def image
    send_data @project.image.file.file.data
  end

  def follow
    @project = Project.find(params[:id])
    @project.followed_by!(current_user)
    redirect_to action: :show
  end

  private

  def find_project
    @project = Project.find(params[:id])
  end
end
