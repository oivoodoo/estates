class AddSharesToProjects < ActiveRecord::Migration
  def change
    add_column :projects, :shares, :integer, :default => 1, :null => false
  end
end

