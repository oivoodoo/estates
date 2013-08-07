class AddManagerToProjects < ActiveRecord::Migration
  def change
    add_column :projects, :manager, :text
  end
end
