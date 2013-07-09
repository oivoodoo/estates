class AddColumnStartFinishInvestmentToProjects < ActiveRecord::Migration
  def change
    add_column :projects, :start_investment, :datetime, :default => DateTime.now
    add_column :projects, :finish_investment, :datetime, :default => 2.days.from_now
  end
end
