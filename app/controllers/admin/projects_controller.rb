class Admin::ProjectsController < AdminController
  def index
    @projects = Project.all
  end

  def show
    @project = Project.find(params[:id])
  end

  def new
    @project = Project.new
  end

  def create
    @project = Project.new project_params

    if @project.save
      redirect_to [:admin, @project], flash: { notice: "Project created" }
    else
      render :new, notice: flash.now[:error] = @project.errors.full_messages
    end
  end

  def edit
    @project = Project.find(params[:id])
  end

  def update
    @project = Project.find(params[:id])
    if @project.update_attributes(project_params)
      redirect_to [:admin, @project], flash: { notice: "Project updated" }
    else
      render :edit, notice: flash.now[:error] = @project.errors.full_messages
    end
  end

  def destroy
    @project = Project.find(params[:id])
    @project.destroy

    redirect_to admin_projects_path, flash: { notice: "#{@project.name} deleted" }
  end

  private

    def project_params
      params.require(:project).permit!
    end
end