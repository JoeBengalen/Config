<?php

namespace JoeBengalen\Config;

use InvalidArgumentException;

/**
 * Class support keys with dot notation.
 * 
 * Internally all dot notated keys are stored as arrays.
 */
abstract class AbstractConfig  implements ConfigInterface
{
    /**
     * @var array Configuration data.
     */
    protected $data = [];
    
    /**
     * {@inheritdoc}
     */
    public function set($key, $value = null)
    {
        if (is_array($key)) {
            foreach ($key as $k => $v) {
                $this->set($k, $v);
            }
        } elseif (is_string($key)) {
            if (strpos($key, '.') !== false) {
                $this->setDotNotationKey($key, $value); 
            } else {
                // If the value is an array of only string keys, call this 
                // function again to make sure nested dot notations are processed.
                if (is_array($value) && $this->containsOnlyStringKeys($value)) {
                    foreach ($value as $k => $v) {
                        $this->set("$key.$k", $v);
                    }
                } else {
                    $this->data[$key] = $value;
                }
            }
        } else {
            throw new InvalidArgumentException('Key must be a string or an associative array');
        }
        
        return $this;
    }
    
    /**
     * {@inheritdoc}
     */
    public function has($key = null)
    {
        if (is_null($key)) {
            return !empty($this->data);
        }
        
        $segs = explode('.', $key);
        $root = $this->data;
        
        // nested case
        foreach ($segs as $part) {
            if (!array_key_exists($part, $root)) {
                return false;
            }
            
            $root = $root[$part];
        }
        
        return true;
    }
    
    /**
     * {@inheritdoc}
     */
    public function get($key = null, $default = null)
    {
        if (is_null($key)) {
            return $this->data;
        }
        
        if (!$this->has($key)) {
            return $default;
        }

        $segs = explode('.', $key);
        $root = $this->data;

        foreach ($segs as $part) {
            if (array_key_exists($part, $root)) {
                $root = $root[$part];
                continue;
            }
            
            $root = $default;
            break;
        }
        
        return $root;
    }
    
    /**
     * {@inheritdoc}
     */
    public function remove($key)
    {
        if ($this->has($key)) {
            $segs = explode('.', $key);
            $root = &$this->data;

            foreach ($segs as $part) {
                if (!array_key_exists($part, $root)) {
                    return;
                }
                
                $parent = &$root; // set previous root as parent
                $root = &$root[$part];
            }
            
            unset($parent[$part]);
        }
        
        return $this;
    }
    
    /**
     * {@inheritdoc}
     */
    public function clear()
    {
        $this->data = [];
    }
    
    /**
     * Handle setting a configuration value with a dot notation key.
     * 
     * @param string $key   Dot notation key.
     * @param mixed  $value Configuration value.
     */
    protected function setDotNotationKey($key, $value)
    {
        $splitKey = explode('.', $key);
        $root = &$this->data;
        // Look for the key, creating nested keys if needed
        while ($part = array_shift($splitKey)) {
            if (!isset($root[$part]) && count($splitKey)) {
                $root[$part] = array();
            }
            $root = &$root[$part];
        }
        
        $root = $value;
    }
    
    /**
     * Check if an array contains only string keys.
     * 
     * @param array $array Array to check.
     * 
     * @return bool True if array only contains string keys, false if not.
     */
    protected function containsOnlyStringKeys(array $array)
    {
        return count($array) === count(array_filter(array_keys($array), 'is_string'));
    }
    
    /*******************************************************
     * \ArrayAccess
     *******************************************************/
    
    /**
     * {@inheritdoc}
     */
    public function offsetSet($offset, $value)
    {
        $this->set($offset, $value);
    }
    
    /**
     * {@inheritdoc}
     */
    public function offsetExists($offset)
    {
       return $this->has($offset);
    }
    
    /**
     * {@inheritdoc}
     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }
    
    /**
     * {@inheritdoc}
     */
    public function offsetUnset($offset)
    {
        $this->remove($offset);
    }
}