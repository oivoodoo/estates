module Admin::UsersHelper
  def status
    [["Pending", "pending"], ["Approved", "approved"]]
  end
end
