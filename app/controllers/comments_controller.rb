class CommentsController < ApplicationController
	def index
    @comments = @project.comments.all
	end

  def create
  	@project = Project.find(params[:project_id])
    @comment = @project.comments.create(params[:comment])
    @comment.user = current_user
    @comment.save

    redirect_to project_path(@project)
  end
end
