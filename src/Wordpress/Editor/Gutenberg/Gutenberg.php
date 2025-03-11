<?php
namespace Ababilitworld\FlexTraitByAbabilitworld\Wordpress\Editor\Gutenberg;

trait Gutenberg
{
    /**
     * Enable Gutenberg editor for the specific post type.
     *
     * @param bool $current_status Current Gutenberg status.
     * @param string $post_type Post type being checked.
     * @return bool Adjusted Gutenberg status.
     */
    public function enable_gutenberg($current_status, $post_type)
    {
        return $post_type === $this->postType ? true : $current_status;
    }

    /**
     * Disable Gutenberg editor for the specific post type.
     *
     * @param bool $current_status Current Gutenberg status.
     * @param string $post_type Post type being checked.
     * @return bool Adjusted Gutenberg status.
     */
    public function disable_gutenberg($current_status, $post_type)
    {
        return $post_type === $this->postType ? false : $current_status;
    }
}
