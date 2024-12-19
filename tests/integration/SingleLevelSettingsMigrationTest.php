<?php

declare(strict_types=1);

namespace ItalyStrap\Test\Integration;

use ItalyStrap\Config\Config;
use ItalyStrap\Migrations\SingleLevelSettingsMigration;
use ItalyStrap\Storage\Mod;
use ItalyStrap\Storage\Option;
use ItalyStrap\Storage\StoreInterface;
use ItalyStrap\Tests\IntegrationTestCase;

class SingleLevelSettingsMigrationTest extends IntegrationTestCase
{
    private function makeInstance(): SingleLevelSettingsMigration
    {
        return new SingleLevelSettingsMigration(
            $this->makeStore()
        );
    }

    public static function dataProvider(): iterable {
        yield 'Test Mod' => [
            'Mod Store' => new Mod(),
        ];

        yield 'Test Option' => [
            'Option Store' => new Option(),
        ];
    }

    /**
     * @dataProvider dataProvider
     */
    public function testNewImplementation(StoreInterface $store)
    {
        codecept_debug('\get_theme_mods()');
        codecept_debug(\get_theme_mods());

        $this->store = $store;
        $sut = $this->makeInstance();

        $data = [
            'old_key_default_404'      => $this->imageUrlOne,
            'old_key_default_image'    => $this->imageUrlTwo,
            'old_key_logo'             => $this->imageUrlThree
        ];

        $old_keys_need_migration = [
            'old_key_default_404'   => 'new_key_default_404',
            'old_key_default_image' => 'new_key_default_image',
            'old_key_logo'          => 'new_key_logo',
        ];

        $sut->migrate($data, $old_keys_need_migration);

        $this->assertSame(
            $this->imageUrlOne,
            $this->store->get('new_key_default_404')
        );

        $this->assertSame(
            $this->imageUrlTwo,
            $this->store->get('new_key_default_image')
        );

        $this->assertSame(
            $this->imageUrlThree,
            $this->store->get('new_key_logo')
        );
    }
}
