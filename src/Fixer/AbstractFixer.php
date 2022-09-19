<?php
declare(strict_types=1);

namespace Ely\CS\Fixer;

abstract class AbstractFixer extends \PhpCsFixer\AbstractFixer {

    /**
     * {@inheritdoc}
     */
    public function getName(): string {
        return sprintf('Ely/%s', parent::getName());
    }

}
