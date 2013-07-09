class AddColumnStartFinishInvestmentToProjects < ActiveRecord::Migration
  def change
    add_column :projects, :start_investment, :datetime
    add_column :projects, :finish_investment, :datetime
  end
end
