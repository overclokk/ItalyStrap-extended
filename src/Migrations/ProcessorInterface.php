<?php

declare(strict_types=1);

namespace ItalyStrap\Migrations;

interface ProcessorInterface
{
    /**
     * @param mixed $value
     * @return mixed
     */
    public function process($value);
}
