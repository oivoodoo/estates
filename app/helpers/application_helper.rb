module ApplicationHelper
  include FacebookShare
  include ProjectsHelper
  include UsersHelper

  def layout_class
    if controller_name == 'projects' && action_name == 'show'
      "project"
    elsif controller_name == 'project_tags'
      "projects"
    elsif controller_name == "registrations"
      "settings"
    elsif controller_name == 'users'
      'investor'
    elsif controller_name == 'pages'
      'projects'
    else
      controller_name
    end
  end

  def header_class
    'mini' unless controller_name == 'home'
  end

  def full_path
    request.protocol + request.host_with_port + request.fullpath
  end

  def class_name(menu)
    controller_name == menu ? "current" : ""
  end

  def nav_helper
    if controller_name == 'users' && action_name == 'show'
      "current"
    elsif controller_name == 'dashboard' && action_name == 'index'
      "current"
    elsif controller_name == "registrations"
      "current"
    else
      controller_name
    end
  end
end

