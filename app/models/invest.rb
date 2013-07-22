class Invest < ActiveRecord::Base
  mount_uploader :identification_image, IdentificationImageUploader
  validates :identification_image, presence: true
end
