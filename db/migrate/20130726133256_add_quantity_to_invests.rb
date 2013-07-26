class AddQuantityToInvests < ActiveRecord::Migration
  def change
    add_column :invests, :quantity, :integer
  end
end
