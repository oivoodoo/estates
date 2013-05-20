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
      redirect_to [:admin, @project], flash: { notice: "#{@project.name} created" }
    else
      flash.now[:error] = @project.errors.full_messages
      render :new
    end
  end

  def edit
    @project = Project.find(params[:id])
  end

  def update
    @project = Project.find(params[:id])
    if @project.update_attributes(project_params)
      redirect_to [:admin, @project], flash: { notice: "#{@project.name} updated" }
    else
      flash.now[:error] = @project.errors.full_messages
      render :edit
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