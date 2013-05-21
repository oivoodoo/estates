class Project < ActiveRecord::Base
  mount_uploader :image, ImageUploader

	validates :name, :price, :owner, presence: true

	self.per_page = 6
end
