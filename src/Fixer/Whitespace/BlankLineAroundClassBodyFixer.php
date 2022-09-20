<?php
declare(strict_types=1);

namespace Ely\CS\Fixer\Whitespace;

use Ely\CS\Fixer\AbstractFixer;
use PhpCsFixer\Fixer\ConfigurableFixerInterface;
use PhpCsFixer\Fixer\WhitespacesAwareFixerInterface;
use PhpCsFixer\FixerConfiguration\FixerConfigurationResolver;
use PhpCsFixer\FixerConfiguration\FixerConfigurationResolverInterface;
use PhpCsFixer\FixerConfiguration\FixerOptionBuilder;
use PhpCsFixer\FixerDefinition\CodeSample;
use PhpCsFixer\FixerDefinition\FixerDefinition;
use PhpCsFixer\FixerDefinition\FixerDefinitionInterface;
use PhpCsFixer\Preg;
use PhpCsFixer\Tokenizer\Token;
use PhpCsFixer\Tokenizer\Tokens;
use PhpCsFixer\Tokenizer\TokensAnalyzer;

/**
 * This is copy of the PR https://github.com/FriendsOfPHP/PHP-CS-Fixer/pull/3688
 *
 * @author ErickSkrauch <erickskrauch@ely.by>
 */
final class BlankLineAroundClassBodyFixer extends AbstractFixer implements ConfigurableFixerInterface, WhitespacesAwareFixerInterface {

    public function getDefinition(): FixerDefinitionInterface {
        return new FixerDefinition(
            'Ensure that class body contains one blank line after class definition and before its end.',
            [
                new CodeSample(
                    '<?php
class Sample
{
    protected function foo()
    {
    }
}
',
                ),
                new CodeSample(
                    '<?php
new class extends Foo {

    protected function foo()
    {
    }

};
',
                    ['apply_to_anonymous_classes' => false],
                ),
                new CodeSample(
                    '<?php
new class extends Foo {
    protected function foo()
    {
    }
};
',
                    ['apply_to_anonymous_classes' => true],
                ),
            ],
        );
    }

    public function getPriority(): int {
        // should be run after the BracesFixer
        return -26;
    }

    public function isCandidate(Tokens $tokens): bool {
        return $tokens->isAnyTokenKindsFound(Token::getClassyTokenKinds());
    }

    protected function applyFix(\SplFileInfo $file, Tokens $tokens): void {
        $analyzer = new TokensAnalyzer($tokens);
        foreach ($tokens as $index => $token) {
            if (!$token->isClassy()) {
                continue;
            }

            $countLines = $this->configuration['blank_lines_count'];
            if (!$this->configuration['apply_to_anonymous_classes'] && $analyzer->isAnonymousClass($index)) {
                $countLines = 0;
            }

            $startBraceIndex = $tokens->getNextTokenOfKind($index, ['{']);
            if ($tokens[$startBraceIndex + 1]->isWhitespace()) {
                $nextStatementIndex = $tokens->getNextMeaningfulToken($startBraceIndex);
                // Traits should be placed right after a class opening brace,
                if ($tokens[$nextStatementIndex]->getContent() !== 'use') {
                    $this->fixBlankLines($tokens, $startBraceIndex + 1, $countLines);
                }
            }

            $endBraceIndex = $tokens->findBlockEnd(Tokens::BLOCK_TYPE_CURLY_BRACE, $startBraceIndex);
            if ($tokens[$endBraceIndex - 1]->isWhitespace()) {
                $this->fixBlankLines($tokens, $endBraceIndex - 1, $countLines);
            }
        }
    }

    protected function createConfigurationDefinition(): FixerConfigurationResolverInterface {
        return new FixerConfigurationResolver([
            (new FixerOptionBuilder('blank_lines_count', 'adjusts an amount of the blank lines.'))
                ->setAllowedTypes(['int'])
                ->setDefault(1)
                ->getOption(),
            (new FixerOptionBuilder('apply_to_anonymous_classes', 'whether this fixer should be applied to anonymous classes.'))
                ->setAllowedTypes(['bool'])
                ->setDefault(true)
                ->getOption(),
        ]);
    }

    private function fixBlankLines(Tokens $tokens, int $index, int $countLines): void {
        $content = $tokens[$index]->getContent();
        // Apply fix only in the case when the count lines do not equals to expected
        if (substr_count($content, "\n") === $countLines + 1) {
            return;
        }

        // The final bit of the whitespace must be the next statement's indentation
        Preg::matchAll('/[^\n\r]+[\r\n]*/', $content, $matches);
        $lines = $matches[0];
        $eol = $this->whitespacesConfig->getLineEnding();
        $tokens[$index] = new Token([T_WHITESPACE, str_repeat($eol, $countLines + 1) . end($lines)]);
    }

}
