<?php
declare(strict_types=1);

namespace Ely\CS;

use ErickSkrauch\PhpCsFixer\Fixers as ErickSkrauchFixers;
use PhpCsFixer\Config as PhpCsFixerConfig;
use PhpCsFixer\ConfigInterface as PhpCsFixerConfigInterface;
use PhpCsFixerCustomFixers\Fixers as KubawerlosFixers;

final class Config {

    public static function create(array $overwrittenRules = []): PhpCsFixerConfigInterface {
        return (new PhpCsFixerConfig())
            ->setRiskyAllowed(true)
            ->registerCustomFixers(new ErickSkrauchFixers())
            ->registerCustomFixers(new KubawerlosFixers())
            ->setRules(Rules::create($overwrittenRules));
    }

}
