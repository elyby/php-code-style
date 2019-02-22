# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [0.2.1] - 2019-02-22
### Fixed
- Compatibility with the `friendsofphp/php-cs-fixer` version 2.13.3 and above.

## [0.2.0] - 2018-08-08
### Added
- Enh #4: `Ely\remove_class_name_method_usages` fixer.
- `array_syntax` fixer.
- This changelog file.
- Travis CI building.

### Changed
- `friendsofphp/php-cs-fixer` version bumped to `^2.12.2`.
- `phpunit/phpunit` downgraded to `^6.5.1` to be compatible with PHP 7.0.

### Fixed
- Bug #5: `Ely/line_break_after_statements` triggers error if statement doesn't have control brackets.

## 0.1.0 - 2018-04-17
### Added
- First release

[Unreleased]: https://github.com/olivierlacan/keep-a-changelog/compare/0.2.0...HEAD
[0.2.0]: https://github.com/elyby/php-code-style/compare/0.1.0...0.2.0
