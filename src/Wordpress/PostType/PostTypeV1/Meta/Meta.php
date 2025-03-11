<?php

namespace Ababilitworld\FlexTraitByAbabilitworld\Wordpress\PostType\PostTypeV1\Meta;

trait Meta
{
    protected array $default_meta = [];
    protected array $meta = [];
    protected array $allowed_meta_keys = [];

    /**
     * Initialize default meta fields with optional custom defaults.
     *
     * @param array $default_meta
     * @param array $allowed_meta_keys
     */
    public function initialize_default_meta(array $default_meta = [], array $allowed_meta_keys = []): void
    {
        $this->default_meta = $default_meta;
        $this->allowed_meta_keys = $allowed_meta_keys; // Set allowed keys for meta
        $this->meta = $this->resolve_dynamic_defaults($default_meta);
    }

    /**
     * Resolve dynamic defaults for meta fields.
     *
     * @param array $default_meta
     * @return array
     */
    protected function resolve_dynamic_defaults(array $default_meta): array
    {
        foreach ($default_meta as $key => $value) {
            if (is_callable($value)) {
                $default_meta[$key] = $value(); // Resolve callable default
            }
        }
        return $default_meta;
    }

    /**
     * Get all default meta fields.
     *
     * @return array
     */
    public function get_default_meta(): array
    {
        return $this->default_meta;
    }

    /**
     * Update a specific default meta field.
     *
     * @param string $key
     * @param mixed $value
     */
    public function update_default_meta(string $key, mixed $value): void
    {
        $this->validate_meta_key($key);
        $this->default_meta[$key] = $value;
    }

    /**
     * Set custom meta fields, overriding the defaults where necessary.
     *
     * @param array $custom_meta
     */
    public function set_meta(array $custom_meta = []): void
    {
        foreach ($custom_meta as $key => $value) {
            $this->validate_meta_key($key);
        }
        $this->meta = array_merge($this->default_meta, $custom_meta);
    }

    /**
     * Get all meta fields.
     *
     * @return array
     */
    public function get_meta(): array
    {
        return $this->meta;
    }

    /**
     * Get a single meta field by key.
     *
     * @param string $key
     * @return mixed|null
     */
    public function get_meta_field(string $key): mixed
    {
        return $this->meta[$key] ?? null;
    }

    /**
     * Add or update a single meta field.
     *
     * @param string $key
     * @param mixed $value
     */
    public function set_meta_field(string $key, mixed $value): void
    {
        $this->validate_meta_key($key);
        $this->meta[$key] = $value;
    }

    /**
     * Remove a meta field.
     *
     * @param string $key
     */
    public function delete_meta_field(string $key): void
    {
        $this->validate_meta_key($key);
        unset($this->meta[$key]);
    }

    /**
     * Reset all meta fields to default values.
     */
    public function reset_meta_to_default(): void
    {
        $this->meta = $this->resolve_dynamic_defaults($this->default_meta);
    }

    /**
     * Validate a meta key against allowed keys if defined.
     *
     * @param string $key
     */
    protected function validate_meta_key(string $key): void
    {
        if (!empty($this->allowed_meta_keys) && !in_array($key, $this->allowed_meta_keys, true)) {
            throw new \InvalidArgumentException("Meta key '{$key}' is not allowed.");
        }
    }

    /**
     * Bulk update meta fields efficiently.
     *
     * @param array $bulk_meta
     */
    public function bulk_update_meta(array $bulk_meta): void
    {
        foreach ($bulk_meta as $key => $value) {
            $this->set_meta_field($key, $value);
        }
    }

    /**
     * Sync meta fields with the WordPress database.
     *
     * @param int $post_id
     */
    public function sync_meta_to_database(int $post_id): void
    {
        foreach ($this->meta as $key => $value) {
            if (isset($value)) {
                update_post_meta($post_id, $key, $value);
            } else {
                delete_post_meta($post_id, $key);
            }
        }
    }

    /**
     * Load meta from the WordPress database into the meta array.
     *
     * @param int $post_id
     */
    public function load_meta_from_database(int $post_id): void
    {
        foreach ($this->default_meta as $key => $default) {
            $this->meta[$key] = get_post_meta($post_id, $key, true) ?: $default;
        }
    }
}
