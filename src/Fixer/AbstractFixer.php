<?php
namespace Ely\CS\Fixer;

abstract class AbstractFixer extends \PhpCsFixer\AbstractFixer {

    /**
     * {@inheritdoc}
     */
    public function getName() {
        return sprintf('Ely/%s', parent::getName());
    }

}
