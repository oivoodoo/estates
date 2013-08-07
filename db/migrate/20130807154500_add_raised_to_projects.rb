class AddRaisedToProjects < ActiveRecord::Migration
  def change
    add_column :projects, :raised, :float
  end
end
