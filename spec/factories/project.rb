FactoryGirl.define do
  factory :project do
    name
    price              "123"
    description "Some description here"
  end

  sequence(:name) { |i| "#{i}project" }
end