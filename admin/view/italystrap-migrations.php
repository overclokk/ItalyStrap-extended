<?php

/**
 * Template to display the settings page.
 *
 * @package ItalyStrap\Settings
 */

?>
<?php do_action('italystrap_before_settings_page', $this); ?>
<div  id="tabs" class="wrap">
    <div id="post-body">
        <div class="postbox-container">
            <?php // do_action( 'italystrap_before_settings_form', $this ); ?>
            <form action="#" method="post">
                <?php
//                \d($this);

                $file = ABSPATH . '.maintenance';
                $maintenance_string = '<?php $upgrading = ' . time() . '; ?>';

//                $file = new \SplFileObject($file, 'w');
//                var_dump($file->fwrite($maintenance_string));
//                var_dump($file->fwrite('ciao'));
//                var_dump($file);

                // delete file
//                 \unlink($file);

//                try {
//                    \Webimpress\SafeWriter\FileWriter::writeFile($file, $maintenance_string);
//                } catch (\Webimpress\SafeWriter\Exception\ExceptionInterface $e) {
//                }

                //                \add_filter(
//                    'enable_maintenance_mode',
//                    function ($bool, $upgrading) {
//                        \d($bool, $upgrading);
//                        return false;
//                    }
//                );

                $injector = \apply_filters('italystrap_injector', null) ?? new \Auryn\Injector();
                try {
                    $migrations = $injector->make(\ItalyStrap\Migrations\MigrationOld::class);
                    $migrations->run();

                    $config = clone $injector->make(\ItalyStrap\Config\ConfigInterface::class);
                    \d($config);

                    $option = $injector
                            ->make(\ItalyStrap\Storage\Option::class);
                    \d($option);
                } catch (\Auryn\InjectionException $e) {
                    echo $e->getMessage();
                }

                \settings_fields('italystrap-migrations');
                // Verify nonce on post action
                if (isset($_POST['submit']) && \wp_verify_nonce($_POST['submit'], 'italystrap-migrations')) {
                    // do stuff
                    \dd('ciao');
                }

                submit_button('Migrate');
                ?>
            </form>
            <?php // do_action( 'italystrap_after_settings_form', $this ); ?>
        </div>
    </div>
</div>
<div class="clear"></div>
<?php // do_action( 'italystrap_after_settings_page', $this ); ?>
