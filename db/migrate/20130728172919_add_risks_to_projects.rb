class AddRisksToProjects < ActiveRecord::Migration
  def change
    add_column :projects, :risks, :string, :default => ""
  end
end

