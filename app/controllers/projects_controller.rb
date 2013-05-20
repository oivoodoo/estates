class ProjectsController < ApplicationController
	def index
		@projects = Project.all
		@projects = Project.paginate(:page => params[:page], :per_page => 6)
	end
end
