# EXADS

This repository contains a Symfony application with EXADS code challenges

## Do you need help?
If you don't have the necessary tools in your local machine to run the project in a Docker, please head to this URL instead: https://replit.com/@pedro126/ExadsCodeChallenge

This is using https://replit.com/, a collaboration platform.

To be able to view the code and run the app, you will need to Fork the project, Sign Up or Sign In and then Run the server.

Unfortunately there are 2 little drawbacks of using Replit:

* PHPUnit won't run on Replit because the Services is using PHP 8.2 RC7 instead of a final version.
* Also, on Replit, the Database is SQLite instead of MySQL.


## Or get a docker up and running
Assuming Docker is already installed in your machine, open a terminal in the project root folder and run these commands:
* ```make build```
* ```make start```

### Get the app ready (create DB tables, load fixtures, compile the interface)
First enter the Docker container by running this command:
* ```make bash```

And then run the following commands in the Docker container:
* ```yes | bin/console doctrine:migrations:migrate```
* ```yes | bin/console doctrine:fixtures:load```
* ```composer install```
* ```yarn install```
* ```yarn dev```
* ```exit```

### Run the app
Head to http://localhost:8095 or run this command in the terminal: 
* ```make open```