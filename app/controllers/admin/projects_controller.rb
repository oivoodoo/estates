class Admin::ProjectsController < AdminController
  before_filter :find_project, only: [:show, :edit, :update, :destroy]

  def index
    @projects = Project.all
  end

  def show
  end

  def new
    @project = Project.new
  end

  def create
    @project = Project.new(project_params)

    if @project.save
      redirect_to [:admin, @project], flash: { notice: "#{@project.name} created" }
    else
      flash.now[:error] = @project.errors.full_messages
      render :new
    end
  end

  def edit
  end

  def update
    if @project.update_attributes(project_params)
      redirect_to [:admin, @project], flash: { notice: "#{@project.name} updated" }
    else
      flash.now[:error] = @project.errors.full_messages
      render :edit
    end
  end

  def destroy
    @project.destroy

    redirect_to admin_projects_path, flash: { notice: "#{@project.name} deleted" }
  end

  private

  def project_params
    params.require(:project).permit!
  end

  def find_project
    @project = Project.find(params[:id])
  end
end

