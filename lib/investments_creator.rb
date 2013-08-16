InvestmentsCreator = Struct.new(:user) do
  def create(project, options = {})
    investment = Investment.new(options)
    investment.user = user
    investment.project = project
    # return result of the save method on tap
    investment.save.tap do
      project.create_activity 'user_invested', owner: user
      user.create_activity 'project_invested', owner: project
    end
  end
end

