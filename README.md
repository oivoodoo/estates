# Estates

[![Build Status](https://drone.io/github.com/oivoodoo/estates/status.png)](https://drone.io/github.com/oivoodoo/estates/latest) 

# Deployment


# TODO: replace it by remote copy to the remote folder

```
RAILS_ENV=production RAILS_GROUPS=assets bundle exec rake assets:precompile
git add .
git commit -m "Precompile assets and commit it"
```

```
cap deploy
```

# Production Server:

[http://li603-78.members.linode.com/](http://li603-78.members.linode.com/)

# SSH Production:

[ssh <user-name>@192.81.133.78 -p 16888](ssh <user-name>@192.81.133.78 -p 16888)

