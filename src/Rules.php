<?php
declare(strict_types=1);

namespace Ely\CS;

class Rules {

    public static function create(array $overwrittenRules = []): array {
        return array_merge([
            '@PSR2' => true,

            // Alias
            'ereg_to_preg' => true,
            'modernize_strpos' => PHP_MAJOR_VERSION >= 8,
            'no_mixed_echo_print' => true,
            'pow_to_exponentiation' => true,
            'random_api_migration' => [
                'replacements' => [
                    'getrandmax' => 'mt_getrandmax',
                    'rand' => 'random_int',
                    'srand' => 'mt_srand',
                ],
            ],
            'set_type_to_cast' => true,

            // Array Notation
            'array_syntax' => [
                'syntax' => 'short',
            ],
            'no_multiline_whitespace_around_double_arrow' => true,
            'no_whitespace_before_comma_in_array' => true,
            'normalize_index_brace' => true,
            'trim_array_spaces' => true,
            'whitespace_after_comma_in_array' => true,

            // Basic
            'braces' => [
                'allow_single_line_anonymous_class_with_empty_body' => true,
                'position_after_functions_and_oop_constructs' => 'same',
            ],
            'no_multiple_statements_per_line' => true,
            'no_trailing_comma_in_singleline' => true,
            'non_printable_character' => [
                'use_escape_sequences_in_strings' => true,
            ],
            'octal_notation' => PHP_MAJOR_VERSION >= 8 && PHP_MINOR_VERSION >= 1,
            'psr_autoloading' => true,

            // Casing
            'class_reference_name_casing' => true,
            'integer_literal_case' => true,
            'lowercase_static_reference' => true,
            'magic_constant_casing' => true,
            'magic_method_casing' => true,
            'native_function_casing' => true,
            'native_function_type_declaration_casing' => true,

            // Cast Notation
            'cast_spaces' => [
                'space' => 'none',
            ],
            'lowercase_cast' => true,
            'modernize_types_casting' => true,
            'no_short_bool_cast' => true,
            'no_unset_cast' => true,
            'short_scalar_cast' => true,

            // Class Notation
            'class_attributes_separation' => [
                'elements' => [
                    'method' => 'one',
                    'property' => 'one',
                ],
            ],
            'no_null_property_initialization' => true,
            'no_php4_constructor' => true,
            'no_unneeded_final_method' => true,
            'ordered_class_elements' => true,
            'single_trait_insert_per_statement' => true,
            'visibility_required' => true,

            // Comment
            'comment_to_phpdoc' => true,
            'multiline_comment_opening_closing' => true,
            'no_empty_comment' => true,
            'single_line_comment_spacing' => true,
            'single_line_comment_style' => true,

            // Control Structure
            'empty_loop_body' => true,
            'empty_loop_condition' => true,
            'include' => true,
            'no_alternative_syntax' => true,
            'no_superfluous_elseif' => true,
            'no_unneeded_control_parentheses' => true,
            'no_useless_else' => true,
            'switch_continue_to_break' => true,
            'trailing_comma_in_multiline' => [
                'elements' => PHP_MAJOR_VERSION >= 8
                    ? ['arrays', 'arguments', 'parameters', 'match']
                    : ['arrays', 'arguments'],
            ],
            'yoda_style' => [
                'equal' => false,
                'identical' => false,
                'less_and_greater' => false,
            ],

            // Function Notation
            'combine_nested_dirname' => true,
            'function_declaration' => [
                'closure_function_spacing' => 'none',
                'closure_fn_spacing' => 'none',
            ],
            'function_typehint_space' => true,
            'implode_call' => true,
            'lambda_not_used_import' => true,
            'return_type_declaration' => true,

            // Import
            'no_leading_import_slash' => true,
            'no_unneeded_import_alias' => true,
            'no_unused_imports' => true,
            'ordered_imports' => [
                'imports_order' => ['class', 'function', 'const'],
            ],

            // Language Construct
            'combine_consecutive_issets' => true,
            'combine_consecutive_unsets' => true,
            'declare_equal_normalize' => true,
            'declare_parentheses' => true,
            'dir_constant' => true,
            'function_to_constant' => true,
            'is_null' => true,

            // List Notation
            'list_syntax' => true,

            // Namespace Notation
            'clean_namespace' => true,
            'no_leading_namespace_whitespace' => true,

            // Naming
            'no_homoglyph_names' => true,

            // Operator
            'assign_null_coalescing_to_coalesce_equal' => true,
            'binary_operator_spaces' => true,
            'concat_space' => [
                'spacing' => 'one',
            ],
            'logical_operators' => true,
            'new_with_braces' => [
                'anonymous_class' => false,
            ],
            'no_useless_concat_operator' => true,
            'no_useless_nullsafe_operator' => true,
            'object_operator_without_whitespace' => true,
            'operator_linebreak' => true,
            'standardize_increment' => true,
            'standardize_not_equals' => true,
            'ternary_operator_spaces' => true,
            'ternary_to_null_coalescing' => true,
            'unary_operator_spaces' => true,

            // PHP Tag
            'linebreak_after_opening_tag' => true,

            // PHPUnit
            'php_unit_construct' => true,
            'php_unit_dedicate_assert_internal_type' => true,
            'php_unit_expectation' => true,
            'php_unit_fqcn_annotation' => true,
            'php_unit_method_casing' => true,
            'php_unit_mock' => true,
            'php_unit_mock_short_will_return' => true,
            'php_unit_namespaced' => true,
            'php_unit_no_expectation_annotation' => true,
            'php_unit_set_up_tear_down_visibility' => true,
            'php_unit_strict' => true,
            'php_unit_test_case_static_method_calls' => [
                'call_type' => 'this',
            ],

            // Return Notation
            'no_useless_return' => true,
            'return_assignment' => true,
            'simplified_null_return' => true,

            // Semicolon
            'multiline_whitespace_before_semicolons' => true,
            'no_empty_statement' => true,
            'no_singleline_whitespace_before_semicolons' => true,
            'semicolon_after_instruction' => true,
            'space_after_semicolon' => true,

            // Strict
            'strict_comparison' => true,

            // String notation
            'explicit_string_variable' => true,
            'simple_to_complex_string_variable' => true,
            'single_quote' => true,

            // Whitespace
            'array_indentation' => true,
            'compact_nullable_typehint' => true,
            'method_chaining_indentation' => true,
            'no_spaces_around_offset' => true,
            'no_whitespace_in_blank_line' => true,
            'types_spaces' => [
                'space_multiple_catch' => 'none',
            ],

            // kubawerlos fixers
            'PhpCsFixerCustomFixers/multiline_promoted_properties' => [
                'minimum_number_of_parameters' => 2,
            ],

            // Our custom or extended fixers
            'Ely/align_multiline_parameters' => [
                'variables' => false,
                'defaults' => false,
            ],
            'Ely/blank_line_around_class_body' => [
                'apply_to_anonymous_classes' => false,
            ],
            'Ely/blank_line_before_return' => true,
            'Ely/line_break_after_statements' => true,
            'Ely/remove_class_name_method_usages' => true,
        ], $overwrittenRules);
    }

}
