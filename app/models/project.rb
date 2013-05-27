class Project < ActiveRecord::Base
	acts_as_commentable
	
  mount_uploader :image, ImageUploader

	validates :name, :price, :owner, presence: true

	self.per_page = 6
end
