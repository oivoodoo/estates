class Post < ActiveRecord::Base
  validates_presence_of :title, :content

  mount_uploader :post_image, PostImageUploader
end

