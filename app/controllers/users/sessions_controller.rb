class Users::SessionsController < Devise::SessionsController
  layout false

  def create
    self.resource = warden.authenticate(auth_options)
    if self.resource.present?
      sign_in(resource_name, resource)
      flash.now[:success] = "You are successfully signed in"
    else
      flash.now[:errors] = "Invalid credentials"
      render :new
    end
  end
end

