# Estates

# Deployment

Add heroku section to the .git/config file:

```
[remote "staging"]
	url = git@heroku.com:estates-staging.git
	fetch = +refs/heads/*:refs/remotes/heroku/*
```

Deploy it using:

```
git push staging master
```

