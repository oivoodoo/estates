class AddUserIdAndProjectIdToInvestment < ActiveRecord::Migration
  def change
    add_column :investments, :user_id, :integer
  end
end
