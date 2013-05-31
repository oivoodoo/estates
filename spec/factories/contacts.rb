# Read about factories at https://github.com/thoughtbot/factory_girl

FactoryGirl.define do
  factory :contact do
  	email				"watson@example.com"
  	name				"John Watson"
  	description	"Some text here"
  end
end
