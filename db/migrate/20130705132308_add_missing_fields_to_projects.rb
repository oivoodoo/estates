class AddMissingFieldsToProjects < ActiveRecord::Migration
  def change
    add_column :projects, :property, :text
    add_column :projects, :strength, :text
    add_column :projects, :investment_type, :text, :default => "loan"
    add_column :projects, :investment_term, :text
  end
end

