class ProjectDecorator < Draper::Decorator
  delegate_all

  def address
    "#{street} #{city} #{country}"
  end

  def address?
    address.strip.present?
  end

  def days_to_close
    ((finish_investment - DateTime.now).to_f / 60.to_f / 60.to_f / 24.to_f).round
  end

  def updated_at
    object.updated_at.strftime("%A, %B %e")
  end

  def investment_type
    object.investment_type.camelcase
  end
end
