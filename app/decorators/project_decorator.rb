class ProjectDecorator < Draper::Decorator
  delegate_all

  def address
    "#{street} #{city} #{country}"
  end
end
