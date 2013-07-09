class AddAddressFieldsToProjects < ActiveRecord::Migration
  def change
    add_column :projects, :street, :string
    add_column :projects, :city, :string
    add_column :projects, :country, :string
  end
end
