<?php
namespace Grav\Plugin;

use \Grav\Common\Plugin;
use \Grav\Common\Grav;
use \Grav\Common\Page\Page;

class BootstrapperPlusPlugin extends Plugin
{
    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'onThemeInitialized' => ['onThemeInitialized', 0]
        ];
    }

    /**
     * Initialize configuration
     */
    public function onThemeInitialized()
    {
        if ($this->isAdmin()) {
            return;
        }

        $load_events = false;

        // if not always_load see if the theme expects to load bootstrap plugin
        if (!$this->config->get('plugins.bootstrapper-plus.always_load')) {
            $theme = $this->grav['theme'];
            if (isset($theme->load_bootstrapper_plus_plugin) && $theme->load_bootstrapper_plus_plugin) {
                $load_events = true;
            }
        } else {
            $load_events = true;
        }

        if ($load_events) {
            $this->enable([
                'onTwigSiteVariables' => ['onTwigSiteVariables', 0]
            ]);
        }
    }

    /**
     * if enabled on this page, load the JS + CSS and set the selectors.
     */
    public function onTwigSiteVariables()
    {
        $config = $this->config->get('plugins.bootstrapper-plus');
        $mode = $config['mode'] == 'production' ? '.min' : '';

        $bootstrap_bits = [];

        if ($config['use_cdn']) {
            if ($config['load_core_css']) {
                if ($config['load_bootswatch_theme'] === 'no') {
                    $bootstrap_bits[] = 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap'.$mode.'.css';
                } else {
                    if (in_array($config['load_bootswatch_theme'], $this->returnBootswatchThemes())) {
                        $bootstrap_bits[] = 'https://bootswatch.com/'.$config['load_bootswatch_theme'].'/bootstrap'.$mode.'.css';
                    }
                }
            }
            if ($config['load_theme_css']) {
                $bootstrap_bits[] = 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme'.$mode.'.css';
            }
            if ($config['load_core_js']) {
                $bootstrap_bits[] = 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap'.$mode.'.js';
            }
            if ($config['load_font_awesome']) {
                $bootstrap_bits[] = 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome'.$mode.'.css';
            }
        } else {
            if ($config['load_core_css']) {
                if ($config['load_bootswatch_theme'] === 'no') {
                    $bootstrap_bits[] = 'plugin://bootstrapper-plus/css/bootstrap'.$mode.'.css';
                } else {
                    if (in_array($config['load_bootswatch_theme'], $this->returnBootswatchThemes())) {
                        $bootstrap_bits[] = 'plugin://bootstrapper-plus/css/bootswatch/'.$config['load_bootswatch_theme'].'/bootstrap'.$mode.'.css';
                    }
                }
            }
            if ($config['load_theme_css']) {
                $bootstrap_bits[] = 'plugin://bootstrapper-plus/css/bootstrap-theme'.$mode.'.css';
            }
            if ($config['load_core_js']) {
                $bootstrap_bits[] = 'plugin://bootstrapper-plus/js/bootstrap'.$mode.'.js';
            }
            if ($config['load_font_awesome']) {
                $bootstrap_bits[] = 'plugin://bootstrapper-plus/css/font-awesome'.$mode.'.css';
            }
        }

        $assets = $this->grav['assets'];
        $assets->registerCollection('bootstrap', $bootstrap_bits);
        $assets->add('bootstrap', 100);
    }

    private function returnBootswatchThemes() {
        $themes = ['cerulean', 'cosmo', 'cyborg', 'darkly', 'flatly', 'journal', 'lumen', 'paper', 'readable', 'sandstone', 'simplex', 'slate', 'spacelab', 'superhero', 'united', 'yeti'];
        return $themes;
    }
}
