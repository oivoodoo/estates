class Invest < ActiveRecord::Base
  mount_uploader :identification_image, IdentificationImageUploader
  validates :identification_image, presence: true

  attr_accessor :state, :country
end
