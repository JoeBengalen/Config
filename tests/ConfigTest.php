<?php

namespace JoeBengalen\Config\Test;

use JoeBengalen\Config\Config;

class ConfigTest extends \PHPUnit_Framework_TestCase
{
    protected $config;
    
    public function setUp()
    {
        $this->config = new Config;
    }
    
    public function testSettingAValue()
    {
        $this->config->set('key', 'value');
        
        $this->assertEquals('value', $this->config->get('key'));
    }

    public function testSetingAnArray()
    {
        $this->config->set([
            'databaseHost' => '127.0.0.1',
            'databaseUser' => 'root',
        ]);
    }
    
    public function testSettingAKeyWithDotNotation()
    {
        $this->config->set('key1.key2', 'value');
        
        $this->assertInternalType('array', $this->config->get('key1'));
        $this->assertArrayHasKey('key2', $this->config->get('key1'));
        $this->assertEquals('value', $this->config->get('key1')['key2']);
        $this->assertEquals('value', $this->config->get('key1.key2'));
    }

    public function testSetingAnArrayWithDotNotation()
    {
        $this->config->set([
            'database.host' => '127.0.0.1',
            'database.user' => 'root',
        ]);
    }

    public function testSetingAMultiDimensionalArray()
    {
        $this->config->set([
            'key1' => [
                'key2.key3' => 'value',
            ],
        ]);
    }
    
    public function testGettingAValue()
    {
        $this->config->get('database');
    }
    
    public function testGettingAValueWithADotNotatedKey()
    {
        $this->config->get('key1.key2');
    }
    
    public function testGettingANonExistingValue()
    {
        $this->config->get('nothing');
    }
    
    public function testGettingANonExistingValueWithDefault()
    {
        $this->config->get('nothing', 'default');
    }
    
    public function testGetWithoutArgumentReturnsAll()
    {
        $this->config->get();
    }
    
    public function testHasKey()
    {
        // has should return true of a value of null is set!
        $this->config->has('database');
        $this->config->has('nothing');
    }
    
    public function testHasWithDoNotatedKey()
    {
        // has should return true of a value of null is set!
        $this->config->has('key1.key2');
    }
    
    public function testRemove()
    {
        $this->config->remove('database');
        $this->config->remove('key1.key2');
    }
    
    public function testSettingWithArrayAccess()
    {
        $this->config['key1']['key2'] = 'value';
    }
    
    public function testIssetWithArrayAccess()
    {
        var_dump(isset($this->config['database']));
        var_dump(isset($this->config['key1.key2']));
    }
    
    public function testGettingWithArrayAccess()
    {
        var_dump($this->config['database']);
        var_dump($this->config['key1.key2']);
    }
    
    public function testUnsettingWithArrayAccess()
    {
        unset($this->config['database']);
        unset($this->config['key1.key2']);
    }
    
    public function testCLearAll()
    {
        $this->config->clear();
    }
    
    public function testLoadPhpArrayFile()
    {
        $this->config->load('config.php');
    }
}