class InvestsController < ApplicationController
  before_filter :find_project

  def new
    @invest = @project.invests.new
  end

  def create
  end

  private

  def find_project
    @project = Project.find(params[:project_id]).decorate
  end
end

