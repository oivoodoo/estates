class ChangeColumnToProjects < ActiveRecord::Migration
  def change
    change_column :projects, :investment_type, :text, default: "equity"
  end
end
