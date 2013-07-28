module ProjectsHelper
  def tag_class_name(tag_name)
    "current" if (params[:tag].blank? && tag_name == 'all') || params[:tag] == tag_name
  end

  def render_tag_list(project)
    if project.tag_list.present?
      content_tag(:label, class: 'type') do
        project.tag_list.map { |t| link_to(t.camelcase, tag_path(t)) }.join
      end
    end
  end
end
