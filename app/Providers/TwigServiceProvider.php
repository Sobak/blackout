<?php

namespace App\Providers;

use InvalidArgumentException;
use Twig\Lexer;
use TwigBridge\Bridge;
use TwigBridge\ServiceProvider as TwigBridgeServiceProvider;

class TwigServiceProvider extends TwigBridgeServiceProvider
{
    /**
     * {@inheritdoc}
     */
    protected function registerEngine()
    {
        $this->app->bind(
            'twig',
            function () {
                $extensions = $this->app['twig.extensions'];
                $twig       = new Bridge(
                    $this->app['twig.loader'],
                    $this->app['twig.options'],
                    $this->app
                );

                // Instantiate and add extensions
                foreach ($extensions as $extension) {
                    // Get an instance of the extension
                    // Support for string, closure and an object
                    if (is_string($extension)) {
                        try {
                            $extension = $this->app->make($extension);
                        } catch (\Exception $e) {
                            throw new InvalidArgumentException(
                                "Cannot instantiate Twig extension '$extension': " . $e->getMessage()
                            );
                        }
                    } elseif (is_callable($extension)) {
                        $extension = $extension($this->app, $twig);
                    } elseif (!is_a($extension, 'Twig_Extension')) {
                        throw new InvalidArgumentException('Incorrect extension type');
                    }

                    $twig->addExtension($extension);
                }

                // Set lexer
                $lexer = new Lexer($twig, [
                    'tag_comment' => array('{*', '*}'),
                    'tag_variable' => array('{', '}'),
                ]);

                $twig->setLexer($lexer);

                return $twig;
            },
            true
        );

        parent::registerEngine();
    }

    /**
     * {@inheritdoc}
     */
    public function provides()
    {
        return array_diff(parent::provides(), ['twig.lexer']);
    }
}
