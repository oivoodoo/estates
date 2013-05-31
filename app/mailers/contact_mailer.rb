class ContactMailer < ActionMailer::Base
  default from: "from@example.com"

  def new_contact(contact)
  	@contact = contact
  	mail(:to => "petya.petinych@gmail.com", :subject => "Contact Us")
  end
end
