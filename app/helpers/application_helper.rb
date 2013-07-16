module ApplicationHelper
  def layout_class
    if controller_name == 'project_tags'
      "projects"
    else
      controller_name
    end
  end
end
