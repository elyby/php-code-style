<?php
declare(strict_types=1);

namespace Ely\CS\Test\Fixer\Whitespace;

use Ely\CS\Fixer\Whitespace\LineBreakAfterStatementsFixer;
use PhpCsFixer\AbstractFixer;
use PhpCsFixer\Tests\Test\AbstractFixerTestCase;

/**
 * @covers \Ely\CS\Fixer\Whitespace\LineBreakAfterStatementsFixer
 *
 * @author ErickSkrauch <erickskrauch@ely.by>
 */
class LineBreakAfterStatementsFixerTest extends AbstractFixerTestCase {

    /**
     * @dataProvider provideFixCases
     */
    public function testFix(string $expected, ?string $input = null): void {
        $this->doTest($expected, $input);
    }

    public function provideFixCases(): iterable {
        // Simple cases
        yield [
            '<?php
class Foo
{
    public function foo()
    {
        if ("a" === "b") {
            // code
        }

        $a = "next statement";
    }
}',
            '<?php
class Foo
{
    public function foo()
    {
        if ("a" === "b") {
            // code
        }
        $a = "next statement";
    }
}',
        ];

        yield [
            '<?php
class Foo
{
    public function foo()
    {
        if ("a" === "b") {
            // code
        } else {
            // another code
        }

        $a = "next statement";
    }
}',
            '<?php
class Foo
{
    public function foo()
    {
        if ("a" === "b") {
            // code
        } else {
            // another code
        }
        $a = "next statement";
    }
}',
        ];

        yield [
            '<?php
class Foo
{
    public function foo()
    {
        for ($i = 0; $i < 3; $i++) {
            // code
        }

        $a = "next statement";
    }
}',
            '<?php
class Foo
{
    public function foo()
    {
        for ($i = 0; $i < 3; $i++) {
            // code
        }
        $a = "next statement";
    }
}',
        ];

        yield [
            '<?php
class Foo
{
    public function foo()
    {
        foreach (["foo", "bar"] as $str) {
            // code
        }

        $a = "next statement";
    }
}',
            '<?php
class Foo
{
    public function foo()
    {
        foreach (["foo", "bar"] as $str) {
            // code
        }
        $a = "next statement";
    }
}',
        ];

        yield [
            '<?php
class Foo
{
    public function foo()
    {
        while ($i < 10) {
            // code
        }

        $a = "next statement";
    }
}',
            '<?php
class Foo
{
    public function foo()
    {
        while ($i < 10) {
            // code
        }
        $a = "next statement";
    }
}',
        ];

        yield [
            '<?php
class Foo
{
    public function foo()
    {
        do {
            // code
        } while ($i < 10);

        $a = "next statement";
    }
}',
            '<?php
class Foo
{
    public function foo()
    {
        do {
            // code
        } while ($i < 10);
        $a = "next statement";
    }
}',
        ];

        yield [
            '<?php
class Foo
{
    public function foo()
    {
        switch ("str") {
            case "a":
                break;
            case "b":
                break;
            default:
                // code
        }

        $a = "next statement";
    }
}',
            '<?php
class Foo
{
    public function foo()
    {
        switch ("str") {
            case "a":
                break;
            case "b":
                break;
            default:
                // code
        }
        $a = "next statement";
    }
}',
        ];

        // Extended cases
        yield [
            '<?php
class Foo
{
    public function bar()
    {
        if ("a" === "b") {
            // code
        } else if ("a" === "c") {
            // code
        } else if ("a" === "d") {
            // code
        }

        $a = "next statement";
    }
}',
            '<?php
class Foo
{
    public function bar()
    {
        if ("a" === "b") {
            // code
        } else if ("a" === "c") {
            // code
        } else if ("a" === "d") {
            // code
        }
        $a = "next statement";
    }
}',
        ];

        yield [
            '<?php
class Foo
{
    public function bar()
    {
        if ("a" === "b") {
            // code
        } elseif ("a" === "c") {
            // code
        } elseif ("a" === "d") {
            // code
        }

        $a = "next statement";
    }
}',
            '<?php
class Foo
{
    public function bar()
    {
        if ("a" === "b") {
            // code
        } elseif ("a" === "c") {
            // code
        } elseif ("a" === "d") {
            // code
        }
        $a = "next statement";
    }
}',
        ];

        yield [
            '<?php
class Foo
{
    public function bar()
    {
        foreach (["foo", "bar"] as $str) {
            if ($str === "foo") {
                // code
            }
        }
    }
}',
            '<?php
class Foo
{
    public function bar()
    {
        foreach (["foo", "bar"] as $str) {
            if ($str === "foo") {
                // code
            }

        }
    }
}',
        ];

        yield [
            '<?php
class Foo
{
    public function foo()
    {
        switch ("str") {
            case "a": {
                break;
            }
            case "b": {
                break;
            }
            default: {
                // code
            }
        }

        $a = "next statement";
    }
}',
            '<?php
class Foo
{
    public function foo()
    {
        switch ("str") {
            case "a": {
                break;
            }
            case "b": {
                break;
            }
            default: {
                // code
            }
        }
        $a = "next statement";
    }
}',
        ];

        yield [
            '<?php
$a = "prev statement";
foreach ($coordinates as $coordinate) {
    $points = explode(",", $coordinate);
}
',
        ];

        // Issue 5
        yield [
            '<?php
class Foo
{
    public function foo()
    {
        if ("a" === "b")
            $this->bar();

        $a = "next statement";
    }
}',
            '<?php
class Foo
{
    public function foo()
    {
        if ("a" === "b")
            $this->bar();
        $a = "next statement";
    }
}',
        ];

        yield [
            '<?php
class Foo
{
    public function foo()
    {
        if ("a" === "b")
            $this->bar();
        else
            $this->baz();

        $a = "next statement";
    }
}',
            '<?php
class Foo
{
    public function foo()
    {
        if ("a" === "b")
            $this->bar();
        else
            $this->baz();
        $a = "next statement";
    }
}',
        ];

        yield [
            '<?php
class Foo
{
    public function foo()
    {
        for ($i = 0; $i < 3; $i++)
            $this->bar();

        $a = "next statement";
    }
}',
            '<?php
class Foo
{
    public function foo()
    {
        for ($i = 0; $i < 3; $i++)
            $this->bar();
        $a = "next statement";
    }
}',
        ];

        yield [
            '<?php
class Foo
{
    public function foo()
    {
        foreach (["foo", "bar"] as $str)
            $this->bar();

        $a = "next statement";
    }
}',
            '<?php
class Foo
{
    public function foo()
    {
        foreach (["foo", "bar"] as $str)
            $this->bar();
        $a = "next statement";
    }
}',
        ];

        yield [
            '<?php
class Foo
{
    public function foo()
    {
        while ($i < 10)
            $this->bar();

        $a = "next statement";
    }
}',
            '<?php
class Foo
{
    public function foo()
    {
        while ($i < 10)
            $this->bar();
        $a = "next statement";
    }
}',
        ];

        yield [
            '<?php
class Foo
{
    public function foo()
    {
        do
            $this->bar();
        while ($i < 10);

        $a = "next statement";
    }
}',
            '<?php
class Foo
{
    public function foo()
    {
        do
            $this->bar();
        while ($i < 10);
        $a = "next statement";
    }
}',
        ];

        yield [
            '<?php
class Foo
{
    public function bar()
    {
        if ("a" === "b")
            $this->foo();
        else if ("a" === "c")
            $this->bar();
        else if ("a" === "d")
            $this->baz();

        $a = "next statement";
    }
}',
            '<?php
class Foo
{
    public function bar()
    {
        if ("a" === "b")
            $this->foo();
        else if ("a" === "c")
            $this->bar();
        else if ("a" === "d")
            $this->baz();
        $a = "next statement";
    }
}',
        ];

        yield [
            '<?php
class Foo
{
    public function bar()
    {
        foreach (["foo", "bar"] as $str)
            if ($str === "foo")
                $this->bar();

        return 3;
    }
}',
            '<?php
class Foo
{
    public function bar()
    {
        foreach (["foo", "bar"] as $str)
            if ($str === "foo")
                $this->bar();
        return 3;
    }
}',
        ];
    }

    protected function createFixer(): AbstractFixer {
        return new LineBreakAfterStatementsFixer();
    }

}
