# EXADS

This repository contains a Symfony application with EXADS code challenges

## Do you need help?
If the following instructions look like Vietnamese to you or if you don't have the necessary tools in your local machine to run them, I can provide an URL with a running version of the project. Please let me know by emailing me to pedro@nitrogenio.net

## Get a docker up and running
Assuming Docker is already installed in your machine, open a terminal in the project root folder and run these commands:
* ```make build```
* ```make start```

## Get the app ready (create DB tables, load fixtures, compile the interface)
First enter the Docker container by running this command:
* ```make bash```

And then run the following commands in the Docker container:
* ```yes | bin/console doctrine:migrations:migrate```
* ```yes | bin/console doctrine:fixtures:load```
* ```composer install```
* ```yarn install```
* ```yarn dev```
* ```exit```

## Run the app
Head to http://localhost:8095 or run this command in the terminal: 
* ```make open```