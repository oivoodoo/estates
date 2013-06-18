FactoryGirl.define do
  factory :project do
    name
    price       "123"
    owner       "John Snow"
    description "Some description here"
    tag_list    "action, comedy"
  end

  sequence(:name) { |i| "#{i}project" }
end