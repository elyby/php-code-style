<?php
declare(strict_types=1);

namespace Ely\CS\Test\Fixer\Whitespace;

use Ely\CS\Fixer\Whitespace\LineBreakAfterStatementsFixer;
use PhpCsFixer\Tests\Test\AbstractFixerTestCase;

/**
 * @covers \Ely\CS\Fixer\Whitespace\LineBreakAfterStatementsFixer
 *
 * @author ErickSkrauch <erickskrauch@ely.by>
 */
class LineBreakAfterStatementsFixerTest extends AbstractFixerTestCase {

    /**
     * @param string $expected
     * @param string $input
     *
     * @dataProvider provideFixCases
     */
    public function testFix(string $expected, $input = null) {
        $this->doTest($expected, $input);
    }

    public function provideFixCases() {
        $cases = [];

        // Simple cases
        $cases[] = [
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
        $cases[] = [
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
        $cases[] = [
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
        $cases[] = [
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
        $cases[] = [
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
        $cases[] = [
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
        $cases[] = [
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
        $cases[] = [
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
        $cases[] = [
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
        $cases[] = [
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
        $cases[] = [
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
        $cases[] = [
            '<?php
$a = "prev statement";
foreach ($coordinates as $coordinate) {
    [$x, $y] = explode(\',\', $coordinate);
}
',
        ];

        return $cases;
    }

    protected function createFixer() {
        return new LineBreakAfterStatementsFixer();
    }

}
