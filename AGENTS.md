# AGENTS.md — Base44 dev notes for allmyles-sdk-php

## What this project is
This is **allmyles-sdk-php**, a PHP SDK library (Composer package) for the Allmyles
travel API. It is **not a web application** — there is no web server, no frontend,
and no product HTTP entry point. A read-only SDK status page is served on port 3000
for the sandbox preview. The PHPUnit test suite verifies SDK behavior.

## Tech stack
- PHP 5.3+ (tested with `php:5.6-cli` in Docker)
- Composer for dependency management
- PHPUnit 4.1.* (dev dependency, from `composer.lock`)

## Running the tests
```bash
docker compose -f docker-compose.base44.yml run --rm test
```
This one-shot service installs git/zip/unzip, runs `composer install`, then
runs `vendor/bin/phpunit --bootstrap tests/bootstrap.php tests/`.

### Why a custom bootstrap is needed
The source files live in `src/Allmyles/Classes/` but their namespaces omit the
`Classes` segment (e.g. `Allmyles\Common\Price` is in `Classes/Common.php`).
PSR-4 autoloading cannot resolve these, so `src/Allmyles/Client.php` uses manual
`require` chains. `tests/bootstrap.php` requires `Client.php` to load all classes
before PHPUnit runs.

### Test state
All 28 tests pass after aligning stale assertions with the SDK's existing output.
The test runner is an opt-in one-shot Compose service, not an always-on app service.

## PHP 5.6 image notes
`php:5.6-cli` is based on Debian Stretch (EOL). The compose file rewrites
`/etc/apt/sources.list` to `archive.debian.org` and uses `--allow-unauthenticated`
because the Stretch signing keys have expired.
