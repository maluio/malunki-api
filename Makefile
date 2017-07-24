# run phpunit tests
.PHONY: test
test:
	docker-compose exec app vendor/bin/phpunit

.PHONY: cache
cache:
	docker-compose exec app bin/console cache:clear
