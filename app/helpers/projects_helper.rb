module ProjectsHelper
  def tag_class_name(tag_name)
    "current" if (params[:tag].blank? && tag_name == 'all') || params[:tag] == tag_name
  end 
end
