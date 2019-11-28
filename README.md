# Idiosyncratic Developer Tools

A Composer plugin/"metapackage" to install and configure development tools. Currently includes:

- [PHP Codesniffer](https://github.com/squizlabs/PHP_CodeSniffer)
- [Behat](http://behat.org/en/latest/)
- [The Idiosyncratic Coding Standard](https://github.com/idiosyncratic-code/coding-standard)
- [PHP Parallel Lint](https://github.com/JakubOnderka/PHP-Parallel-Lint)
- [PHPLOC](https://github.com/sebastianbergmann/phploc)
- [PHPSpec](http://www.phpspec.net/en/stable/)
- [PHPUnit](https://phpunit.de)
- [PHPCPD](https://github.com/sebastianbergmann/phpcpd)
- [PHPstan](https://github.com/phpstan/phpstan)

## Installation and Usage

Install with [Composer](https://getcomposer.org):

```
composer require --dev idiosyncratic/devtools
```

On `composer update` and `composer install`, the plugin will create default configuration files for select tools if they do not exist. The following tools are currently supported:

- PHPStan
- PHPUnit
- PHP Codesniffer
