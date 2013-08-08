class AddCountryStateToUsers < ActiveRecord::Migration
  def change
    add_column :users, :country, :string
    add_column :users, :state, :string
  end
end
