<?php

namespace Ababilitworld\FlexTraitByAbabilitworld\Asset;

trait Asset
{
    public static function get_url($url_suffix = null)
    {
        // Detect where the package is loaded from
        $reflection = new \ReflectionClass(__CLASS__);
        $package_dir = dirname($reflection->getFileName());

        // Convert to a URL
        $plugin_dir = plugin_dir_url(dirname($package_dir, 2));

        // Point to the correct assets directory
        //return $plugin_dir . 'vendor/ababilitworld/flex-pagination-by-ababilitworld/src/Package/';
        return $plugin_dir . $url_suffix;
    }
}