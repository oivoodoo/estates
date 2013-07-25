class AddSelectOptionToInvest < ActiveRecord::Migration
  def change
    add_column :invests, :net_worth, :text
  end
end
