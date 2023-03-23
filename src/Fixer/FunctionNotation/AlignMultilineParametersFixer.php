<?php
declare(strict_types=1);

namespace Ely\CS\Fixer\FunctionNotation;

use Ely\CS\Fixer\AbstractFixer;
use PhpCsFixer\Fixer\ConfigurableFixerInterface;
use PhpCsFixer\Fixer\WhitespacesAwareFixerInterface;
use PhpCsFixer\FixerConfiguration\FixerConfigurationResolver;
use PhpCsFixer\FixerConfiguration\FixerConfigurationResolverInterface;
use PhpCsFixer\FixerConfiguration\FixerOptionBuilder;
use PhpCsFixer\FixerDefinition\CodeSample;
use PhpCsFixer\FixerDefinition\FixerDefinition;
use PhpCsFixer\FixerDefinition\FixerDefinitionInterface;
use PhpCsFixer\Tokenizer\Analyzer\FunctionsAnalyzer;
use PhpCsFixer\Tokenizer\Analyzer\WhitespacesAnalyzer;
use PhpCsFixer\Tokenizer\Tokens;
use PhpCsFixer\Tokenizer\TokensAnalyzer;
use SplFileInfo;

final class AlignMultilineParametersFixer extends AbstractFixer implements ConfigurableFixerInterface, WhitespacesAwareFixerInterface {

    private const C_VARIABLES = 'variables';
    private const C_DEFAULTS = 'defaults';

    public function getDefinition(): FixerDefinitionInterface {
        return new FixerDefinition(
            'Aligns parameters in multiline function declaration.',
            [
                new CodeSample(
                    '<?php
function test(
    string $a,
    int $b = 0
): void {};
',
                ),
                new CodeSample(
                    '<?php
function test(
    string $string,
    int    $int    = 0
): void {};
',
                    [self::C_VARIABLES => false, self::C_DEFAULTS => false],
                ),
            ],
        );
    }

    public function isCandidate(Tokens $tokens): bool {
        return $tokens->isAnyTokenKindsFound([T_FUNCTION, T_FN]);
    }

    /**
     * Must run after StatementIndentationFixer, MethodArgumentSpaceFixer
     */
    public function getPriority(): int {
        return -10;
    }

    protected function createConfigurationDefinition(): FixerConfigurationResolverInterface {
        return new FixerConfigurationResolver([
            (new FixerOptionBuilder(self::C_VARIABLES, 'on null no value alignment, on bool forces alignment'))
                ->setAllowedTypes(['bool', 'null'])
                ->setDefault(true)
                ->getOption(),
            (new FixerOptionBuilder(self::C_DEFAULTS, 'on null no value alignment, on bool forces alignment'))
                ->setAllowedTypes(['bool', 'null'])
                ->setDefault(null)
                ->getOption(),
        ]);
    }

    protected function applyFix(SplFileInfo $file, Tokens $tokens): void {
        // There is nothing to do
        if ($this->configuration[self::C_VARIABLES] === null && $this->configuration[self::C_DEFAULTS] === null) {
            return;
        }

        $tokensAnalyzer = new TokensAnalyzer($tokens);
        $functionsAnalyzer = new FunctionsAnalyzer();
        /** @var \PhpCsFixer\Tokenizer\Token $functionToken */
        foreach ($tokens as $i => $functionToken) {
            if (!$functionToken->isGivenKind([T_FUNCTION, T_FN])) {
                continue;
            }

            $openBraceIndex = $tokens->getNextTokenOfKind($i, ['(']);
            $isMultiline = $tokensAnalyzer->isBlockMultiline($tokens, $openBraceIndex);
            if (!$isMultiline) {
                continue;
            }

            /** @var \PhpCsFixer\Tokenizer\Analyzer\Analysis\ArgumentAnalysis[] $arguments */
            $arguments = $functionsAnalyzer->getFunctionArguments($tokens, $i);
            if (empty($arguments)) {
                continue;
            }

            $longestType = 0;
            $longestVariableName = 0;
            $hasAtLeastOneTypedArgument = false;
            foreach ($arguments as $argument) {
                $typeAnalysis = $argument->getTypeAnalysis();
                if ($typeAnalysis) {
                    $hasAtLeastOneTypedArgument = true;
                    $typeLength = strlen($typeAnalysis->getName());
                    if ($typeLength > $longestType) {
                        $longestType = $typeLength;
                    }
                }

                $variableNameLength = strlen($argument->getName());
                if ($variableNameLength > $longestVariableName) {
                    $longestVariableName = $variableNameLength;
                }
            }

            $argsIndent = WhitespacesAnalyzer::detectIndent($tokens, $i) . $this->whitespacesConfig->getIndent();
            foreach ($arguments as $argument) {
                if ($this->configuration[self::C_VARIABLES] !== null) {
                    $whitespaceIndex = $argument->getNameIndex() - 1;
                    if ($this->configuration[self::C_VARIABLES] === true) {
                        $typeLen = 0;
                        if ($argument->getTypeAnalysis() !== null) {
                            $typeLen = strlen($argument->getTypeAnalysis()->getName());
                        }

                        $appendix = str_repeat(' ', $longestType - $typeLen + (int)$hasAtLeastOneTypedArgument);
                        if ($argument->hasTypeAnalysis()) {
                            $whitespace = $appendix;
                        } else {
                            $whitespace = $this->whitespacesConfig->getLineEnding() . $argsIndent . $appendix;
                        }
                    } else {
                        if ($argument->hasTypeAnalysis()) {
                            $whitespace = ' ';
                        } else {
                            $whitespace = $this->whitespacesConfig->getLineEnding() . $argsIndent;
                        }
                    }

                    $tokens->ensureWhitespaceAtIndex($whitespaceIndex, 0, $whitespace);
                }

                if ($this->configuration[self::C_DEFAULTS] !== null) {
                    // Can't use $argument->hasDefault() because it's null when it's default for a type (e.g. 0 for int)
                    /** @var \PhpCsFixer\Tokenizer\Token $equalToken */
                    $equalToken = $tokens[$tokens->getNextMeaningfulToken($argument->getNameIndex())];
                    if ($equalToken->getContent() === '=') {
                        $nameLen = strlen($argument->getName());
                        $whitespaceIndex = $argument->getNameIndex() + 1;
                        if ($this->configuration[self::C_DEFAULTS] === true) {
                            $tokens->ensureWhitespaceAtIndex($whitespaceIndex, 0, str_repeat(' ', $longestVariableName - $nameLen + 1));
                        } else {
                            $tokens->ensureWhitespaceAtIndex($whitespaceIndex, 0, ' ');
                        }
                    }
                }
            }
        }
    }

}
