class AddIndexToUsers < ActiveRecord::Migration
  def change
    add_index :investments, :user_id
    add_index :investments, :project_id
  end
end

