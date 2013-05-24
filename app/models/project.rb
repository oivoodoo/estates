class Project < ActiveRecord::Base
	has_many :comments

  mount_uploader :image, ImageUploader

	validates :name, :price, :owner, presence: true

	self.per_page = 6
end
