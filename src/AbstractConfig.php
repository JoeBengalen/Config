<?php

namespace JoeBengalen\Config;

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
        $this->data[$key] = $value;
    }
    
    /**
     * {@inheritdoc}
     */
    public function has($key = null)
    {
        return array_key_exists($key, $this->data);
    }
    
    /**
     * {@inheritdoc}
     */
    public function get($key = null, $default = null)
    {
        if ($this->has($key)) {
            return $this->data[$key];
        }
        
        return $default;
    }
    
    /**
     * {@inheritdoc}
     */
    public function remove($key)
    {
        
    }
    
    /**
     * {@inheritdoc}
     */
    public function clear()
    {
        
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