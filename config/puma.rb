rails_env = ENV['RAILS_ENV'] || 'development'

threads 4,4

bind  "unix:///var/run/puma/estates.sock"
pidfile "/var/run/puma/estatest.pid"
state_path "/var/run/puma/"

activate_control_app

