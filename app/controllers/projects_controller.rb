class ProjectsController < ApplicationController
	def index
		@projects = Project.all
		@projects = Project.paginate(:page => params[:page], :per_page => 6)
	end

	def new 
		@project = Project.new
	end

	def create
		@project = Project.new(params[:project])

		if @project.save
			redirect_to projects_path
		else 
			render :new
		end
	end

	def show 
		@project = Project.find(params[:id])
	end

	def edit
		@project = Project.find(params[:id])
	end

	def update
		@project = Project.find(params[:id])

		if @project.update_attributes(params[:project])
			redirect_to projects_path
		else
			render :edit
		end
	end

	def destroy
    @project = Project.find(params[:id])
    @project.destroy
    
    redirect_to projects_path, :notice => "Project has been deleted"
  end

  def project_params
    params.require(:project).permit(:name, :owner, :price, :description)
  end
end
