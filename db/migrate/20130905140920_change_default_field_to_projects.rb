class ChangeDefaultFieldToProjects < ActiveRecord::Migration
  def change
    change_column :projects, :holding, :string, default: "24"
  end
end
