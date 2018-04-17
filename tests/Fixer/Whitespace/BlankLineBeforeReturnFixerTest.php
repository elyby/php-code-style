<?php
declare(strict_types=1);

namespace Ely\CS\Test\Fixer\Whitespace;

use Ely\CS\Fixer\Whitespace\BlankLineBeforeReturnFixer;
use PhpCsFixer\Tests\Test\AbstractFixerTestCase;
use PhpCsFixer\WhitespacesFixerConfig;

/**
 * Original file copied from:
 * @url https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/5c5de791ab/tests/Fixer/Whitespace/BlankLineBeforeStatementFixerTest.php
 *
 * @author Dariusz Rumiński <dariusz.ruminski@gmail.com>
 * @author Andreas Möller <am@localheinz.com>
 * @author SpacePossum
 *
 * @internal
 *
 * @property BlankLineBeforeReturnFixer $fixer
 *
 * @covers \Ely\CS\Fixer\Whitespace\BlankLineBeforeReturnFixer
 */
final class BlankLineBeforeReturnFixerTest extends AbstractFixerTestCase {

    /**
     * @param string      $expected
     * @param null|string $input
     *
     * @dataProvider provideFixCases
     */
    public function testFix($expected, $input = null) {
        $this->doTest($expected, $input);
    }

    public function provideFixCases() {
        $cases = [];
        $cases[] = [
                '$a = $a;
return $a;
',
        ];
        $cases[] = [
            '<?php
$a = $a;

return $a;',
            '<?php
$a = $a; return $a;',
        ];
        $cases[] = [
            '<?php
$b = $b;

return $b;',
            '<?php
$b = $b;return $b;',
        ];
        $cases[] = [
            '<?php
$c = $c;

return $c;',
            '<?php
$c = $c;
return $c;',
        ];
        $cases[] = [
            '<?php
    $d = $d;

    return $d;',
            '<?php
    $d = $d;
    return $d;',
        ];
        $cases[] = [
            '<?php
    if (true) {
        return 1;
    }',
        ];
        $cases[] = [
            '<?php
    if (true)
        return 1;
    ',
        ];
        $cases[] = [
            '<?php
    if (true) {
        return 1;
    } else {
        return 2;
    }',
        ];
        $cases[] = [
            '<?php
    if (true)
        return 1;
    else
        return 2;
    ',
        ];
        $cases[] = [
            '<?php
    if (true) {
        return 1;
    } elseif (false) {
        return 2;
    }',
        ];
        $cases[] = [
            '<?php
    if (true)
        return 1;
    elseif (false)
        return 2;
    ',
        ];
        $cases[] = [
            '<?php
    throw new Exception("return true;");',
        ];
        $cases[] = [
            '<?php
    function foo()
    {
        // comment
        return "foo";
    }',
        ];
        $cases[] = [
            '<?php
    function foo()
    {
        // comment

        return "bar";
    }',
        ];
        $cases[] = [
            '<?php
    function foo()
    {
        // comment
        return "bar";
    }',
        ];
        $cases[] = [
            '<?php
    function foo() {
        $a = "a";
        $b = "b";

        return $a . $b;
    }',
            '<?php
    function foo() {
        $a = "a";
        $b = "b";
        return $a . $b;
    }',
        ];
        $cases[] = [
            '<?php
    function foo() {
        $b = "b";
        return $a . $b;
    }',
        ];
        $cases[] = [
            '<?php
    function foo() {
        $a = "a";

        return $a . "hello";
    }

    function bar() {
        $b = "b";
        return $b . "hello";
    }
    ',
        ];

        return $cases;
    }

    /**
     * @param string      $expected
     * @param null|string $input
     *
     * @dataProvider provideMessyWhitespacesCases
     */
    public function testMessyWhitespaces($expected, $input = null) {
        $this->fixer->setWhitespacesConfig(new WhitespacesFixerConfig("\t", "\r\n"));

        $this->doTest($expected, $input);
    }

    public function provideMessyWhitespacesCases() {
        return [
            [
                "<?php\r\n\$a = \$a;\r\n\r\nreturn \$a;",
                "<?php\r\n\$a = \$a; return \$a;",
            ],
            [
                "<?php\r\n\$b = \$b;\r\n\r\nreturn \$b;",
                "<?php\r\n\$b = \$b;return \$b;",
            ],
            [
                "<?php\r\n\$c = \$c;\r\n\r\nreturn \$c;",
                "<?php\r\n\$c = \$c;\r\nreturn \$c;",
            ],
        ];
    }

    protected function createFixer() {
        return new BlankLineBeforeReturnFixer();
    }

}
