class GetAddresses < ActiveRecord::Migration
  class Project < ActiveRecord::Base
    def address_changed?
      true
    end
  end

  def change
    Project.all.map(&:save!)
  end
end
