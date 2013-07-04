class CreateProjects < ActiveRecord::Migration
  def change
    create_table :projects do |t|
      t.string :name
      t.float :price
      t.text :description
      t.string :owner
      t.text :property
      t.text :strength
      t.integer :investment_type
      t.datetime :investment_term

      t.timestamps
    end
  end
end
