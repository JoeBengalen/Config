<?php

namespace JoeBengalen\Config;

use InvalidArgumentException;
use RuntimeException;

class Config extends AbstractConfig
{
    /**
     * Load a configuration file.
     * 
     * @param string $file Path to php file which returns an array.
     * 
     * @return self.
     * 
     * @throws \InvalidArgumentException If $file is not a valid file.
     * @throws \RunTimeException If $file does not return an array.
     */
    public function load($file)
    {
        if (!is_string($file) || !file_exists($file)) {
            throw new InvalidArgumentException('File must be a valid file.');
        }
        
        $data = include $file;
        
        if (!is_array($data)) {
            throw new RuntimeException('File did not return an array.');
        }
        
        return $this->set($data);
    }
}