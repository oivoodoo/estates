class RemoveRaiseToProjects < ActiveRecord::Migration
  def change
    remove_column :projects, :raise, :float
  end
end
