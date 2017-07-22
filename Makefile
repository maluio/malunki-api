# run phpunit tests
.PHONY: test
test:
	docker-compose exec app vendor/bin/phpunit
