<?php
declare(strict_types=1);

namespace Ely\CS\Fixer\Whitespace;

use Ely\CS\Fixer\AbstractFixer;
use PhpCsFixer\Fixer\WhitespacesAwareFixerInterface;
use PhpCsFixer\FixerDefinition\CodeSample;
use PhpCsFixer\FixerDefinition\FixerDefinition;
use PhpCsFixer\Tokenizer\Token;
use PhpCsFixer\Tokenizer\Tokens;
use SplFileInfo;

/**
 * This is extended version of the original `blank_line_before_statement` fixer.
 * It applies only to `return` statements and only in cases, when on the current nesting level more than one statements.
 *
 * @url https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/5c5de791ab/src/Fixer/Whitespace/BlankLineBeforeStatementFixer.php
 *
 * @author Dariusz Rumiński <dariusz.ruminski@gmail.com>
 * @author Andreas Möller <am@localheinz.com>
 * @author SpacePossum
 */
final class BlankLineBeforeReturnFixer extends AbstractFixer implements WhitespacesAwareFixerInterface {

    /**
     * {@inheritdoc}
     */
    public function getDefinition() {
        return new FixerDefinition(
            'An empty line feed should precede a return statement.',
            [new CodeSample("<?php\nfunction A()\n{\n    echo 1;\n    return 1;\n}\n")]
        );
    }

    /**
     * @inheritdoc
     */
    public function isCandidate(Tokens $tokens) {
        return $tokens->isTokenKindFound(T_RETURN);
    }

    /**
     * {@inheritdoc}
     */
    public function getPriority() {
        // should be run after NoUselessReturnFixer, ClassDefinitionFixer and BracesFixer
        return -26;
    }

    /**
     * @inheritdoc
     */
    protected function applyFix(SplFileInfo $file, Tokens $tokens) {
        for ($index = 0, $limit = $tokens->count(); $index < $limit; ++$index) {
            $token = $tokens[$index];
            if (!$token->isGivenKind(T_RETURN)) {
                continue;
            }

            $eol = $this->whitespacesConfig->getLineEnding();

            $prevNonWhitespaceToken = $tokens[$tokens->getPrevNonWhitespace($index)];
            if (!$prevNonWhitespaceToken->equalsAny([';', '}'])) {
                continue;
            }

            $prevIndex = $index - 1;
            $prevToken = $tokens[$prevIndex];
            if ($prevToken->isWhitespace()) {
                $countParts = substr_count($prevToken->getContent(), "\n");
                if ($countParts === 0) {
                    $tokens[$prevIndex] = new Token([T_WHITESPACE, rtrim($prevToken->getContent(), " \t") . $eol . $eol]);
                } elseif ($countParts === 1) {
                    $backwardIndex = $prevIndex;
                    do {
                        if (--$backwardIndex < 0) {
                            break;
                        }

                        $backwardToken = $tokens[$backwardIndex];
                        if ($backwardToken->getContent() === '{') {
                            break;
                        }

                        if ($backwardToken->isWhitespace()) {
                            $countParts += substr_count($backwardToken->getContent(), "\n");
                        }
                    } while ($countParts < 3);

                    if ($countParts !== 2) {
                        $tokens[$prevIndex] = new Token([T_WHITESPACE, $eol . $prevToken->getContent()]);
                    }
                }
            } else {
                $tokens->insertAt($index, new Token([T_WHITESPACE, $eol . $eol]));
                ++$index;
                ++$limit;
            }
        }
    }

}
