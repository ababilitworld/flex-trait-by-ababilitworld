<?php

namespace Ababilitworld\FlexTraitByAbabilitworld\Wordpress\PostType\PostTypeV1\Arg;

trait Arg
{
    protected array $default_args = [];
    protected array $args = [];
    protected array $allowed_arg_keys = [];

    /**
     * Initialize default arguments with optional custom defaults and allowed keys.
     *
     * @param array $default_args
     * @param array $allowed_arg_keys
     */
    public function initialize_default_args(array $default_args = [], array $allowed_arg_keys = []): void
    {
        $base_default_args = [
            'public' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => true,
            'show_ui' => true,
            'hierarchical' => false,
            'supports' => ['title', 'editor', 'thumbnail'],
            'has_archive' => true,
            'rewrite' => true,
            'query_var' => true,
        ];

        $this->default_args = array_merge($base_default_args, $default_args);
        $this->allowed_arg_keys = $allowed_arg_keys;
        $this->args = $this->default_args; // Set initial args to default
    }

    /**
     * Get all default arguments.
     *
     * @return array
     */
    public function get_default_args(): array
    {
        return $this->default_args;
    }

    /**
     * Update a specific default argument.
     *
     * @param string $key
     * @param mixed $value
     */
    public function update_default_arg(string $key, mixed $value): void
    {
        $this->validate_arg_key($key);
        $this->default_args[$key] = $value;
    }

    /**
     * Set custom arguments, overriding the defaults where necessary.
     *
     * @param array $custom_args
     */
    public function set_args(array $custom_args = []): void
    {
        foreach ($custom_args as $key => $value) {
            $this->validate_arg_key($key);
        }
        $this->args = array_merge($this->default_args, $custom_args);
    }

    /**
     * Get all arguments.
     *
     * @return array
     */
    public function get_args(): array
    {
        return $this->args;
    }

    /**
     * Get a single argument by key.
     *
     * @param string $key
     * @return mixed|null
     */
    public function get_arg(string $key): mixed
    {
        return $this->args[$key] ?? null;
    }

    /**
     * Check if an argument exists.
     *
     * @param string $key
     * @return bool
     */
    public function arg_exists(string $key): bool
    {
        return isset($this->args[$key]);
    }

    /**
     * Reset arguments to default values.
     */
    public function reset_args_to_default(): void
    {
        $this->args = $this->default_args;
    }

    /**
     * Set a single custom argument.
     *
     * @param string $key
     * @param mixed $value
     */
    public function set_arg(string $key, mixed $value): void
    {
        $this->validate_arg_key($key);
        $this->args[$key] = $value;
    }

    /**
     * Validate an argument key if allowed keys are defined.
     *
     * @param string $key
     */
    protected function validate_arg_key(string $key): void
    {
        if (!empty($this->allowed_arg_keys) && !in_array($key, $this->allowed_arg_keys, true)) {
            throw new \InvalidArgumentException("Argument key '{$key}' is not allowed.");
        }
    }
}
