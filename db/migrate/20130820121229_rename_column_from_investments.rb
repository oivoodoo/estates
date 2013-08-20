class RenameColumnFromInvestments < ActiveRecord::Migration
  def change
    rename_column :investments, :identification_image, :identification_document
  end
end
