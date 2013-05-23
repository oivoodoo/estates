class CreateAuthentications < ActiveRecord::Migration
  def change
    create_table :authentications do |t|
      t.string  :provider,  null: false
      t.string  :uid,       null: false
      t.string  :email,     null: false
      t.integer :user_id,   null: false

      t.timestamps
    end
  end
end
