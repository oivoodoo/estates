class AddOwnerImageToProjects < ActiveRecord::Migration
  def change
    add_column :projects, :owner_image, :string
  end
end
