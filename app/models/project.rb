class Project < ActiveRecord::Base
  acts_as_commentable
  acts_as_taggable

  has_many :followers
  has_many :users, through: :followers

  has_many :investments
  has_many :investors, through: :investments, source: :user

  mount_uploader :image, ImageUploader

  mount_uploader :company_image, CompanyImageUploader

  validates :name, :price, :owner, :start_investment, :finish_investment, presence: true

  paginates_per 8

  def address
    "#{street} #{city} #{country}"
  end

  def address_changed?
    street_changed? && city_changed? && country_changed?
  end

  before_save do
    return unless address_changed?

    coordinates = Geocoder.coordinates(address)

    return unless coordinates.present?

    self.longitude = coordinates[1]
    self.latitude = coordinates[0]
  end

  def per_share
    price / shares.to_f
  end

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

