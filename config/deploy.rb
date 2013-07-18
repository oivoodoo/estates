require 'capistrano-puma'
require 'bundler/capistrano'

# Load RVM's capistrano plugin.
require "rvm/capistrano"

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
  end
end

after "deploy:update_code", "customs:config"
after "deploy:symlink","customs:symlink"
after "deploy", "deploy:cleanup"

after "deploy:start",          "puma:start"
after "deploy:stop",           "puma:stop"
after "deploy:restart",        "puma:restart"
after "deploy:create_symlink", "puma:after_symlink"

