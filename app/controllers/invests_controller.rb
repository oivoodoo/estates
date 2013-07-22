class InvestsController < ApplicationController
  before_filter :find_project

  def new
  end

  private

  def find_project
    @project = Project.find(params[:project_id]).decorate
  end
end

