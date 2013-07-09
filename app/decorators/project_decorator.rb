class ProjectDecorator < Draper::Decorator
  delegate_all

  def address
    "#{street} #{city} #{country}"
  end

  def days_to_close
    ((finish_investment - DateTime.now).to_f / 60.to_f / 60.to_f / 24.to_f).round
  end
end
