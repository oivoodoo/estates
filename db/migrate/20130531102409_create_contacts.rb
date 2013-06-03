class CreateContacts < ActiveRecord::Migration
  def change
    create_table :contacts do |t|
    	t.string :name
    	t.string :email, null: false
    	t.text :message, null: false

      t.timestamps
    end
  end
end
