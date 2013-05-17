class CreateProjects < ActiveRecord::Migration
  def change
    create_table :projects do |t|
      t.string :name
      t.float :price
      t.text :description
      t.string :owner

      t.timestamps
    end
  end
end
