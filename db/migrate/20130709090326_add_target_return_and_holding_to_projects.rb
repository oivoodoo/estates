class AddTargetReturnAndHoldingToProjects < ActiveRecord::Migration
  def change
    add_column :projects, :target_return, :float, default: "50"
    add_column :projects, :holding, :string, default: "24 month" 
  end
end
