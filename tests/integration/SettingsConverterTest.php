<?php

declare(strict_types=1);

namespace ItalyStrap\Tests\Integration;

use ItalyStrap\Migrations\SettingsMigration;
use ItalyStrap\Tests\IntegrationTestCase;

class SettingsConverterTest extends IntegrationTestCase
{
    private function makeInstance(): SettingsMigration
    {
        return new SettingsMigration();
    }

    public function testItShouldBeConvertedToThemeMod()
    {
        $sut = $this->makeInstance();

        $pattern = [
            // 'old'    => 'new',
            'default_404'   => 'default_404',
            'default_image' => 'default_image',
            'logo'          => 'logo',
        ];

        $old_data = [
            'default_404'      => $this->imageUrlOne,
            'default_image'    => $this->imageUrlTwo,
            'logo'             => $this->imageUrlThree
        ];

        $sut->dataToThemeMod($pattern, $old_data);

        foreach ($pattern as $key => $value) {
            $this->assertTrue(\is_int(get_theme_mod($value)), 'Should be the ID of the image');
            $file = \get_post(get_theme_mod($value));
            $this->assertSame($old_data[$key], $file->guid);
        }
    }

    public function testItShouldBeConvertedToOption()
    {
        $sut = $this->makeInstance();

        $pattern = [
            'favicon'       => 'site_icon'
        ];

        $old_data = [
            'favicon'      => $this->imageUrlOne
        ];

        $sut->dataToOption($pattern, $old_data);

        foreach ($pattern as $key => $value) {
            $this->assertTrue(\is_int(get_option($value)), 'Should be the ID of the image');
            $file = \get_post(get_option($value));
            $this->assertSame($old_data[$key], $file->guid);
        }
    }

    public function testItShouldBeConvertedToOptions()
    {
        $sut = $this->makeInstance();

        $pattern = [
            'analytics'     => 'google_analytics_id'
        ];

        /**
         * The img will be converted to ID
         */
        $old_data = [
            'analytics'    => 'UA-12345-6'
        ];

        $new_options = get_option('italystrap_settings');

        $sut->dataToOptions($pattern, $old_data, $new_options, 'italystrap_settings');

        $new_data = get_option('italystrap_settings');

        foreach ($pattern as $key => $value) {
            $this->assertEquals($old_data[$key], $new_data[$value], 'Should be the ID of the image');
        }
    }
}
