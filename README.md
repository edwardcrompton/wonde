# Wonde API Exercise

This Laravel application demonstrates use of the Wonde API to satisfy the
following user story:

__As a Teacher I want to be able to see which students are in my class each day
of the week so that I can be suitably prepared__.

## Set up

The local development environment I use is Lando. However, to run the app
without the overhead of installing Lando I've also included a Dockerfile.

### Quick run with Docker

You'll need Docker installed to run with this method.

From the root of the codebase (this folder), run:

`docker run --rm -it -p 8000:8000 $(docker build -q .)`

Go to `http://0.0.0.0:8000/` in your browser and you should see the application
home screen.

### Full development environment with Lando

To run the app using Lando, you'll need to have some prerequists installed.
Please follow https://docs.lando.dev/getting-started/installation.html to
install Lando and dependencies.

Then, to start the app:

```
> lando start
```

Go to https://wonde.lndo.site/ in your browser and you should see the
application home screen.

## Running tests

The application contains a unit test and a feature test. These can be run with
the following command:

`docker run --rm -it -p 8000:8000 $(docker build -q .) php artisan test`
