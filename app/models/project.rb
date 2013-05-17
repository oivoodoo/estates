class Project < ActiveRecord::Base
  attr_accessible :name, :price, :description, :owner

  validates :name, :price, :owner, presence: true
end
