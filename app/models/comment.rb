class Comment < ActiveRecord::Base

  include ActsAsCommentable::Comment

  validates :comment, presence: true

  belongs_to :commentable, polymorphic: true

  default_scope -> { order('created_at ASC') }

  belongs_to :user
end
