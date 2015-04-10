<?php

/**
 * JoeBengalen Config library.
 *
 * @author      Martijn Wennink <joebengalen@gmail.com>
 * @copyright   Copyright (c) 2015 Martijn Wennink
 * @link        https://github.com/JoeBengalen/Config
 * @license     https://github.com/JoeBengalen/Config/blob/master/LICENSE.md (MIT License)
 * @version     1.0.0
 */

namespace JoeBengalen\Config;

/**
 * Config Interface.
 */
interface ConfigInterface extends \ArrayAccess
{
    /**
     * Set one or more configuration values.
     *
     * @param string|array $key   Configuration key or an array of keys and values.
     * @param mixed|null   $value Configuration value or null if $key is given an array.
     *
     * @return self.
     */
    public function set($key, $value = null);

    /**
     * Check if a configuration value is set.
     *
     * @param string $key Configuration key to check. If null is given it will check if any value is set at all.
     *
     * @return bool True if the key exists, false if not.
     */
    public function has($key = null);

    /**
     * Get a configuration value.
     *
     * @param string $key Configuration key whose value to get.
     *
     * @return mixed|null Matching configuration value or null if the key was not found.
     */
    public function get($key = null);

    /**
     * Remove a configuration value.
     *
     * @param string $key Configuration key to remove.
     *
     * @return self.
     */
    public function remove($key);

    /**
     * Clear all configuration values.
     */
    public function clear();
}
