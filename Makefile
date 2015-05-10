.PHONY: tests

cs:
	@./vendor/bin/phpcs --standard=PSR2 src tests

tests:
	@./vendor/bin/phpunit tests
