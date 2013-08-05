class InvestsController < ApplicationController
  before_filter :find_project

  def new
    @invest = @project.invests.new
  end

  def create
    @invest = @project.invests.new(params[:invest])

    if @invest.save
      redirect_to root_path, notice: "This message will persist"
    else
      gflash(errors: "Something went wrong")
      render :new
    end
  end

  private

  def find_project
    @project = Project.find(params[:project_id]).decorate
  end
end

