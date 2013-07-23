class MessageMailer < ActionMailer::Base
  self.async = true

  default from: Rails.configuration.email.username

  def user_messages(user)
    @user = user
    mail( to: @user.email, subject: Rails.configuration.email.subject )
  end
end
