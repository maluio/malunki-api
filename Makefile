test : unit behat

.PHONY: unit
unit:
	docker-compose exec app vendor/bin/phpunit

.PHONY: behat
behat:
	 docker-compose exec app vendor/bin/behat

.PHONY: cache
cache:
	docker-compose exec app bin/console cache:clear

# hack to fix container permissions issue
.PHONY: permissions
permissions:
	docker-compose exec app chown -R www-data var