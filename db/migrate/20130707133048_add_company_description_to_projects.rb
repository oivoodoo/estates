class AddCompanyDescriptionToProjects < ActiveRecord::Migration
  def change
    add_column :projects, :company_description, :text
  end
end
