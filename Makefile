phpcs:
	@./vendor/bin/phpcs --standard=PSR2 src tests

tests:
	@./vendor/bin/phpunit

.PHONY: phpcs tests
