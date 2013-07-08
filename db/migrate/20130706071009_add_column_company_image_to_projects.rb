class AddColumnCompanyImageToProjects < ActiveRecord::Migration
  def change
    add_column :projects, :company_image, :string
  end
end
