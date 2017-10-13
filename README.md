[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/vanbrabantf/npm-stat-fetcher/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/vanbrabantf/npm-stat-fetcher/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/vanbrabantf/npm-stat-fetcher/badges/build.png?b=master)](https://scrutinizer-ci.com/g/vanbrabantf/npm-stat-fetcher/build-status/master)

## Purpose

A simple package written in PHP that fetches statistics from NPM.
It's mostly a wrapper around the NPM-API.

## Installation

Installation can be done easily through composer.

```
composer require vanbrabantf\npm-stat-fetcher
```

## Usage

First of all you need a Package object. This is easily created from the Project Value Object:

```php
$package = new Vanbrabantf\NpmStatFetcher\ValueObjects\Package('npm');
```

Next up we want to creat the fetcher itself with the `$package`:
```php
$statFetcher = new Vanbrabantf\NpmStatFetcher\StatFetcher($package);
```

Finally you can fetch download statistics from the class.
