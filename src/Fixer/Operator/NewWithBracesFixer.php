<?php
declare(strict_types=1);

namespace Ely\CS\Fixer\Operator;

use Ely\CS\Fixer\AbstractFixer;
use PhpCsFixer\Fixer\ConfigurationDefinitionFixerInterface;
use PhpCsFixer\FixerConfiguration\FixerConfigurationResolver;
use PhpCsFixer\FixerConfiguration\FixerOptionBuilder;
use PhpCsFixer\FixerDefinition\CodeSample;
use PhpCsFixer\FixerDefinition\FixerDefinition;
use PhpCsFixer\Tokenizer\CT;
use PhpCsFixer\Tokenizer\Token;
use PhpCsFixer\Tokenizer\Tokens;

/**
 * This is the extended version of the original new_with_braces fixer.
 * It allows you to remove braces around an anonymous class declaration in a case
 * when said class constructor doesn't contain any arguments.
 *
 * @url https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/5c5de791ab/src/Fixer/Operator/NewWithBracesFixer.php
 *
 * @author Dariusz Rumiński <dariusz.ruminski@gmail.com>
 */
final class NewWithBracesFixer extends AbstractFixer implements ConfigurationDefinitionFixerInterface {

    /**
     * {@inheritdoc}
     */
    public function getDefinition() {
        return new FixerDefinition(
            'All instances created with new keyword must be followed by braces.',
            [
                new CodeSample("<?php \$x = new X;\n"),
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function isCandidate(Tokens $tokens) {
        return $tokens->isTokenKindFound(T_NEW);
    }

    /**
     * {@inheritdoc}
     */
    protected function applyFix(\SplFileInfo $file, Tokens $tokens) {
        static $nextTokenKinds = null;
        if ($nextTokenKinds === null) {
            $nextTokenKinds = [
                '?',
                ';',
                ',',
                '(',
                ')',
                '[',
                ']',
                ':',
                '<',
                '>',
                '+',
                '-',
                '*',
                '/',
                '%',
                '&',
                '^',
                '|',
                [T_CLASS],
                [T_IS_SMALLER_OR_EQUAL],
                [T_IS_GREATER_OR_EQUAL],
                [T_IS_EQUAL],
                [T_IS_NOT_EQUAL],
                [T_IS_IDENTICAL],
                [T_IS_NOT_IDENTICAL],
                [T_CLOSE_TAG],
                [T_LOGICAL_AND],
                [T_LOGICAL_OR],
                [T_LOGICAL_XOR],
                [T_BOOLEAN_AND],
                [T_BOOLEAN_OR],
                [T_SL],
                [T_SR],
                [T_INSTANCEOF],
                [T_AS],
                [T_DOUBLE_ARROW],
                [T_POW],
                [CT::T_ARRAY_SQUARE_BRACE_OPEN],
                [CT::T_ARRAY_SQUARE_BRACE_CLOSE],
                [CT::T_BRACE_CLASS_INSTANTIATION_OPEN],
                [CT::T_BRACE_CLASS_INSTANTIATION_CLOSE],
            ];

            if (defined('T_SPACESHIP')) {
                $nextTokenKinds[] = [T_SPACESHIP];
            }
        }

        for ($index = $tokens->count() - 3; $index > 0; --$index) {
            $token = $tokens[$index];
            if (!$token->isGivenKind(T_NEW)) {
                continue;
            }

            $nextIndex = $tokens->getNextTokenOfKind($index, $nextTokenKinds);
            $nextToken = $tokens[$nextIndex];

            // new anonymous class definition
            if ($nextToken->isGivenKind(T_CLASS)) {
                if ($this->configuration['remove_for_anonymous_classes']) {
                    $nextTokenIndex = $tokens->getNextMeaningfulToken($nextIndex);
                    $nextNextTokenIndex = $tokens->getNextMeaningfulToken($nextTokenIndex);
                    if ($tokens[$nextTokenIndex]->equals('(') && $tokens[$nextNextTokenIndex]->equals(')')) {
                        $this->removeBracesAfter($tokens, $nextIndex);
                    }
                } else {
                    if (!$tokens[$tokens->getNextMeaningfulToken($nextIndex)]->equals('(')) {
                        $this->insertBracesAfter($tokens, $nextIndex);
                    }
                }

                continue;
            }

            // entrance into array index syntax - need to look for exit
            while ($nextToken->equals('[')) {
                $nextIndex = $tokens->findBlockEnd(Tokens::BLOCK_TYPE_INDEX_SQUARE_BRACE, $nextIndex) + 1;
                $nextToken = $tokens[$nextIndex];
            }

            // new statement has a gap in it - advance to the next token
            if ($nextToken->isWhitespace()) {
                $nextIndex = $tokens->getNextNonWhitespace($nextIndex);
                $nextToken = $tokens[$nextIndex];
            }

            // new statement with () - nothing to do
            if ($nextToken->equals('(')) {
                continue;
            }

            $this->insertBracesAfter($tokens, $tokens->getPrevMeaningfulToken($nextIndex));
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function createConfigurationDefinition() {
        return new FixerConfigurationResolver([
            (new FixerOptionBuilder('remove_for_anonymous_classes', 'when enabled will remove braces around an anonymous class declaration in a case when constructor doesn\'t contain any arguments'))
                ->setAllowedTypes(['bool'])
                ->setDefault(false)
                ->getOption(),
        ]);
    }

    /**
     * @param Tokens $tokens
     * @param int    $index
     */
    private function insertBracesAfter(Tokens $tokens, $index) {
        $tokens->insertAt(++$index, [new Token('('), new Token(')')]);
    }

    /**
     * @param Tokens $tokens
     * @param int    $index
     */
    private function removeBracesAfter(Tokens $tokens, int $index) {
        $tokens->clearRange(
            $tokens->getNextTokenOfKind($index, ['(']),
            $tokens->getNextTokenOfKind($index, [')'])
        );
    }

}
