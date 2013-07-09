class AddAddressFieldsToProjects < ActiveRecord::Migration
  def change
    add_column :projects, :street, :string, default: "Slobodskaya 91" 
    add_column :projects, :city, :string, default: "Minsk" 
    add_column :projects, :country, :string, default: "Belarus" 
  end
end
