class RenameStreetAddressToStreetForUsers < ActiveRecord::Migration
  def change
    rename_column :users, :street_address, :street
  end
end
