InvestmentsCreator = Struct.new(:user) do
  def create(project, options = {})
    investment = Investment.new(options)
    investment.user = user
    investment.project = project
    investment.save
  end
end

