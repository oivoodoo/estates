class Users::SessionsController < Devise::SessionsController
  private

  def sign_in_params
    params.require(:user).permit(:email, :password, :remember_me)
  end
end

