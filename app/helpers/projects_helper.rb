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

  def project_json(project)
    json = project.as_json(only: [:id, :name, :latitude, :longitude], methods: :address)
    json['followed'] = current_user.present? && current_user.following_projects_ids.include?(project.object.id)
    json.to_json
  end

  def project_button_urls_json(project)
    {
      follow: follow_project_path(project),
      unfollow: unfollow_project_path(project)
    }.to_json
  end

  def followers_json(followers)
    followers.to_json(only: :id, methods: [:name, :profile_image])
  end

  def filter_class(active)
    params.fetch(:active, 'local') == active ? 'current' : ''
  end
end

