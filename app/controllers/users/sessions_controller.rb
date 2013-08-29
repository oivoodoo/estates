class Users::SessionsController < Devise::SessionsController
  layout :determine_layout

  def create
    self.resource = warden.authenticate(auth_options)
    if self.resource.present?
      sign_in(resource_name, resource)
      flash.now[:success] = I18n.t('devise.sessions.signed_in')
    else
      flash.now[:errors] = I18n.t('devise.failure.invalid')
      render :new
    end
  end

  private

  def determine_layout
    return false if request.xhr?
    'application'
  end
end

