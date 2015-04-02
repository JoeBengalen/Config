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
        $this->config->set([
            'databaseHost' => 'localhost',
            'databaseUser' => 'root',
        ]);
        
        $this->assertEquals('localhost', $this->config->get('databaseHost'));
        $this->assertEquals('root', $this->config->get('databaseUser'));
    }
    
    public function testSettingANonStringAndNonAssociativeArrayKeyThrowsInvalidArgumentException()
    {
        $this->setExpectedException('\InvalidArgumentException');
        
        $this->config->set(['invalid']);
    }
    
    public function testSettingKeyWithDotNotation()
    {
        $this->config->set('key1.key2', 'value');
        
        $this->assertInternalType('array', $this->config->get('key1'));
        $this->assertArrayHasKey('key2', $this->config->get('key1'));
        $this->assertEquals('value', $this->config->get('key1')['key2']);
    }

    public function testSettingAnArrayWithDotNotation()
    {
        $this->config->set([
            'database.host' => 'localhost',
            'database.user' => 'root',
        ]);
        
        $this->assertInternalType('array', $this->config->get('database'));
        $this->assertArrayHasKey('host', $this->config->get('database'));
        $this->assertArrayHasKey('user', $this->config->get('database'));
        $this->assertEquals('localhost', $this->config->get('database')['host']);
        $this->assertEquals('root', $this->config->get('database')['user']);
    }

    public function testSettingAMultiDimensionalArray()
    {
        $this->config->set([
            'key1' => [
                'value1',
                'value2',
            ],
        ]);
        
        $this->assertInternalType('array', $this->config->get('key1'));
        $this->assertEquals(['value1', 'value2'], $this->config->get('key1'));
    }

    public function testSettingAMultiDimensionalAssociativeArray()
    {
        $this->config->set([
            'key1' => [
                'key2.key3' => 'value1',
            ],
            'key4' => [
                'key5.with.dot' => 'value2',
                'value3',
                'value4',
            ],
        ]);
        
        $this->assertInternalType('array', $this->config->get('key1'));
        $this->assertArrayHasKey('key2', $this->config->get('key1'));
        $this->assertInternalType('array', $this->config->get('key1')['key2']);
        $this->assertArrayHasKey('key3', $this->config->get('key1')['key2']);
        $this->assertEquals('value1', $this->config->get('key1')['key2']['key3']);
        $this->assertEquals(['key5.with.dot' => 'value2', 'value3', 'value4'], $this->config->get('key4'));
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