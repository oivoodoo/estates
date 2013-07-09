class ChangeColumnStreetCityCountryForProjects < ActiveRecord::Migration
  def change
    change_column :projects, :street, :string, default: "Slobodskaya 91"
    change_column :projects, :city, :string, default: "Minsk"
    change_column :projects, :country, :string, default: "Belarus"
  end
end
