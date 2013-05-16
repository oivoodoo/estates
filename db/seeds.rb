admin = User.new(:email => "admin@estates.com",
  :password => "12345678",
  :password_confirmation => "12345678")
  admin.role = 'admin'
  admin.save!