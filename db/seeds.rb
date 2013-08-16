# create admin user
User.create do |user|
  user.name                  = "Super Admin"
  user.email                 = "admin@example.com"
  user.password              = "password"
  user.password_confirmation = "password"
  user.role                  = 'admin'
  user.status                = 'approved'
end

# create normal user
User.create do |user|
  user.name                  = "John Watson"
  user.email                 = "user@estates.com"
  user.password              = "12345678"
  user.password_confirmation = "12345678"
end

10.times do |n|
  Project.create! do |p|(
    p.name        = "Project #{n}"
    p.owner       = "Owner #{n}"
    p.price       = rand() * 1000000
    p.shares      = 10000
    p.description = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.")
    p.image       = File.open(Rails.root.join("public/images/house.jpg"))
    p.country     = 'Belarus'
    p.city        = 'Minsk'
    p.street      = 'Slobodskaya 61'
    p.start_investment  = DateTime.now
    p.finish_investment = 1.month.from_now
    p.tag_list          = ["Residential"]
  end
end

