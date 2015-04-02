<?php

namespace JoeBengalen\Config;

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
     * @param string $key Confifuration keu to check. If null if given it will check if any value is set at all.
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
     */
    public function remove($key);
    
    /**
     * Clear all configuration values.
     */
    public function clear();
}