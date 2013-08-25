if Rails.env.production?
  CarrierWave.configure do |config|
    config.fog_credentials = {
      :provider               => 'AWS',
      :aws_access_key_id      => ENV['s3_key'],
      :aws_secret_access_key  => ENV['s3_access'],
    }
    config.fog_directory  = 'estates_production'
    config.fog_public     = false
  end
end

