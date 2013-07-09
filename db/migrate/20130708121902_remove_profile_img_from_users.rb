class RemoveProfileImgFromUsers < ActiveRecord::Migration
  def change
    remove_column :users, :profile_img, :string
  end
end
