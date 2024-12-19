<?php

declare(strict_types=1);

namespace ItalyStrap\Migrations;

class UpdateOptionsStep implements StepInterface
{
    public function execute(): bool
    {
        return true;
    }

    public function rollback(): void
    {
        // TODO: Implement rollback() method.
    }

    public function message(): string
    {
        return 'Update options';
    }
}
