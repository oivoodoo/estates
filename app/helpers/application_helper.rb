module ApplicationHelper
  include ProjectsHelper

  def layout_class
    if controller_name == 'projects' && action_name == 'show'
      "project"
    elsif controller_name == 'project_tags'
      "projects"
    elsif controller_name == "registrations"
      "investor-edit"
    elsif controller_name == 'users'
      'investor'
    else
      controller_name
    end
  end

  def header_class
    'mini' unless controller_name == 'home'
  end
end

