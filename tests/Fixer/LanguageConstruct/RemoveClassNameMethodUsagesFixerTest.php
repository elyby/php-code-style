<?php
declare(strict_types=1);

namespace Ely\CS\Test\Fixer\Operator;

use Ely\CS\Fixer\LanguageConstruct\RemoveClassNameMethodUsagesFixer;
use PhpCsFixer\Tests\Test\AbstractFixerTestCase;

/**
 * @covers \Ely\CS\Fixer\LanguageConstruct\RemoveClassNameMethodUsagesFixer
 */
class RemoveClassNameMethodUsagesFixerTest extends AbstractFixerTestCase {

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
        return [
            [
                '<?php echo className();',
            ],
            [
                '<?php
use Foo\Bar\Baz;

$exceptionString = Baz::classname();
',
            ],
            [
                '<?php
use Foo\Bar\Baz;

$className = Baz::class;
',
                '<?php
use Foo\Bar\Baz;

$className = Baz::className();
',
            ],
            [
                '<?php
use Foo\Bar\Baz;

$exceptionString = "The class should be instance of " . Baz::class . " and nothing else";
',
                '<?php
use Foo\Bar\Baz;

$exceptionString = "The class should be instance of " . Baz::className() . " and nothing else";
',
            ],
        ];
    }

    protected function createFixer() {
        return new RemoveClassNameMethodUsagesFixer();
    }

}
