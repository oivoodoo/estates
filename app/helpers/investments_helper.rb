module InvestmentsHelper
  def net_worths
    [["Less than $1 million", "$1 million"], ["$1 - $2.5 million", "$2.5 million"], ["$2.5 - $5 million", "$5 million"], ["More than $5 million", "$5 million"]]
  end
end
