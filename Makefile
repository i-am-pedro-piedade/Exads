PROJECTROOTDIR = $(CURDIR)

build:
	docker-compose build

start:
	docker-compose up -d

stop:
	docker-compose stop

down:
	docker-compose down --volumes

bash:
	docker exec -it exads_app bash

ssh-db:
	docker exec -it exads_db bash

open:
	open http://localhost:8095/

list:
	docker container ls
