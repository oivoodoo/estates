class Project < ActiveRecord::Base
	acts_as_commentable
	acts_as_taggable

	has_many :followers
	has_many :users, through: :followers
	
  mount_uploader :image, ImageUploader

	validates :name, :price, :owner, :tag_list, presence: true

	self.per_page = 6

	def followed_by!(user)
		unless users.exists?(user.id)
			users << user
		end
	end
end
