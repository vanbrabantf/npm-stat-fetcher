[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/vanbrabantf/npm-stat-fetcher/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/vanbrabantf/npm-stat-fetcher/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/vanbrabantf/npm-stat-fetcher/badges/build.png?b=master)](https://scrutinizer-ci.com/g/vanbrabantf/npm-stat-fetcher/build-status/master)

## Purpose

A simple package written in PHP that fetches statistics from NPM. It's mostly a wrapper around the NPM-API.

## Installation

Installation can be done easily through composer.

```
composer require vanbrabantf/npm-stat-fetcher
```

## Usage

**tl;dr:** Usage of the package is pretty simple, just pass the name of the `npm` package you would like to get the stats off to the methods inside of the `StatFetcher` class. 


You can import the class like this: 

```php
$statFetcher = new Vanbrabantf\NpmStatFetcher\StatFetcher();
```

### Available methods

Will return the downloads of the previous day:

```php
$statFetcher->getDownloadsLastDay('jquery');
```

Will return the downloads of the previous week:

```php
$statFetcher->getDownloadsLastWeek('jquery');
```

Will return the downloads of the previous month:

```php
$statFetcher->getDownloadsLastMonth('jquery');
```

Will return the downloads of the previous year:

```php
$statFetcher->getDownloadsLastYear('jquery');
```

Will return the total downloads:

```php
$statFetcher->getDownloads('jquery');
```

Will return the total downloads between 2 dates:

```php
$start = new DateTime('1989-12-13');
$end = new DateTime('1988-11-07');
$statFetcher->getDownloadsBetweenDates('jquery', $start, $end);
```

### What it will return

The methods will return `DownloadStatistics` objects. These are value objects that have values for the dates, download counts and package information.
