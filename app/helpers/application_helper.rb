module ApplicationHelper
  include ProjectsHelper

  def layout_class
    if controller_name == 'projects' && action_name == 'show'
      "project"
    elsif controller_name == 'project_tags'
      "projects"
    else
      controller_name
    end
  end

  def header_class
    if controller_name == 'projects'
      "mini"
    end
  end
end

