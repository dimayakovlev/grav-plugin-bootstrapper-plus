# Grav Bootstrapper Plugin


`Bootstrapper Plus` is a [Grav](http://github.com/getgrav/grav) plugin that can be used as a dependency for other themes and plugins to load [Bootstrap Framework assets](http://getbootstrap.com/).  The main purpose of this plugins is to allow the Boostrap theme to depend on the bootstrap CSS/JS and allow the plugin to be updated independently of the theme itself.

# Installation

## Manual Installation

Download the zip version of this repository and unzip it under `/your/site/grav/user/plugins`. Then, rename the folder to `bootstrapper-plus`.

You should now have all the plugin files under

	/your/site/grav/user/plugins/bootstrapper-plus

# Usage

To best understand what Bootstrapper plugin provides, you should read through the original [Bootstrap project documentation](http://getbootstrap.com/).

## Configuration

Bootstrapper Plus is **enabled** but **not active** by default.  You can change this behavior by setting `active: true` in the plugin's configuration.  Simply copy the `user/plugins/bootstrapper/bootstrapper-plus.yaml` into `user/config/plugins/bootstrapper-plus.yaml` and make your modifications.

```
enabled: true                   # Enable / Disable this plugin
always_load: false              # If set to `false` the Theme must have `public $load_bootstrapper_plugin = true;` to add the CSS/JS
use_cdn: false                  # If set to `true` Bootstrap's CSS and JavaScript loads from CDN
mode: production                # Production mode will use the `.min` compressed CSS and JS files
load_core_css: true             # Load the core `bootstrap.css` CSS file
load_theme_css: true            # Load the theme `bootstrap-theme.css` CSS file
load_core_js: true              # Load the core `bootstrap.js` JS file
load_bootswatch_theme: no       # Load Bootswatch customized `bootstrap.css` CSS file instead default
load_font_awesome: true         # Load the Font Awesome `font-awesome.css` CSS file
```
