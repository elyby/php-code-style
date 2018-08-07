<?php
declare(strict_types=1);

namespace Ely\CS;

class Rules {

    private static $rules = [
        '@PSR2' => true,
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
        'compact_nullable_typehint' => true,
        'concat_space' => [
            'spacing' => 'one',
        ],
        'declare_equal_normalize' => true,
        'function_declaration' => [
            'closure_function_spacing' => 'none',
        ],
        'function_to_constant' => true,
        'include' => true,
        'linebreak_after_opening_tag' => true,
        'method_chaining_indentation' => true,
        'modernize_types_casting' => true,
        'no_short_bool_cast' => true,
        'no_trailing_comma_in_singleline_array' => true,
        'no_unneeded_final_method' => true,
        'no_unused_imports' => true,
        'no_useless_else' => true,
        'no_whitespace_before_comma_in_array' => true,
        'no_whitespace_in_blank_line' => true,
        'non_printable_character' => [
            'use_escape_sequences_in_strings' => true,
        ],
        'object_operator_without_whitespace' => true,
        'ordered_class_elements' => true,
        'ordered_imports' => true,
        'random_api_migration' => true,
        'return_type_declaration' => [
            'space_before' => 'none',
        ],
        'single_quote' => true,
        'strict_comparison' => true,
        'ternary_operator_spaces' => true,
        'ternary_to_null_coalescing' => true,
        'trailing_comma_in_multiline_array' => true,
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
