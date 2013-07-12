class Project < ActiveRecord::Base
  acts_as_commentable
  acts_as_taggable

  has_many :followers
  has_many :users, through: :followers

  mount_uploader :image, ImageUploader

  mount_uploader :company_image, CompanyImageUploader

  validates :name, :price, :owner, presence: true

  self.per_page = 8

  def followed_by!(user)
    unless users.exists?(user.id)
      users << user
    end
  end

  def unfollow!(user)
    users.delete(user)
  end

  def followed?(user)
    users.include?(user)
  end

  def self.search(query)
    if query.present?
      where('name @@ :q or description @@ :q', q: query)
    else
      scoped
    end
  end
end

