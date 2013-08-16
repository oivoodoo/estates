class Investment < ActiveRecord::Base
  mount_uploader :identification_image, IdentificationImageUploader

  attr_accessor :state, :country

  belongs_to :user
  belongs_to :project

  has_many :project_investors, through: :project, source: :investors

  validates_numericality_of :quantity, greater_than: 0

  def money
    quantity * project.per_share
  end
end

