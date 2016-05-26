<?php

namespace Phile\Plugin\Phile\TwigSlugify;

use Phile\Plugin\AbstractPlugin;
use Phile\Exception\PluginException;

use Twig_SimpleFilter as TwigFilter;

/**
 * Class Plugin
 * A Twig filter that will slugify a string
 *
 * @author  PhileCMS
 * @link    https://philecms.com
 * @license http://opensource.org/licenses/MIT
 * @package Phile\Plugin\Phile\TwigSlugify
 */
class Plugin extends AbstractPlugin
{

    protected $events = ['template_engine_registered' => 'templateEngineRegistered'];

    public function slugify($string, $delimiter = '-')
    {
        // https://github.com/phalcon/incubator/blob/master/Library/Phalcon/Utils/Slug.php
        if (!extension_loaded('iconv')) {
            throw new PluginException('iconv module not loaded', 0);
        }
        // Save the old locale and set the new locale to UTF-8
        $oldLocale = setlocale(LC_ALL, '0');
        setlocale(LC_ALL, 'en_US.UTF-8');
        $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
        $clean = strtolower($clean);
        $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
        $clean = trim($clean, $delimiter);
        // Revert back to the old locale
        setlocale(LC_ALL, $oldLocale);
        return $clean;
    }

    /**
     * templateEngineRegistered method
     *
     * @param array $vars
     * @param null  $noop
     *
     * @return mixed|void
     */
    public function templateEngineRegistered($vars, $noop = null)
    {
        $slugify = new TwigFilter('slugify', [$this, 'slugify']);
        $vars['engine']->addFilter($slugify);
    }
}
