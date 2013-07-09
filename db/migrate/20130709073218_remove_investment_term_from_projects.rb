class RemoveInvestmentTermFromProjects < ActiveRecord::Migration
  def change
    remove_column :projects, :investment_term, :text
  end
end
