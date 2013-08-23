class AddSocialAvatarLinkToUsers < ActiveRecord::Migration
  def change
    add_column :users, :facebook_avatar, :string
    add_column :users, :google_plus_avatar, :string
    add_column :users, :linkedin_avatar, :string
  end
end
