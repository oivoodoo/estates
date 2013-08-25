class RecreateVersionsForProjectsAgainAgainAgain < ActiveRecord::Migration
  def change
    Project.find_each do |project|
      puts "Resizing #{project.name}"
      project.image.recreate_versions!
      puts "Done it"
    end
  end
end

