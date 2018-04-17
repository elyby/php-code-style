<?php
declare(strict_types=1);

namespace Ely\CS;

use PhpCsFixer\Config as PhpCsFixerConfig;

class Config {

    public static function create(array $overwrittenRules = []): PhpCsFixerConfig {
        return PhpCsFixerConfig::create()
            ->setRiskyAllowed(true)
            ->registerCustomFixers(new Fixers())
            ->setRules(Rules::create($overwrittenRules));
    }

}
