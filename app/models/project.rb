class Project < ActiveRecord::Base
  acts_as_commentable
  acts_as_taggable

  geocoded_by :address
  after_validation :geocode

  has_many :followers
  has_many :users, through: :followers

  mount_uploader :image, ImageUploader

  validates :name, :price, :owner, presence: true

  self.per_page = 8

  def followed_by!(user)
    unless users.exists?(user.id)
      users << user
    end
  end

  def self.search(query)
    if query.present?
      where('name @@ :q or description @@ :q', q: query)
    else
      scoped
    end
  end
end

