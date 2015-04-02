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
    
    public function testSettingAConfigurationValue()
    {
        $this->config->set('key', 'value');
        
        $this->assertEquals('value', $this->config->get('key'));
    }

    public function testSettingAnArrayOfConfigurationValues()
    {
        /*
        $this->config->set([
            'databaseHost' => '127.0.0.1',
            'databaseUser' => 'root',
        ]);
        */
        $this->markTestIncomplete();
    }
    
    public function testSettingAKeyWithDotNotation()
    {
        /*
        $this->config->set('key1.key2', 'value');
        
        $this->assertInternalType('array', $this->config->get('key1'));
        $this->assertArrayHasKey('key2', $this->config->get('key1'));
        $this->assertEquals('value', $this->config->get('key1')['key2']);
        $this->assertEquals('value', $this->config->get('key1.key2'));
        */
        $this->markTestIncomplete();
    }

    public function testSettingAnArrayWithDotNotation()
    {
        /*
        $this->config->set([
            'database.host' => '127.0.0.1',
            'database.user' => 'root',
        ]);
        */
        $this->markTestIncomplete();
    }

    public function testSettingAMultiDimensionalArray()
    {
        /*
        $this->config->set([
            'key1' => [
                'key2.key3' => 'value',
            ],
        ]);
        */
        $this->markTestIncomplete();
    }
    
    public function testGettingAValue()
    {
        /*
        $this->config->get('database');
        */
        $this->markTestIncomplete();
    }
    
    public function testGettingAValueWithADotNotatedKey()
    {
        /*
        $this->config->get('key1.key2');
        */
        $this->markTestIncomplete();
    }
    
    public function testGettingANonExistingValue()
    {
        /*
        $this->config->get('nothing');
        */
        $this->markTestIncomplete();
    }
    
    public function testGettingANonExistingValueWithDefault()
    {
        /*
        $this->config->get('nothing', 'default');
        */
        $this->markTestIncomplete();
    }
    
    public function testGetWithoutArgumentReturnsAll()
    {
        /*
        $this->config->get();
        */
        $this->markTestIncomplete();
    }
    
    public function testHasKey()
    {
        /*
        // has should return true of a value of null is set!
        $this->config->has('database');
        $this->config->has('nothing');
        */
        $this->markTestIncomplete();
    }
    
    public function testHasWithDoNotatedKey()
    {
        /*
        // has should return true of a value of null is set!
        $this->config->has('key1.key2');
        */
        $this->markTestIncomplete();
    }
    
    public function testRemove()
    {
        /*
        $this->config->remove('database');
        $this->config->remove('key1.key2');
        */
        $this->markTestIncomplete();
    }
    
    public function testSettingWithArrayAccess()
    {
        /*
        $this->config['key1']['key2'] = 'value';
        */
        $this->markTestIncomplete();
    }
    
    public function testIssetWithArrayAccess()
    {
        /*
        var_dump(isset($this->config['database']));
        var_dump(isset($this->config['key1.key2']));
        */
        $this->markTestIncomplete();
    }
    
    public function testGettingWithArrayAccess()
    {
        /*
        var_dump($this->config['database']);
        var_dump($this->config['key1.key2']);
        */
        $this->markTestIncomplete();
    }
    
    public function testUnsettingWithArrayAccess()
    {
        /*
        unset($this->config['database']);
        unset($this->config['key1.key2']);
        */
        $this->markTestIncomplete();
    }
    
    public function testCLearAll()
    {
        /*
        $this->config->clear();
        */
        $this->markTestIncomplete();
    }
    
    public function testLoadPhpArrayFile()
    {
        /*
        $this->config->load('config.php');
        */
        $this->markTestIncomplete();
    }
}