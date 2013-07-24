class AddProjectIdToInvests < ActiveRecord::Migration
  def change
    add_column :invests, :project_id, :integer, :null => false
  end
end

