class AddIdentificationDocumentToUsers < ActiveRecord::Migration
  def change
    add_column :users, :identification_document, :string
  end
end
