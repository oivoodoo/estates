class ChangeColumnFromUsers < ActiveRecord::Migration
  def change
    change_column :users, :individual_income, :string
  end
end
