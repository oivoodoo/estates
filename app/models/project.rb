class Project < ActiveRecord::Base
  validates :name, :price, :owner, presence: true
end
