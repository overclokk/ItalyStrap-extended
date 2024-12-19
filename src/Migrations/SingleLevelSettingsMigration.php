<?php

declare(strict_types=1);

namespace ItalyStrap\Migrations;

use ItalyStrap\Storage\StoreInterface;

class SingleLevelSettingsMigration
{
    private StoreInterface $store;
    private ProcessorInterface $processor;

    public function __construct(StoreInterface $store, ProcessorInterface $processor = null)
    {
        $this->store = $store;
        $this->processor = $processor ?? new NullProcessor();
    }

    public function migrate(array $data, array $pattern): void
    {
        foreach ($pattern as $old_key => $new_key) {
            if ($this->store->get($new_key)) {
                continue;
            }

            if (!\array_key_exists($old_key, $data)) {
                continue;
            }

            $this->store->set($new_key, $this->processor->process($data[$old_key]));
        }
    }
}
