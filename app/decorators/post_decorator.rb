class PostDecorator < Draper::Decorator
  delegate_all

  def created_at
    object.created_at.strftime("%A, %B %e")
  end

  def updated_at
    object.updated_at.strftime("%A, %B %e")
  end
end