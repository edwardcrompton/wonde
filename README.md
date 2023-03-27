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

## Assumptions

I've adopted a relatively narrow interpretation of the functionality required
to satisfy the user story. I've assumed that the user story is a feature within
a larger system that provides authentication and access restriction based on
employee ID.

The features I've chosen to concentrate on are the following:
- Presentation of basic lists of student names, ordered by lesson start time.
- Integration of TailwindCSS for some simple theming.
- Caching of API responses in order to reduce the number of requests required
and to speed up the application. I found this was very useful during development
as well as for a hypothetical end user.
- Simple error handling on submission of the form.
- A unit test and a feature test.
- Provision of a Dockerfile to allow the application to be run without setup.

## Further development

- Lessons in the timetable could be grouped by day instead of just being in a
long chronological list.

- Data presented on the timetable could be made more useful by adding additional
metadata. For example, each lesson could be labelled with the course name or
subject; the period number of the lesson could be displayed.

- Long lists of students could be collapsed when the page loads and expanded
only when the lesson is clicked. This could be done with a Vue.js accordion.
Something similar could be done with the days of the week so that a user only
needs to click the day they wish to browse.

- Caching of API responses could be improved by implementing database, memcached
or redis caching instead of simple file caching.

- Feature tests could be made more useful by implementing Laravel Dusk to
interact with the application through a headless browser. Tests could be
integrated with Github Actions so that when a pull request is made the tests are
automatically run on it.
