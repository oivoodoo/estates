class AddFieldsToUsers < ActiveRecord::Migration
  def change
    add_column :users, :phone, :integer
    add_column :users, :street_address, :string
    add_column :users, :zip_code, :integer
  end
end
