class Project < ActiveRecord::Base
  acts_as_commentable
  acts_as_taggable

  has_many :investments
  has_many :investors, through: :investments, source: :user, uniq: true

  mount_uploader :image, ImageUploader
  mount_uploader :company_image, CompanyImageUploader

  validates :name, :price, :owner, :start_investment, :finish_investment, presence: true

  paginates_per 8

  acts_as_followable

  include Addressable

  scope :loan, where(investment_type: 'loan')
  scope :debt, where(investment_type: 'debt')

  # we are going to use this public_activity gem fot tracking things in our app
  # in showing them on the projects#show and user's pages.
  include PublicActivity::Model
  tracked skip_defaults: true

  def per_share
    price / shares.to_f
  end

  def self.search(query)
    if query.present?
      where('name @@ :q or description @@ :q', q: query)
    else
      scoped
    end
  end
end

