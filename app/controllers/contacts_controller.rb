class ContactsController < ApplicationController
  def new
    @contact = Contact.new
  end

  def create
    @contact = Contact.new(params[:contact])

    if @contact.save
      ContactMailer.new_contact(@contact).deliver

      redirect_to root_path, notice: "Message was successfully sent."
    else
      render :new
    end
  end
end
