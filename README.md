To launch phpUnit tests please execute following docker commands in project's working directory:

```docker build . -t loadbalancer -f Dockerfile```

```docker run loadbalancer:latest```

Or if you prefer, build project with composer and execute tests manually (php 7.4 is required). 