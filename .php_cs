<?php

$finder = Symfony\CS\Finder\DefaultFinder::create()
    ->in([
        __DIR__ . DIRECTORY_SEPARATOR . 'src',
        __DIR__ . DIRECTORY_SEPARATOR . 'tests',
    ])
;

return Symfony\CS\Config\Config::create()
    ->level(Symfony\CS\FixerInterface::NONE_LEVEL)
    ->fixers([
        'psr0',
        'encoding',
        'short_tag',
        'braces',
        'elseif',
        'eof_ending',
        'function_call_space',
        'function_declaration',
        'indentation',
        'line_after_namespace',
        'linefeed',
        'lowercase_constants',
        'lowercase_keywords',
        'method_argument_space',
        'multiple_use',
        'parenthesis',
        'php_closing_tag',
        'single_line_after_imports',
        'trailing_spaces',
        'visibility',
        'blankline_after_open_tag',
//      'concat_without_spaces', // couterpart of concat_with_spaces
        'double_arrow_multiline_whitespaces',
        'duplicate_semicolon',
        'empty_return',
        'extra_empty_lines',
        'include',
        'join_function',
        'list_commas',
        'multiline_array_trailing_comma',
        'namespace_no_leading_whitespace',
        'new_with_braces',
        'no_blank_lines_after_class_opening',
        'no_empty_lines_after_phpdocs',
        'object_operator',
        'operators_spaces',
        'phpdoc_indent',
        'phpdoc_no_empty_return',
        'phpdoc_no_package',
        'phpdoc_params',
        'phpdoc_scalar',
//      'phpdoc_separation', // -> also puts line between @copyright, @link, @license and @version
        'phpdoc_short_description',
        'phpdoc_to_comment',
        'phpdoc_trim',
        'phpdoc_type_to_var',
        'phpdoc_var_without_name',
        'remove_leading_slash_use',
        'remove_lines_between_uses',
        'return',
        'single_array_no_trailing_comma',
        'single_blank_line_before_namespace',
        'single_quote',
        'spaces_before_semicolon',
        'spaces_cast',
        'standardize_not_equal',
        'ternary_spaces',
        'trim_array_spaces',
        'unary_operators_spaces',
        'unused_use',
        'whitespacy_lines',
        'align_double_arrow',
        'align_equals',
        'concat_with_spaces',
        'ereg_to_preg',
//      'header_comment',
//      'long_array_syntax', // -> counterpart of short_array_syntax
        'multiline_spaces_before_semicolon',
        'newline_after_open_tag',
//      'no_blank_lines_before_namespace', // -> counterpart of single_blank_line_before_namespace
        'ordered_use',
//      'php4_constructor', // -> results in internal error ...
//      'phpdoc_order', // -> puts @throws above @returns which I do not want
//      'phpdoc_var_to_type', // -> counterpart of phpdoc_type_to_var
        'short_array_syntax',
//      'strict', // -> do not force, could change code behaviour
//      'strict_param', // -> do not force, could change code behaviour
    ])
    ->finder($finder)
;