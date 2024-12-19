<?php

declare(strict_types=1);

namespace ItalyStrap\Migrations;

class Module
{
    public function __invoke(): array
    {
        return  [
            'dependencies' => [
                'aliases' => [
                ],
                'sharing' => [
                ],
            ]
        ];
    }
}
