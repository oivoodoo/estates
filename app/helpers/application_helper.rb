module ApplicationHelper
  def layout_class
    if action_name == 'show'
      "project"
    else
      controller_name == 'project_tags'
      "projects"
    end
  end
end
