**Note:** This repository is abandonded. Use https://github.com/PhileCMS/phileTwigFilters instead.

twigSlugify
===========

A plugin for Phile that adds a Twig filter that will slugify a string

### 1.1 Installation (composer)

```
php composer.phar require phile/twigSlugify:*
```

### 1.2 Installation (Download)

* Install [Phile](https://github.com/PhileCMS/Phile)
* Clone this repo into `plugins/phile/twigSlugify`

### 2. Activation

After you have installed the plugin. You need to add the following line to your `config.php` file:

* add `$config['plugins']['phile\\twigSlugify'] = array('active' => true);` to your `config.php`

### What Is This For?

This new Twig filter allows you to slugify a string. This is useful for making safe URLs, HTML-safe class/id names, or just cleaning up general strings.

#### Examples:

```twig
{{ current_page.title | slugify }}

{{ "This Is an UNSAFE __and strange      string" | slugify }}
```
