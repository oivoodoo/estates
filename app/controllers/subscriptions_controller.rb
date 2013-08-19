class SubscriptionsController < ApplicationController
  def create
    Subscription.create(email: params[:email])
    render json: { message: I18n.t('subscriptions.create.success') }
  end
end

