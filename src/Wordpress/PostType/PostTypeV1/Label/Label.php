<?php

namespace Ababilitworld\FlexTraitByAbabilitworld\Wordpress\PostType\PostTypeV1\Label;

trait Label
{
    protected array $default_labels = [];
    protected array $labels = [];
    protected array $allowed_label_keys = [];

    /**
     * Initialize default labels.
     *
     * @param string $singular
     * @param string $plural
     * @param array $custom_default_labels
     * @param array $allowed_label_keys
     */
    public function initialize_default_labels(
        string $singular,
        string $plural,
        array $custom_default_labels = [],
        array $allowed_label_keys = []
    ): void 
    {
        $default_labels = [
            'name' => $plural,
            'singular_name' => $singular,
            'menu_name' => $plural,
            'add_new' => "Add New $singular",
            'add_new_item' => "Add New $singular",
            'edit_item' => "Edit $singular",
            'new_item' => "New $singular",
            'view_item' => "View $singular",
            'all_items' => "All $plural",
            'search_items' => "Search $plural",
            'not_found' => "No $plural Found",
            'not_found_in_trash' => "No $plural Found in Trash",
            'featured_image' => "$singular Featured Image",
            'set_featured_image' => "Set $singular Featured Image",
            'remove_featured_image' => "Remove $singular Featured Image",
            'use_featured_image' => "Use as $singular Featured Image",
            'archives' => "$singular Archives",
            'insert_into_item' => "Insert into $singular",
            'uploaded_to_this_item' => "Uploaded to this $singular",
            'items_list' => "$plural List",
            'items_list_navigation' => "$plural List Navigation",
            'filter_items_list' => "Filter $plural List",
        ];

        $this->default_labels = array_merge($default_labels, $custom_default_labels);
        $this->allowed_label_keys = $allowed_label_keys;
        $this->labels = $this->default_labels;
    }

    /**
     * Get all default labels.
     *
     * @return array
     */
    public function get_default_labels(): array
    {
        return $this->default_labels;
    }

    /**
     * Update a specific default label.
     *
     * @param string $key
     * @param string $value
     */
    public function update_default_label(string $key, string $value): void
    {
        $this->validate_label_key($key);
        $this->default_labels[$key] = $value;
    }

    /**
     * Set custom labels, overriding the defaults where necessary.
     *
     * @param array $custom_labels
     */
    public function set_labels(array $custom_labels = []): void
    {
        foreach ($custom_labels as $key => $value) {
            $this->validate_label_key($key);
        }
        $this->labels = array_merge($this->default_labels, $custom_labels);
    }

    /**
     * Get all labels.
     *
     * @return array
     */
    public function get_labels(): array
    {
        return $this->labels;
    }

    /**
     * Get a single label by key.
     *
     * @param string $key
     * @return string|null
     */
    public function get_label(string $key): ?string
    {
        return $this->labels[$key] ?? null;
    }

    /**
     * Check if a label exists.
     *
     * @param string $key
     * @return bool
     */
    public function label_exists(string $key): bool
    {
        return isset($this->labels[$key]);
    }

    /**
     * Reset labels to default values.
     */
    public function reset_labels_to_default(): void
    {
        $this->labels = $this->default_labels;
    }

    /**
     * Set a single custom label.
     *
     * @param string $key
     * @param string $value
     */
    public function set_label(string $key, string $value): void
    {
        $this->validate_label_key($key);
        $this->labels[$key] = $value;
    }

    /**
     * Validate a label key if allowed keys are defined.
     *
     * @param string $key
     */
    protected function validate_label_key(string $key): void
    {
        if (!empty($this->allowed_label_keys) && !in_array($key, $this->allowed_label_keys, true)) {
            throw new \InvalidArgumentException("Label key '{$key}' is not allowed.");
        }
    }
}
