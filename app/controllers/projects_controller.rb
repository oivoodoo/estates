class ProjectsController < ApplicationController
	def index
		@projects = Project.all
		@projects = Project.paginate(:page => params[:page])
	end
end
