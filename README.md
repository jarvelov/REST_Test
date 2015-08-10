# REST_Test

##Description
This project was a test I was given as part of a job interview. The task was to create a REST api which could:

* Create a user from a JSON request
* List a user
* List all users

A user needed to have the following properties:

* Name
* Username
* Email
* Password

For this project I ended up using:

* [Angular JS](http://angularjs.org/)
* [Flight PHP framework[](http://flightphp.com/)
* [SQLite 3](https://www.sqlite.org/)
* [Bootstrap](http://getbootstrap.com/)
* [jQuery](http://jquery.com/).

Project dependencies are managed with [Composer](https://getcomposer.org) and [Bower](https://bower.io)

I learned a lot about AngularJS on the way, which was a lot of fun.

##Demo

Click here for a live demo: [Demo](https://tobias.jarvelov.se/projects/REST_Test)

##Install

Make sure you have all the requirements before proceeding.

Clone the repo

`git clone https://github.com/jarvelov/REST_Test.git`

Change into the directory

`cd REST_Test`

Run composer (install it first if you haven't got it already)

`php composer.phar install`

Make sure the directory is writable by the web server
Note: This is for Apache2 on Ubuntu 14.04. Refer to your distributions/web documentation if this isn't what you are using.

Make sure you run this inside the `REST_Test` directory!

`chown www-data:www-data . -R`

Then browse to the address with a web browser.

The database is automatically created on the first visit.
To empty the database simply remove the `database.db` and revisit the address.

##Requirements

* Composer
* PHP 5.4 or higher
* AngularJS 1.4.3 or higher
* SQLite 3
* Bootstrap 3
* jQuery