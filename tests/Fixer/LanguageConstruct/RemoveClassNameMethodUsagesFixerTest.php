<?php
declare(strict_types=1);

namespace Ely\CS\Test\Fixer\LanguageConstruct;

use Ely\CS\Fixer\LanguageConstruct\RemoveClassNameMethodUsagesFixer;
use PhpCsFixer\AbstractFixer;
use PhpCsFixer\Tests\Test\AbstractFixerTestCase;

/**
 * @covers \Ely\CS\Fixer\LanguageConstruct\RemoveClassNameMethodUsagesFixer
 */
class RemoveClassNameMethodUsagesFixerTest extends AbstractFixerTestCase {

    /**
     * @dataProvider provideFixCases
     */
    public function testFix(string $expected, ?string $input = null): void {
        $this->doTest($expected, $input);
    }

    public function provideFixCases(): iterable {
        yield [
            '<?php echo className();',
        ];

        yield [
            '<?php
use Foo\Bar\Baz;

$exceptionString = Baz::classname();
',
        ];

        yield [
            '<?php
use Foo\Bar\Baz;

$className = Baz::class;
',
            '<?php
use Foo\Bar\Baz;

$className = Baz::className();
',
        ];

        yield [
            '<?php
use Foo\Bar\Baz;

$exceptionString = "The class should be instance of " . Baz::class . " and nothing else";
',
            '<?php
use Foo\Bar\Baz;

$exceptionString = "The class should be instance of " . Baz::className() . " and nothing else";
',
        ];
    }

    protected function createFixer(): AbstractFixer {
        return new RemoveClassNameMethodUsagesFixer();
    }

}
