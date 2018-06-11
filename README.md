# Twig Perversion plugin for Craft CMS

Making twig do things it really shouldn&#39;t. Twig is not intended to be a general purpose programming language, and there are some things that really don't belong in the language. This plugin adds a few of those things anyway.

- `{% break %}`, `{% continue %}`, and `{% return %}` tags
- `is numeric` test
- `json_decode` filter
- `array_splice` filter
- `string` and `s` filters
- `float` and `f` filters
- `int` and `i` filters
- `bool` and `b` filters

## Installation

1. Install with Composer via `composer require marionnewlevant/twig-perversion` from your project directory
2. Install plugin in the Craft Control Panel under Settings > Plugins

or

1. Install via the Plugin Store

## Using Twig Perversion

### Tags

`{% break %}` to exit a for loop:

    {% for straw in haystack %}
      {% if straw == needle %}
        {% break %}
      {% endif %}
    {% endfor %}

`{% continue %}` to continue to next iteration:

    {% for straw in haystack %}
      {% if not isInteresting(straw) %}
        {% continue %}
      {% endif %}
      {# do whatever... #}
    {% endfor %}

`{% return value %}` to return a value from a macro:

    {% macro foo() %}
      {# ... calculate someValue ... #}
      {% return someValue %}
    {% endmacro %}

`{% return %}` to return the empty string form a macro:

    {% macro foo() %}
      {# ... do stuff %}
      {% return %}
    {% endmacro %}

A macro with a `{% return %}` tag will return whatever the return value is (which can be a complex expression). Any other output generated by the macro will be discarded.

### Tests
- **Numeric**

  Test whether given value is numeric (behaviour like PHP 7 `is_numeric`). (Note that as of PHP 7, hexadecimal strings are not considered numeric)

#### Examples

```Twig

{{ 12 is numeric ? 'Yes' : 'No' }}
{# Yes #}

{{ '-1.3' is numeric ? 'Yes' : 'No' }}
{# Yes #}

{{ '0x539' is numeric ? 'Yes' : 'No'}}
{# No #}

```

### Filters
- **json_decode**

  Decode json string, returning php associative arrays. Uses the PHP [json_decode](http://php.net/manual/en/function.json-decode.php) function

- **array_splice**

  Remove a portion of an array and replace it with something else. Uses the PHP [array_splice](http://php.net/manual/en/function.array-splice.php) function. Note that unlike the php function, this filter returns the modified array rather than the extracted elements. The original array is unchanged. Since the implementation requires copying the array, this will be less efficient than the raw php function. The **array_splice** filter is passed an `offset`, an optional `length`, and an optional `replacement`.

- **string** or **s**

  Typecast variable as a string.

- **float** or **f**

  Typecast variable as a float.

- **int** or **i**

  Typecast variable as an integer.

- **bool** or **b**

  Typecast variable as a boolean.

Brought to you by [Marion Newlevant](http://marion.newlevant.com)
