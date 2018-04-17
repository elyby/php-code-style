<?php
declare(strict_types=1);

namespace Ely\CS\Test\Fixer\Whitespace;

use Ely\CS\Fixer\Whitespace\BlankLineAroundClassBodyFixer;
use PhpCsFixer\Tests\Test\AbstractFixerTestCase;
use PhpCsFixer\WhitespacesFixerConfig;

/**
 * @author ErickSkrauch <erickskrauch@ely.by>
 *
 * @covers \Ely\CS\Fixer\Whitespace\BlankLineAroundClassBodyFixer
 */
final class BlankLineAroundClassBodyFixerTest extends AbstractFixerTestCase {

    private static $configurationDoNotApplyForAnonymousClasses = ['apply_to_anonymous_classes' => false];

    private static $configurationTwoEmptyLines = ['blank_lines_count' => 2];

    /**
     * @param string      $expected
     * @param null|string $input
     * @param null|array  $configuration
     *
     * @dataProvider provideFixCases
     */
    public function testFix($expected, $input = null, array $configuration = null) {
        if (null !== $configuration) {
            $this->fixer->configure($configuration);
        }

        $this->doTest($expected, $input);
    }

    /**
     * @param string      $expected
     * @param null|string $input
     * @param array       $configuration
     *
     * @dataProvider provideAnonymousClassesCases
     * @requires PHP 7.0
     */
    public function testFixAnonymousClasses($expected, $input = null, array $configuration = null) {
        if (null !== $configuration) {
            $this->fixer->configure($configuration);
        }

        $this->doTest($expected, $input);
    }

    public function provideFixCases() {
        $cases = [];

        $cases[] = [
            '<?php
class Good
{

    public function firstMethod()
    {
        //code here
    }

}',
            '<?php
class Good
{
    public function firstMethod()
    {
        //code here
    }
}',
        ];
        $cases[] = [
            '<?php
class Good
{

    /**
     * Also blank line before DocBlock
     */
    public function firstMethod()
    {
        //code here
    }

}',
            '<?php
class Good
{
    /**
     * Also blank line before DocBlock
     */
    public function firstMethod()
    {
        //code here
    }
}',
        ];
        $cases[] = [
            '<?php
class Good
{

    /**
     * Too many whitespaces
     */
    public function firstMethod()
    {
        //code here
    }

}',
            '<?php
class Good
{


    /**
     * Too many whitespaces
     */
    public function firstMethod()
    {
        //code here
    }



}',
        ];

        $cases[] = [
            '<?php
interface Good
{

    /**
     * Also blank line before DocBlock
     */
    public function firstMethod();

}',
            '<?php
interface Good
{
    /**
     * Also blank line before DocBlock
     */
    public function firstMethod();
}',
        ];
        $cases[] = [
            '<?php
trait Good
{

    /**
     * Also no blank line before DocBlock
     */
    public function firstMethod() {}

}',
            '<?php
trait Good
{
    /**
     * Also no blank line before DocBlock
     */
    public function firstMethod() {}
}',
        ];
        $cases[] = [
            '<?php
class Good
{
    use Foo\bar;

    public function firstMethod()
    {
        //code here
    }

}',
            '<?php
class Good
{
    use Foo\bar;

    public function firstMethod()
    {
        //code here
    }
}',
        ];
        $cases[] = [
            '<?php
class Good
{
    use Foo\bar;
    use Foo\baz;

    public function firstMethod()
    {
        //code here
    }

}',
            '<?php
class Good
{
    use Foo\bar;
    use Foo\baz;

    public function firstMethod()
    {
        //code here
    }
}',
        ];
        $cases[] = [
            '<?php
class Good
{
    use Foo, Bar {
        Bar::smallTalk insteadof A;
        Foo::bigTalk insteadof B;
    }

    public function firstMethod()
    {
        //code here
    }

}',
            '<?php
class Good
{
    use Foo, Bar {
        Bar::smallTalk insteadof A;
        Foo::bigTalk insteadof B;
    }

    public function firstMethod()
    {
        //code here
    }
}',
        ];
        $cases[] = [
            '<?php
class Good
{


    public function firstMethod()
    {
        //code here
    }


}',
            '<?php
class Good
{
    public function firstMethod()
    {
        //code here
    }
}',
            self::$configurationTwoEmptyLines,
        ];

        // check if some fancy whitespaces aren't modified
        $cases[] = [
            '<?php
class Good
{public



    function firstMethod()
    {
        //code here
    }

}',
        ];

        return $cases;
    }

    public function provideAnonymousClassesCases() {
        $cases = [];

        $cases[] = [
            '<?php
$class = new class extends \Foo {

    public $field;

    public function firstMethod() {}

};',
            '<?php
$class = new class extends \Foo {
    public $field;

    public function firstMethod() {}
};',
        ];
        $cases[] = [
            '<?php
$class = new class extends \Foo {
    public $field;

    public function firstMethod() {}
};',
            '<?php
$class = new class extends \Foo {

    public $field;

    public function firstMethod() {}

};',
            self::$configurationDoNotApplyForAnonymousClasses,
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
        /** @var \PhpCsFixer\Fixer\WhitespacesAwareFixerInterface $fixer */
        $fixer = $this->fixer;
        $fixer->setWhitespacesConfig(new WhitespacesFixerConfig("\t", "\r\n"));

        $this->doTest($expected, $input);
    }

    public function provideMessyWhitespacesCases() {
        return [
            [
                "<?php\nclass Foo\n{\r\n\r\n    public function bar() {}\r\n\r\n}",
                "<?php\nclass Foo\n{\n    public function bar() {}\n}",
            ],
            [
                "<?php\nclass Foo\n{\r\n\r\n    public function bar() {}\r\n\r\n}",
                "<?php\nclass Foo\n{\r\n\r\n\n\n    public function bar() {}\n\n\n\n}",
            ],
        ];
    }

    protected function createFixer() {
        return new BlankLineAroundClassBodyFixer();
    }

}
