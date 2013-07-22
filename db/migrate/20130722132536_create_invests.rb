class CreateInvests < ActiveRecord::Migration
  def change
    create_table :invests do |t|
      t.string :identification_image

      t.timestamps
    end
  end
end
