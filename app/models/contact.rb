class Contact < ActiveRecord::Base
	validates :email, :description, presence: :true, length: { minimum: 4, too_short: "Please enter at least 4 characters" }	
end
