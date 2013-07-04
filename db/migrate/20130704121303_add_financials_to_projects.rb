class AddFinancialsToProjects < ActiveRecord::Migration
  def change
    add_column :projects, :financials, :string
  end
end
