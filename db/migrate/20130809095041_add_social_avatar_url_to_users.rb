class AddSocialAvatarUrlToUsers < ActiveRecord::Migration
  def change
    add_column :users, :social_avatar_url, :string
  end
end

