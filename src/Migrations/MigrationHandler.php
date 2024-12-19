<?php

declare(strict_types=1);

namespace ItalyStrap\Migrations;

class MigrationHandler
{
    private $steps = [];
    private $errors = [];

    public function addStep(StepInterface $step): void
    {
        $this->steps[] = $step;
    }

    public function run(): bool
    {
        foreach ($this->steps as $step) {
            if (!$step->execute()) {
                $this->errors[] = $step->getMessage();
                $this->rollback();
                return false;
            }
        }
        return true;
    }

    private function rollback(): void
    {
        foreach ($this->steps as $step) {
            $step->rollback();
        }
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
