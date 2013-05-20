class ProjectsController < ApplicationController
	def index
		@projects = Project.paginate(:page => params[:page])
	end

	def project_params
		params.require(:project).permit(:name, :price, :owner, :description)
	end
end
