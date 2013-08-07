class AddRaiseToProjects < ActiveRecord::Migration
  def change
    add_column :projects, :raise, :float
  end
end
