class ContactsController < ApplicationController
  layout false

  def new
    @contact = Contact.new
  end

  def create
    @contact = Contact.new(params[:contact])

    if @contact.save
      ContactMailer.new_contact(@contact).deliver
      flash.now[:success] = "Message was successfully sent."
    else
      flash.now[:errors] = "Could not send because of the issues"
      render :new
    end
  end
end
