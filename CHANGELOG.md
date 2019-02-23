# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [0.3.0] - 2019-02-23
### Added
- `array_indentation` fixer.
- `combine_consecutive_issets` fixer.
- `combine_nested_dirname` fixer.
- `dir_constant` fixer.
- `ereg_to_preg` fixer.
- `explicit_string_variable` fixer.
- `implode_call` fixer.
- `is_null` fixer.
- `list_syntax` fixer.
- `logical_operators` fixer.
- `lowercase_cast` fixer.
- `lowercase_static_reference` fixer.
- `magic_constant_casing` fixer.
- `magic_method_casing` fixer.
- `multiline_whitespace_before_semicolons` fixer.
- `native_function_casing` fixer.
- `no_alternative_syntax` fixer.
- `no_homoglyph_names` fixer.
- `no_leading_import_slash` fixer.
- `no_leading_namespace_whitespace` fixer.
- `no_mixed_echo_print` fixer.
- `no_multiline_whitespace_around_double_arrow` fixer.
- `no_php4_constructor` fixer.
- `no_spaces_around_offset` fixer.
- `no_superfluous_elseif` fixer.
- `no_unneeded_control_parentheses` fixer.
- `no_useless_return` fixer.
- `php_unit_construct` fixer.
- `php_unit_expectation` fixer.
- `php_unit_method_casing` fixer.
- `php_unit_mock` fixer.
- `php_unit_namespaced` fixer.
- `php_unit_set_up_tear_down_visibility` fixer.
- `php_unit_strict` fixer.
- `pow_to_exponentiation` fixer.
- `psr4` fixer.
- `return_assignment` fixer.
- `random_api_migration` fixer.
- `self_accessor` fixer.
- `set_type_to_cast` fixer.
- `short_scalar_cast` fixer.
- `space_after_semicolon` fixer.
- `standardize_increment` fixer.
- `standardize_not_equals` fixer.
- `trim_array_spaces` fixer.
- `unary_operator_spaces` fixer.

### Changed
- `friendsofphp/php-cs-fixer` version bumped to `^2.13.0`.

### Fixed
- `ordered_imports` now has fixed order of import types.

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

[Unreleased]: https://github.com/olivierlacan/keep-a-changelog/compare/0.3.0...HEAD
[0.3.0]: https://github.com/elyby/php-code-style/compare/0.2.1...0.3.0
[0.2.1]: https://github.com/elyby/php-code-style/compare/0.2.0...0.2.1
[0.2.0]: https://github.com/elyby/php-code-style/compare/0.1.0...0.2.0
