class Project < ActiveRecord::Base
	validates :name, :price, :owner, presence: true

	self.per_page = 6
end
