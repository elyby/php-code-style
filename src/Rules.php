<?php
declare(strict_types=1);

namespace Ely\CS;

class Rules {

    private static $rules = [
        '@PSR2' => true,
        'array_indentation' => true,
        'array_syntax' => [
            'syntax' => 'short',
        ],
        'binary_operator_spaces' => true,
        'braces' => [
            'position_after_functions_and_oop_constructs' => 'same',
        ],
        'cast_spaces' => [
            'space' => 'none',
        ],
        'class_attributes_separation' => [
            'elements' => ['method', 'property'],
        ],
        'combine_consecutive_issets' => true,
        'combine_nested_dirname' => true,
        'compact_nullable_typehint' => true,
        'concat_space' => [
            'spacing' => 'one',
        ],
        'declare_equal_normalize' => true,
        'dir_constant' => true,
        'ereg_to_preg' => true,
        'explicit_string_variable' => true, // Should be configurable to choose between ${var} and {$var}
        'function_declaration' => [
            'closure_function_spacing' => 'none',
        ],
        'function_to_constant' => true,
        'implode_call' => true,
        'include' => true,
        'is_null' => true,
        'linebreak_after_opening_tag' => true,
        'list_syntax' => [
            'syntax' => 'short',
        ],
        'logical_operators' => true,
        'lowercase_cast' => true,
        'lowercase_static_reference' => true,
        'magic_constant_casing' => true,
        'magic_method_casing' => true,
        'method_chaining_indentation' => true,
        'modernize_types_casting' => true,
        'multiline_whitespace_before_semicolons' => [
            'strategy' => 'no_multi_line',
        ],
        'native_function_casing' => true,
        'native_function_type_declaration_casing' => true,
        'no_alternative_syntax' => true,
        'no_homoglyph_names' => true,
        'no_leading_import_slash' => true,
        'no_leading_namespace_whitespace' => true,
        'no_mixed_echo_print' => true,
        'no_multiline_whitespace_around_double_arrow' => true,
        'no_php4_constructor' => true,
        'no_short_bool_cast' => true,
        'no_spaces_around_offset' => true,
        'no_superfluous_elseif' => true,
        'no_trailing_comma_in_singleline_array' => true,
        'no_unneeded_control_parentheses' => true,
        'no_unneeded_final_method' => true,
        'no_unused_imports' => true,
        'no_useless_else' => true,
        'no_useless_return' => true,
        'no_whitespace_before_comma_in_array' => true,
        'no_whitespace_in_blank_line' => true,
        'non_printable_character' => [
            'use_escape_sequences_in_strings' => true,
        ],
        'normalize_index_brace' => true,
        'object_operator_without_whitespace' => true,
        'ordered_class_elements' => true,
        'ordered_imports' => [
            'imports_order' => ['class', 'function', 'const'],
        ],
        'php_unit_construct' => true,
        'php_unit_dedicate_assert_internal_type' => true,
        'php_unit_expectation' => true,
        'php_unit_method_casing' => true,
        'php_unit_mock' => true,
        'php_unit_mock_short_will_return' => true,
        'php_unit_namespaced' => true,
        'php_unit_no_expectation_annotation' => true,
        'php_unit_set_up_tear_down_visibility' => true,
        'php_unit_strict' => true,
        'pow_to_exponentiation' => true,
        'psr4' => true,
        'return_assignment' => true,
        'random_api_migration' => [
            'replacements' => [
                'getrandmax' => 'mt_getrandmax',
                'rand' => 'random_int',
                'srand' => 'mt_srand',
            ],
        ],
        'return_type_declaration' => [
            'space_before' => 'none',
        ],
        'set_type_to_cast' => true,
        'short_scalar_cast' => true,
        'simple_to_complex_string_variable' => true,
        'single_trait_insert_per_statement' => true,
        'single_quote' => true,
        'space_after_semicolon' => true,
        'standardize_increment' => true,
        'standardize_not_equals' => true,
        'strict_comparison' => true,
        'ternary_operator_spaces' => true,
        'ternary_to_null_coalescing' => true,
        'trailing_comma_in_multiline_array' => true,
        'trim_array_spaces' => true,
        'unary_operator_spaces' => true,
        'visibility_required' => [
            'elements' => ['property', 'method', 'const'],
        ],
        'whitespace_after_comma_in_array' => true,
        // Our custom or extended fixers
        'Ely/blank_line_around_class_body' => [
            'apply_to_anonymous_classes' => false,
        ],
        'Ely/blank_line_before_return' => true,
        'Ely/line_break_after_statements' => true,
        'Ely/new_with_braces' => [
            'remove_for_anonymous_classes' => true,
        ],
        'Ely/remove_class_name_method_usages' => true,
    ];

    public static function create(array $overwrittenRules = []): array {
        return array_merge(self::$rules, $overwrittenRules);
    }

}
