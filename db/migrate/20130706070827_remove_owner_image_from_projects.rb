class RemoveOwnerImageFromProjects < ActiveRecord::Migration
  def change
    remove_column :projects, :owner_image, :string
  end
end
