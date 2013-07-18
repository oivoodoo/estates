require 'bundler/capistrano'

# Load RVM's capistrano plugin.
require "rvm/capistrano"

set :stage, "production"
set :rvm_ruby_string, '2.0.0'
set :rvm_type, :user

set :user, 'deploy'
set :application, "estates"
set :repository,  "git@github.com:oivoodoo/estates.git"

ssh_options[:port] = 16888
ssh_options[:forward_agent] = true

set :normalize_asset_timestamps, false
set :use_sudo, false
set :deploy_to, "/var/www/estates"

set :scm, :git
role :web, "192.81.133.78"                          # Your HTTP server, Apache/etc
role :app, "192.81.133.78"                          # This may be the same as your `Web` server
role :db,  "192.81.133.78", primary: true # This is where Rails migrations will run

# if you want to clean up old releases on each deploy uncomment this:
# after "deploy:restart", "deploy:cleanup"

set :shared_children, shared_children << 'tmp/sockets'

set :puma_sock, "unix:///var/run/puma/estates.sock"
set :puma_state, "/var/run/puma/estates.state"

namespace :deploy do
  desc "Start the application"
  task :start, :roles => :app, :except => { :no_release => true } do
    run "cd #{current_path} && RAILS_ENV=#{stage} bundle exec puma -e #{stage} -d -b #{puma_sock} -S #{puma_state}", :pty => false
  end

  desc "Stop the application"
  task :stop, :roles => :app, :except => { :no_release => true } do
    run "cd #{current_path} && RAILS_ENV=#{stage} bundle exec pumactl -S #{puma_state} stop"
  end

  desc "Restart the application"
  task :restart, :roles => :app, :except => { :no_release => true } do
    run "cd #{current_path} && RAILS_ENV=#{stage} bundle exec pumactl -S #{puma_state} restart"
  end

  desc "Status of the application"
  task :status, :roles => :app, :except => { :no_release => true } do
    run "cd #{current_path} && RAILS_ENV=#{stage} bundle exec pumactl -S #{puma_state} stats"
  end
end

namespace(:customs) do
  task :config, :roles => :app do
    run <<-CMD
      ln -nfs #{shared_path}/config/database.yml #{release_path}/config/database.yml
    CMD
  end
  task :symlink, :roles => :app do
    run <<-CMD
      ln -nfs #{shared_path}/public/uploads #{release_path}/public/uploads
    CMD
    run <<-CMD
      ln -nfs #{shared_path}/public/assets/ #{release_path}/public/assets/
    CMD
  end
end

after "deploy:update_code", "customs:config"
after "deploy:symlink","customs:symlink"
after "deploy", "deploy:cleanup"

load 'deploy/assets'

