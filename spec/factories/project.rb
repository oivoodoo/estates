FactoryGirl.define do
  factory :project do
    name
    price       "123"
    owner       "John Snow"
    description "Some description here"
    start_investment { DateTime.now }
    finish_investment { 2.days.from_now }
  end

  sequence(:name) { |i| "#{i}project" }
end