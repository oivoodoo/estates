class Users::PasswordsController < Devise::PasswordsController
  private

  def resource_params
    params.require(:user).permit!
  end
end

