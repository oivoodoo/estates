class ProjectDecorator < Draper::Decorator
  delegate_all

  include ActionView::Helpers::NumberHelper

  def address
    "#{street} #{city} #{country}"
  end

  def address?
    address.strip.present?
  end

  def days_to_close
    return 0 unless finish_investment.present?
    ((finish_investment - DateTime.now).to_f / 60.to_f / 60.to_f / 24.to_f).round
  end

  def updated_at
    object.updated_at.strftime("%A, %B %e")
  end

  def investment_type
    object.investment_type.camelcase
  end

  def per_share
    price / shares.to_f
  end

  def percent
    object.percent.to_f
  end

  def view_percent
    number_to_percentage(percent, :precision => 0)
  end
end

