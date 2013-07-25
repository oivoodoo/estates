class AddRadioButtonsToInvests < ActiveRecord::Migration
  def change
    add_column :invests, :individual_income, :boolean
    add_column :invests, :joint_income, :boolean
    add_column :invests, :business_representative, :boolean
    add_column :invests, :securities_firm, :boolean
    add_column :invests, :company_director, :boolean
    add_column :invests, :company_officer, :boolean
  end
end
