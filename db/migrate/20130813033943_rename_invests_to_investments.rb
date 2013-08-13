class RenameInvestsToInvestments < ActiveRecord::Migration
  def change
    rename_table :invests, :investments
  end
end
