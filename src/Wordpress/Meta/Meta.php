<?php

namespace Ababilitworld\FlexTraitByAbabilitworld\Wordpress\Meta;

trait Meta
{
    public function registerMeta(string $key, array $args = []): void 
    {
        add_action('add_meta_boxes', function () use ($key, $args) 
        {
            add_meta_box(
                $key . '_box',
                $args['title'] ?? ucfirst($key),
                $args['callback'] ?? null,
                $this->postType,
                $args['context'] ?? 'advanced',
                $args['priority'] ?? 'default'
            );
        });

        add_action('save_post', function ($postId) use ($key) 
        {
            if (isset($_POST[$key])) 
            {
                update_post_meta($postId, $key, sanitize_text_field($_POST[$key]));
            }
        });
    }
    
}