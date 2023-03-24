<?php
declare(strict_types=1);

namespace Ely\CS;

use Ely\CS\Fixers as ElyFixers;
use PhpCsFixer\Config as PhpCsFixerConfig;
use PhpCsFixer\ConfigInterface as PhpCsFixerConfigInterface;
use PhpCsFixerCustomFixers\Fixers as KubawerlosFixers;

class Config {

    public static function create(array $overwrittenRules = []): PhpCsFixerConfigInterface {
        return (new PhpCsFixerConfig())
            ->setRiskyAllowed(true)
            ->registerCustomFixers(new ElyFixers())
            ->registerCustomFixers(new KubawerlosFixers())
            ->setRules(Rules::create($overwrittenRules));
    }

}
