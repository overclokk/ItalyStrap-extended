<?php

namespace ItalyStrap\Migrations;

class NullProcessor implements ProcessorInterface
{
    /**
     * @return mixed
     */
    public function process($value)
    {
        return $value;
    }
}
