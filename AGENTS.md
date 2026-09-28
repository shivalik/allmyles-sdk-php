# AGENTS.md — Base44 dev notes for allmyles-sdk-php

## What this project is
This is **allmyles-sdk-php**, a PHP SDK library (Composer package) for the Allmyles
travel API. It is **not a web application** — there is no web server, no frontend,
and no HTTP entry point. Nothing serves on port 3000, so there is no browser
preview. The only way to verify it works is by running the PHPUnit test suite.

## Tech stack
- PHP 5.3+ (tested with `php:5.6-cli` in Docker)
- Composer for dependency management
- PHPUnit 4.1.* (dev dependency, from `composer.lock`)

## Running the tests
```bash
docker compose -f docker-compose.base44.yml up --abort-on-container-exit
```
This one-shot service installs git/zip/unzip, runs `composer install`, then
runs `vendor/bin/phpunit --bootstrap tests/bootstrap.php tests/`.

### Why a custom bootstrap is needed
The source files live in `src/Allmyles/Classes/` but their namespaces omit the
`Classes` segment (e.g. `Allmyles\Common\Price` is in `Classes/Common.php`).
PSR-4 autoloading cannot resolve these, so `src/Allmyles/Client.php` uses manual
`require` chains. `tests/bootstrap.php` requires `Client.php` to load all classes
before PHPUnit runs.

### Known test state
As of the v1.1.0 commit, 18 of 28 tests fail because test expectations are
outdated relative to the current code (e.g. `BookQuery::getData()` returns
`persons`/`bookBasket` but tests expect `passengers`/`bookingId`). These are
pre-existing failures, not caused by the environment.

## PHP 5.6 image notes
`php:5.6-cli` is based on Debian Stretch (EOL). The compose file rewrites
`/etc/apt/sources.list` to `archive.debian.org` and uses `--allow-unauthenticated`
because the Stretch signing keys have expired.
