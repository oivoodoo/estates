class ChangeFinancialsInProjects < ActiveRecord::Migration
  def change
    change_column :projects, :financials, :text
  end
end
