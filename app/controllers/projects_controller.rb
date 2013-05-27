class ProjectsController < ApplicationController
  before_filter :find_project, except: :index

	def index
		@projects = Project.paginate(:page => params[:page])
	end

  def show
    @comment = Comment.new
  end

  def image
    send_data @project.image.file.file.data
  end

  private

  def find_project
    @project = Project.find(params[:id])
  end
end

