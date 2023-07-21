# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [1.0.1] - 2023-07-21
### Changed
- `comment_to_phpdoc` no longer fixes PHPStan error suppression and the `todo` tag.

## [1.0.0] - 2023-05-17
### Added
- `single_space_around_construct` fixer.
- `no_extra_blank_lines` fixer.

### Changed
- `friendsofphp/php-cs-fixer` version bumped to `^3.16`.

### Removed
- Iss #16: All custom fixers have been moved to the [separate repository](https://github.com/erickskrauch/php-cs-fixer-custom-fixers).
- Usage of the `braces_fixer` since it's deprecated.

## [0.5.0] - 2023-04-08
### Added
- Enh #12: Implemented `Ely\align_multiline_parameters` fixer.
- Enh #13: Implemented `Ely\multiline_if_statement_braces` fixer.
- Enabled `Ely\align_multiline_parameters` for Ely.by codestyle in `['types' => false, 'defaults' => false]` mode.
- Enabled `Ely\multiline_if_statement_braces` for Ely.by codestyle in `['keep_on_own_line' => true]` mode.
- Enabled
  [`PhpCsFixerCustomFixers/multiline_promoted_properties`](https://github.com/kubawerlos/php-cs-fixer-custom-fixers#multilinepromotedpropertiesfixer)
  fixer for Ely.by codestyle in 2+ parameters mode.

### Fixed
- Bug #10: `Ely/blank_line_before_return` don't treat interpolation curly bracket as beginning of the scope.
- Bug #9: `Ely/line_break_after_statements` add space before next meaningful line of code and skip comments.

## [0.4.0] - 2022-12-06
### Added
- `simple_to_complex_string_variable` fixer.
- `single_trait_insert_per_statement` fixer.
- `native_function_type_declaration_casing` fixer.
- `php_unit_mock_short_will_return` fixer.
- `php_unit_dedicate_assert_internal_type` fixer.
- `php_unit_no_expectation_annotation` fixer.
- `modernize_strpos` fixer.
- `no_multiple_statements_per_line` fixer.
- `octal_notation` fixer.
- `class_reference_name_casing` fixer.
- `integer_literal_case` fixer.
- `no_unset_cast` fixer.
- `no_null_property_initialization` fixer.
- `comment_to_phpdoc` fixer.
- `multiline_comment_opening_closing` fixer.
- `no_empty_comment` fixer.
- `single_line_comment_spacing` fixer.
- `single_line_comment_style` fixer.
- `empty_loop_body` fixer.
- `empty_loop_condition` fixer.
- `switch_continue_to_break` fixer.
- `yoda_style` fixer in non-yoda mode.
- `function_typehint_space` fixer.
- `lambda_not_used_import` fixer.
- `no_unneeded_import_alias` fixer.
- `combine_consecutive_unsets` fixer.
- `declare_parentheses` fixer.
- `clean_namespace` fixer.
- `assign_null_coalescing_to_coalesce_equal` fixer.
- `no_useless_nullsafe_operator` fixer.
- `operator_linebreak` fixer.
- `php_unit_fqcn_annotation` fixer.
- `php_unit_test_case_static_method_calls` fixer.
- `simplified_null_return` fixer.
- `no_empty_statement` fixer.
- `no_singleline_whitespace_before_semicolons` fixer.
- `semicolon_after_instruction` fixer.
- `types_spaces` fixer.
- `no_trailing_comma_in_singleline` fixer.
- `no_useless_concat_operator` fixer.

### Changed
- `friendsofphp/php-cs-fixer` version bumped to `^3`.
- `braces` fixer now enables rule `allow_single_line_anonymous_class_with_empty_body`.
- `class_attributes_separation` fixer now fixes `const` in the `only_if_meta` mode.

### Removed
- `Ely/new_with_braces` since all its functionality is now included in the original fixer.
- `self_accessor` fixer because it leads to errors in interfaces, that returns self.

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

[Unreleased]: https://github.com/elyby/php-code-style/compare/1.0.1...HEAD
[1.0.1]: https://github.com/elyby/php-code-style/compare/1.0.0...1.0.1
[1.0.0]: https://github.com/elyby/php-code-style/compare/0.5.0...1.0.0
[0.5.0]: https://github.com/elyby/php-code-style/compare/0.4.0...0.5.0
[0.4.0]: https://github.com/elyby/php-code-style/compare/0.3.0...0.4.0
[0.3.0]: https://github.com/elyby/php-code-style/compare/0.2.1...0.3.0
[0.2.1]: https://github.com/elyby/php-code-style/compare/0.2.0...0.2.1
[0.2.0]: https://github.com/elyby/php-code-style/compare/0.1.0...0.2.0
