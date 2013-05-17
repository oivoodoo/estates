FactoryGirl.define do
  factory :user do
    email
    password              "12345678"
    password_confirmation "12345678"
  end

  sequence(:email) { |i| "admin#{i}@estates.com" }
end