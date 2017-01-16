Analyzes all `composer.json` files found in a given directory structure. Currently finds patches, but could be extended for further analysis.

[![Build Status](https://travis-ci.org/phase2/composer-analytics.svg?branch=master)](https://travis-ci.org/phase2/composer-analytics)

## Installation

```
composer require phase2/composer-analytics
```

## Usage

```
vendor/bin/composer-analyze PATH_TO_DIRECTORY
```

This will write out a CSV to `PATH_TO_DIRECTORY/reports`.
