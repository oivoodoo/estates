class Users::RegistrationsController < Devise::RegistrationsController
  layout false

  def create
    build_resource(sign_up_params)

    if resource.save
      flash.now[:success] = I18n.t('devise.registrations.signed_up')
      sign_up(resource_name, resource)
    else
      clean_up_passwords resource
      render :new
    end
  end

  def update
    @user = User.find(current_user.id)

    successfully_updated = if needs_password?(@user, params)
                             @user.update_with_password(params[:user])
                           else
                             # remove the virtual current_password attribute update_without_password
                             # doesn't know how to ignore it
                             params[:user].delete(:current_password)
                             @user.update_without_password(params[:user])
                           end

    if successfully_updated
      set_flash_message :notice, :updated
      # Sign in the user bypassing validation in case his password changed
      sign_in @user, :bypass => true
      redirect_to after_update_path_for(@user)
    else
      render "edit"
    end
  end

  private

  def sign_up_params
    params.require(:user).permit(:email, :name, :password, :password_confirmation, :current_password, :avatar)
  end

  def needs_password?(user, params)
    user.email != params[:user][:email] ||
      !params[:user][:password].blank?
  end
end

