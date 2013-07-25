class AddFieldsToInvests < ActiveRecord::Migration
  def change
    add_column :invests, :address_line_1, :string
    add_column :invests, :address_line_2, :string
    add_column :invests, :city, :string
    add_column :invests, :zip_code, :integer
    add_column :invests, :phone_area_code, :integer
    add_column :invests, :phone_prefix, :integer
    add_column :invests, :phone_last_four, :integer
    add_column :invests, :identification, :boolean
  end
end
