<?php

declare(strict_types=1);

namespace ItalyStrap\Migrations;

class ProcessorFactory
{
    public function makeFromKey(string $key): ProcessorInterface
    {
        switch ($key) {
            default:
                return new NullProcessor();
        }
    }
}
