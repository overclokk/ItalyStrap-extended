<?php

declare(strict_types=1);

namespace ItalyStrap\Tests\Functional;

use FunctionalTester;
use ItalyStrap\Tests\FunctionalTestCase;

class FileMigrationCest extends FunctionalTestCase
{
    public function tryTo(FunctionalTester $i)
    {
        $i->writeToFile(
            codecept_data_dir('test.php'),
            microtime(true)
        );
    }
}
