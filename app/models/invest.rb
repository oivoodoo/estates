class Invest < ActiveRecord::Base
  mount_uploader :identification_image, IdentificationImageUploader

  attr_accessor :state, :country
end
