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
     * @param string|array $key   Config key value or array of keys and values.
     * @param mixed        $value Configuration value or null if $key is given an array.
     * 
     * @return self.
     */
    public function set($key, $value = null);
    
    /**
     * Check if a configuration value is set.
     * 
     * @param string $key Confifuration key to check. If null if given it will check if any value is set at all.
     * 
     * @return boolean True if the key exists, false if not.
     */
    public function has($key = null);
    
    /**
     * Get a configuration value.
     * 
     * @param string $key     Configuration key whose value to get.
     * @param mixed  $default Default value if the searched key is not found.
     * 
     * @return mixed Matching configuration value or $default if the key was not found.
     */
    public function get($key = null, $default = null);
    
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