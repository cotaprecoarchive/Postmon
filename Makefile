.PHONY: tests

check-cs:
	@./vendor/bin/phpcs --standard=PSR2 src tests

tests:
	@./vendor/bin/phpunit tests
