class ChangeColumnInvestmentTypeForProjects < ActiveRecord::Migration
  def change
    change_column :projects, :investment_type, :text, :default => "loan"
  end
end
