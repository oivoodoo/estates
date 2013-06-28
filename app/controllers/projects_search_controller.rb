require 'will_paginate/array'

class ProjectsSearchController < ApplicationController
  def index
    @projects = Project.search(params[:query]).paginate(page: params[:page])

    render 'projects/index'
  end
end
