admin = User.new(:email => "admin@estates.com",
  :password => "12345678",
  :password_confirmation => "12345678")
  admin.role = 'admin'
  admin.save!

10.times do |n|
  Project.create! do |p|(
    p.name = "Project #{n}"
    p.owner = "Owner #{n}"
    p.price = "12345678"
    p.description = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.")
  end
end
