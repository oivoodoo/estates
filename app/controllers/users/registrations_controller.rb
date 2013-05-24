class Users::RegistrationsController < Devise::RegistrationsController
  private

  def sign_up_params
    params.require(:user).permit(:email, :name, :password, :password_confirmation, :current_password)
  end
end

