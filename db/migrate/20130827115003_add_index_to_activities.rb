class AddIndexToActivities < ActiveRecord::Migration
  def change
    add_index :activities, [:trackable_id, :trackable_type]
    add_index :activities, [:owner_id, :owner_type]
  end
end
