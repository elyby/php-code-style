# Ely.by PHP-CS-Fixer rules

Set of PHP-CS-Fixer rules used in development of Ely.by PHP projects. It's suited for PHP 7.4 and above.

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-build-status]][link-build-status]

## Installation

First of all install Ely.by PHP-CS-Fixer rules via composer with
[PHP-CS-Fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer):

```sh
composer require --dev friendsofphp/php-cs-fixer ely/php-code-style
```

Then create a file `.php-cs-fixer.php` with the following contents:

```php
<?php
$finder = \PhpCsFixer\Finder::create()
    ->in(__DIR__);

return \Ely\CS\Config::create()
    ->setFinder($finder);
```

And that's it. You can now find code style violations with following command:

```sh
vendor/bin/php-cs-fixer --diff --dry-run -v fix 
```

And then completely fix them all with:

```sh
vendor/bin/php-cs-fixer fix
```

### Configuration

You can pass a custom set of rules to the `\Ely\CS\Config::create()` call. For example, it can be used to validate a
project with PHP 7.4 compatibility:

```php
<?php
return \Ely\CS\Config::create([
    'trailing_comma_in_multiline' => [
        'elements' => ['arrays', 'arguments'],
    ],
])->setFinder($finder);
```

## Code style

Our code style is based primarily on [PSR-2](https://www.php-fig.org/psr/psr-2/), while borrowing some ideas from
[PSR-12](https://github.com/php-fig/fig-standards/blob/92b198bb/proposed/extended-coding-style-guide.md)
with some changes.

### Example

This example encompasses some of the rules below as a quick overview:

```php
<?php
declare(strict_types=1);

namespace Vendor\Package;

use Vendor\Package\SomeNamespace\ClassA;

class Foo extends Bar implements FooInterface {
    use SomeTrait;

    private const SAMPLE_1 = 123;
    private const SAMPLE_2 = 321;

    public Typed $field1;

    public $field2;

    public function sampleFunction(
        int $a,
        private readonly int $b = null,
    ): array {
        if ($a === $this->b) {
            $result = bar();
        } else {
            $result = BazClass::bar($this->field1, $this->field2);
        }

        return $result;
    }

    public function setToNull(): self {
        $this->field1 = null;
        return $this;
    }

}
```

**Key differences:**

* Opening braces for classes MUST be **on the same line**.

* Opening braces for methods MUST be **on the next line**.

**Additional rules:**

* There MUST be one empty line before `return` statement, except when there is only one statement before it.
  
  ```php
  <?php
  
  function a() {
      $a = '123';
      return $a . ' is a number';
  }

  function b() {
      $a = '123';
      $b = 'is';

      return $a . ' ' . $b . ' a number';
  }
  ```

* There MUST be one blank line around class body, but there MUST be **no blank lines** around anonymous class body.
  
  ```php
  <?php
  class Test {
  
      public function method() {
          $obj = new class extends Foo {
              public function overriddenMethod() {
                  // code body
              }
          };
      }
  
  }
  ```

* Visibility MUST be declared for all methods, properties and constants.

* There MUST be one blank line after an each of `if`, `switch`, `for`, `foreach`, `while` and `do-while` bodies.
  
  ```php
  <?php
  if (true) {
      // some actions here
  }
  
  echo 'the next statement is here';
  ```

* There MUST be no alignment around multiline function parameters.
  
  ```php
  <?php
  function foo(
      string $input,
      int $key = 0,
  ): void {}
  ```

[ico-version]: https://img.shields.io/packagist/v/ely/php-code-style.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-Apache-green.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/ely/php-code-style.svg?style=flat-square
[ico-build-status]: https://img.shields.io/github/actions/workflow/status/elyby/php-code-style/ci.yml?branch=master&style=flat-square

[link-packagist]: https://packagist.org/packages/ely/php-code-style
[link-downloads]: https://packagist.org/packages/ely/php-code-style/stats
[link-build-status]: https://github.com/elyby/php-code-style/actions
