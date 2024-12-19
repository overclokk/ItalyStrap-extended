<?php

declare(strict_types=1);

namespace ItalyStrap\Migrations;

interface StepInterface
{
    public function execute(): bool;
    public function rollback(): void;
    public function message(): string;
}
