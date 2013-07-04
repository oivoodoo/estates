class AddLatitudeLongtitudeAndAddressToProjects < ActiveRecord::Migration
  def change
    add_column :projects, :latitude, :float
    add_column :projects, :longtitude, :float
    add_column :projects, :address, :string
  end
end
