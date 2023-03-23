<?php
declare(strict_types=1);

namespace Ely\CS\Test\Fixer\FunctionNotation;

use Ely\CS\Fixer\FunctionNotation\AlignMultilineParametersFixer;
use PhpCsFixer\AbstractFixer;
use PhpCsFixer\Tests\Test\AbstractFixerTestCase;

/**
 * @covers \Ely\CS\Fixer\FunctionNotation\AlignMultilineParametersFixer
 */
final class AlignMultilineParametersFixerTest extends AbstractFixerTestCase {

    /**
     * @dataProvider provideTrueCases
     */
    public function testBothTrue(string $expected, ?string $input = null): void {
        $this->fixer->configure([
            'variables' => true,
            'defaults' => true,
        ]);
        $this->doTest($expected, $input);
    }

    public function provideTrueCases(): iterable {
        yield 'empty function' => [
            '<?php
            function test(): void {}
            ',
        ];

        yield 'empty multiline function' => [
            '<?php
            function test(
            ): void {}
            ',
        ];

        yield 'single line function' => [
            '<?php
            function test(string $a, int $b): void {}
            ',
        ];

        yield 'single line fn' => [
            '<?php
            fn(string $a, int $b) => $b;
            ',
        ];

        yield 'function, no defaults' => [
            '<?php
            function test(
                string $a,
                int    $b
            ): void {}
            ',
            '<?php
            function test(
                string $a,
                int $b
            ): void {}
            ',
        ];

        yield 'function, one has default' => [
            '<?php
            function test(
                string $a,
                int    $b = 0
            ): void {}
            ',
            '<?php
            function test(
                string $a,
                int $b = 0
            ): void {}
            ',
        ];

        yield 'function, one has no type' => [
            '<?php
            function test(
                string $a,
                       $b
            ): void {}
            ',
            '<?php
            function test(
                string $a,
                $b
            ): void {}
            ',
        ];

        yield 'function, one has no type, but has default' => [
            '<?php
            function test(
                string $a,
                       $b = 0
            ): void {}
            ',
            '<?php
            function test(
                string $a,
                $b = 0
            ): void {}
            ',
        ];

        yield 'function, no types at all' => [
            '<?php
            function test(
                $string = "string",
                $int    = 0
            ): void {}
            ',
            '<?php
            function test(
                $string = "string",
                $int = 0
            ): void {}
            ',
        ];

        yield 'function, defaults' => [
            '<?php
            function test(
                string $string = "string",
                int    $int    = 0
            ): void {}
            ',
            '<?php
            function test(
                string $string = "string",
                int $int = 0
            ): void {}
            ',
        ];

        yield 'class method, defaults' => [
            '<?php
            class Test {
                public function foo(
                    string $string = "string",
                    int    $int    = 0
                ): void {}
            }
            ',
            '<?php
            class Test {
                public function foo(
                    string $string = "string",
                    int $int = 0
                ): void {}
            }
            ',
        ];

        yield 'fn, defaults' => [
            '<?php
            fn(
                string $string = "string",
                int    $int    = 0
            ) => $int;
            ',
            '<?php
            fn(
                string $string = "string",
                int $int = 0
            ) => $int;
            ',
        ];
    }

    /**
     * @dataProvider provideFalseCases
     */
    public function testBothFalse(string $expected, ?string $input = null): void {
        $this->fixer->configure([
            'variables' => false,
            'defaults' => false,
        ]);
        $this->doTest($expected, $input);
    }

    public function provideFalseCases(): iterable {
        foreach ($this->provideTrueCases() as $key => $case) {
            if (isset($case[1])) {
                yield $key => [$case[1], $case[0]];
            } else {
                yield $key => $case;
            }
        }
    }

    /**
     * @dataProvider provideNullCases
     */
    public function testBothNull(string $expected, ?string $input = null): void {
        $this->fixer->configure([
            'variables' => null,
            'defaults' => null,
        ]);
        $this->doTest($expected, $input);
    }

    public function provideNullCases(): iterable {
        foreach ($this->provideFalseCases() as $key => $case) {
            yield $key => [$case[0]];
        }
    }

    protected function createFixer(): AbstractFixer {
        return new AlignMultilineParametersFixer();
    }

}
