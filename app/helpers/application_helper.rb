module ApplicationHelper
  def layout_class
    if action_name == 'show'
      "project"
    elsif
      controller_name == 'project_tags'
      "projects"
    else
      controller_name
    end
  end
end
