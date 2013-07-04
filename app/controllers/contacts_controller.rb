class ContactsController < ApplicationController
  def new
    @contact = Contact.new
  end

  def create
    @contact = Contact.new(params[:contact])

    if @contact.save
      ContactMailer.new_contact(@contact).deliver
      gflash(success: "Message was successfully sent.")

      redirect_to root_path
    else
      render :new
    end
  end
end
