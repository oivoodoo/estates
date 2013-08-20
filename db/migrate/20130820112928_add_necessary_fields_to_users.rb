class AddNecessaryFieldsToUsers < ActiveRecord::Migration
  def change
    add_column :users, :individual_income, :boolean
    add_column :users, :securities_firm, :boolean
    add_column :users, :company_director, :boolean
    add_column :users, :company_officer, :boolean
  end
end
