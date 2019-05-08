<?php

namespace WpQuality\GutenBreakContainer;

use Javanile\Granular\Bindable;

class Blocks extends Bindable
{
    static $bindings = ['action:init' => 'init'];

    public function init()
    {
        wp_register_style(
            'my_block-cgb-style-css', // Handle.
            plugins_url( 'dist/blocks.style.build.css', dirname( __FILE__ ) ), // Block style CSS.
            array( 'wp-editor' ), // Dependency to include the CSS after it.
            null // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.style.build.css' ) // Version: File modification time.
        );

        // Register block editor script for backend.
        wp_register_script(
            'my_block-cgb-block-js', // Handle.
            plugins_url( '/dist/blocks.build.js', dirname( __FILE__ ) ), // Block.build.js: We register the block here. Built with Webpack.
            array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor' ), // Dependencies, defined above.
            null, // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.build.js' ), // Version: filemtime — Gets file modification time.
            true // Enqueue the script in the footer.
        );

        // Register block editor styles for backend.
        wp_register_style(
            'my_block-cgb-block-editor-css', // Handle.
            plugins_url( 'dist/blocks.editor.build.css', dirname( __FILE__ ) ), // Block editor CSS.
            array( 'wp-edit-blocks' ), // Dependency to include the CSS after it.
            null // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.editor.build.css' ) // Version: File modification time.
        );

        /**
         * Register Gutenberg block on server-side.
         *
         * Register the block on server-side to ensure that the block
         * scripts and styles for both frontend and backend are
         * enqueued when the editor loads.
         *
         * @link https://wordpress.org/gutenberg/handbook/blocks/writing-your-first-block-type#enqueuing-block-scripts
         * @since 1.16.0
         */
        register_block_type(
            'cgb/block-my-block', array(
                // Enqueue blocks.style.build.css on both frontend & backend.
                'style'         => 'my_block-cgb-style-css',
                // Enqueue blocks.build.js in the editor only.
                'editor_script' => 'my_block-cgb-block-js',
                // Enqueue blocks.editor.build.css in the editor only.
                'editor_style'  => 'my_block-cgb-block-editor-css',
            )
        );
    }
}
