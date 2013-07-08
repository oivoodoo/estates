class AddPercentageToProjects < ActiveRecord::Migration
  def change
    add_column :projects, :percent, :float
  end
end
