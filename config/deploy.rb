require 'bundler/capistrano'

set :application, "flockcapital.com"
set :repository,  "git@github.com:oivoodoo/estates.git"

set :scm, :git
role :web, "192.81.133.78"                          # Your HTTP server, Apache/etc
role :app, "192.81.133.78"                          # This may be the same as your `Web` server
role :db,  "192.81.133.78", :primary => true # This is where Rails migrations will run

# if you want to clean up old releases on each deploy uncomment this:
# after "deploy:restart", "deploy:cleanup"

after "deploy:start",          "puma:start"
after "deploy:stop",           "puma:stop"
after "deploy:restart",        "puma:restart"
after "deploy:create_symlink", "puma:after_symlink"

