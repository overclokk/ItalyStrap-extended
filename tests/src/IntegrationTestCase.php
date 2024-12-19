<?php

declare(strict_types=1);

namespace ItalyStrap\Tests;

use Codeception\TestCase\WPTestCase;
use DOMDocument;
use ItalyStrap\Config\Config;
use ItalyStrap\Config\ConfigInterface;
use ItalyStrap\Event\EventDispatcher;
use ItalyStrap\Event\EventDispatcherInterface;
use ItalyStrap\Lazyload\Image;
use ItalyStrap\Storage\StoreInterface;
use ItalyStrap\Update\Validation;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;
use SplFileObject;

class IntegrationTestCase extends WPTestCase
{
    use ProphecyTrait;

    protected \IntegrationTester $tester;

    private \DOMDocument $dom;
    private Validation $validation;

    private Image $image;

    public function makeImage(): Image
    {
        return $this->image;
    }

    private ObjectProphecy $file;

    public function makeFile(): SplFileObject
    {
        return $this->file->reveal();
    }

    private EventDispatcherInterface $dispatcher;

    public function makeDispatcher(): EventDispatcherInterface
    {
        return $this->dispatcher;
    }

    private ConfigInterface $config;

    public function makeConfig(): ConfigInterface
    {
        return $this->config;
    }

    protected StoreInterface $store;

    public function makeStore(): StoreInterface
    {
        return $this->store;
    }

    protected string $imageUrlOne;
    protected string $imageUrlTwo;
    protected string $imageUrlThree;

    public function setUp(): void
    {
        parent::setUp();

        $this->dom = new DOMDocument();

        $this->validation = new Validation();

        $this->config = new Config();
        $this->dispatcher = new EventDispatcher();
        $this->file = $this->prophesize(SplFileObject::class);
        $this->image = new Image($this->config, $this->dispatcher);

        $domain = \defined('WP_TESTS_DOMAIN') ? WP_TESTS_DOMAIN : 'example.org';

        $this->imageUrlOne = "http://{$domain}/wp-content/uploads/2013/03/featured-image-horizontal.jpg";
        $this->imageUrlTwo = "http://$domain/wp-content/uploads/2013/03/unicorn-wallpaper.jpg";
        $this->imageUrlThree = "http://$domain/wp-content/uploads/2015/08/26-wordpress-512.png";

        $this->factory()->attachment->create_object(
            [
                'guid' => $this->imageUrlOne,
            ]
        );
        $this->tester->factory()->attachment->create_object(
            [
                'guid' => $this->imageUrlTwo,
            ]
        );
        $this->tester->factory()->attachment->create_object(
            [
                'guid' => $this->imageUrlThree,
            ]
        );
    }

    public function tearDown(): void
    {
        // your tear down methods here

        // then
        parent::tearDown();
    }
}
