<?php

namespace Ababilitworld\FlexTraitByAbabilitworld\Wordpress\Security\Sanitization;

trait Sanitization
{
    /**
     * Sanitize a string to escape HTML tags.
     *
     * @param string $value
     * @return string
     */
    public function sanitizeText($value)
    {
        return sanitize_text_field($value);
    }

    /**
     * Sanitize HTML content.
     *
     * @param string $value
     * @return string
     */
    public function sanitizeHTML($value)
    {
        return wp_kses_post($value);
    }

    /**
     * Sanitize email addresses.
     *
     * @param string $email
     * @return string
     */
    public function sanitizeEmail($email)
    {
        return sanitize_email($email);
    }

    /**
     * Sanitize URLs.
     *
     * @param string $url
     * @return string
     */
    public function sanitizeUrl($url)
    {
        return esc_url_raw($url);
    }

    /**
     * Sanitize an integer value.
     *
     * @param mixed $value
     * @return int
     */
    public function sanitizeInteger($value)
    {
        return absint($value);
    }

    /**
     * Sanitize floating-point numbers.
     *
     * @param mixed $value
     * @return float
     */
    public function sanitizeFloat($value)
    {
        return floatval($value);
    }

    /**
     * Sanitize a checkbox or boolean input.
     *
     * @param mixed $value
     * @return bool
     */
    public function sanitizeBoolean($value)
    {
        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Sanitize a file path.
     *
     * @param string $path
     * @return string
     */
    public function sanitizeFilePath($path)
    {
        return sanitize_file_name($path);
    }

    /**
     * Sanitize a key or slug.
     *
     * @param string $key
     * @return string
     */
    public function sanitizeKey($key)
    {
        return sanitize_key($key);
    }

    /**
     * Sanitize meta fields.
     *
     * @param mixed $meta
     * @return mixed
     */
    public function sanitizeMeta($meta)
    {
        return sanitize_meta('', $meta, '');
    }

    /**
     * Sanitize user input for a WordPress option.
     *
     * @param mixed $value
     * @return mixed
     */
    public function sanitizeOption($value)
    {
        return is_array($value) ? array_map('sanitize_text_field', $value) : sanitize_text_field($value);
    }

    /**
     * Sanitize a phone number.
     *
     * @param string $phone
     * @return string
     */
    public function sanitizePhone($phone)
    {
        return preg_replace('/[^0-9+]/', '', $phone);
    }

    /**
     * Sanitize a JSON string.
     *
     * @param string $json
     * @return string
     */
    public function sanitizeJSON($json)
    {
        $decoded = json_decode($json, true);
        return json_encode(is_array($decoded) ? array_map('sanitize_text_field', $decoded) : []);
    }

    /**
     * Sanitize a color hex code.
     *
     * @param string $color
     * @return string|null
     */
    public function sanitizeHexColor($color)
    {
        return preg_match('/^#([a-fA-F0-9]{3}|[a-fA-F0-9]{6})$/', $color) ? $color : null;
    }

    /**
     * Sanitize an array recursively.
     *
     * @param array $array
     * @return array
     */
    public function sanitizeArray(array $array)
    {
        return array_map(function ($item) {
            if (is_array($item)) {
                return $this->sanitizeArray($item);
            }
            return sanitize_text_field($item);
        }, $array);
    }

    /**
     * Sanitize a SQL-like string (caution: use prepared statements in queries).
     *
     * @param string $sql
     * @return string
     */
    public function sanitizeSQLLike($sql)
    {
        global $wpdb;
        return $wpdb->esc_like($sql);
    }

    /**
     * Sanitize input for user roles.
     *
     * @param string $role
     * @return string
     */
    public function sanitizeUserRole($role)
    {
        return sanitize_key($role);
    }
}
