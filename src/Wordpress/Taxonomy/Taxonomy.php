<?php

namespace Ababilitworld\FlexTraitByAbabilitworld\Wordpress\Taxonomy;

trait Taxonomy
{
    public function registerTaxonomy(string $taxonomy, array $args = []): void 
    {
        add_action('init', function () use ($taxonomy, $args) {
            register_taxonomy($taxonomy, [$this->postType], $args);
        });
    }
    
}