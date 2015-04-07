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
        $result = $this->config->set('key', 'value');
        
        $this->assertEquals('value', $this->config->get('key'));
        $this->assertInstanceOf('\JoeBengalen\Config\Config', $result);
    }

    public function testSettingAnArrayOfConfigurationValues()
    {
         $result = $this->config->set([
            'databaseHost' => 'localhost',
            'databaseUser' => 'root',
        ]);
        
        $this->assertEquals('localhost', $this->config->get('databaseHost'));
        $this->assertEquals('root', $this->config->get('databaseUser'));
        $this->assertInstanceOf('\JoeBengalen\Config\Config', $result);
    }
    
    public function testSettingNonStringKeyThrowsException()
    {
        $this->setExpectedException('\InvalidArgumentException');
        
        $this->config->set(null, 'value');
    }
    
    public function testSettingKeyWithDotNotation()
    {
         $result = $this->config->set('key1.key2', 'value');
        
        $this->assertInternalType('array', $this->config->get('key1'));
        $this->assertArrayHasKey('key2', $this->config->get('key1'));
        $this->assertEquals('value', $this->config->get('key1')['key2']);
        $this->assertInstanceOf('\JoeBengalen\Config\Config', $result);
    }

    public function testSettingAnArrayWithDotNotation()
    {
        $result = $this->config->set([
            'database.host' => 'localhost',
            'database.user' => 'root',
        ]);
        
        $this->assertInternalType('array', $this->config->get('database'));
        $this->assertArrayHasKey('host', $this->config->get('database'));
        $this->assertArrayHasKey('user', $this->config->get('database'));
        $this->assertEquals('localhost', $this->config->get('database')['host']);
        $this->assertEquals('root', $this->config->get('database')['user']);
        $this->assertInstanceOf('\JoeBengalen\Config\Config', $result);
    }

    public function testSettingAMultiDimensionalArray()
    {
         $result = $this->config->set([
            'key1' => [
                'value1',
                'value2',
            ],
        ]);
        
        $this->assertInternalType('array', $this->config->get('key1'));
        $this->assertEquals(['value1', 'value2'], $this->config->get('key1'));
        $this->assertInstanceOf('\JoeBengalen\Config\Config', $result);
    }

    public function testSettingAMultiDimensionalAssociativeArray()
    {
         $result = $this->config->set([
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
        $this->assertInstanceOf('\JoeBengalen\Config\Config', $result);
    }

    public function testGettingAValue()
    {
        $this->config->set('key', 'value');
        
        $this->assertEquals('value', $this->config->get('key'));
    }
    
    public function testGettingAValueWithADotNotatedKey()
    {
        $this->config->set([
            'key1' => [
                'key2' => [
                    'key3' => 'value',
                ],
            ],
        ]);
        
        $this->assertEquals('value', $this->config->get('key1.key2.key3'));
    }
    
    public function testGettingANonExistingValueReturnsNull()
    {
        $this->assertNull($this->config->get('nothing'));
    }
    
    public function testGettingANonExistingValueWithDefault()
    {
        $this->assertEquals('default', $this->config->get('nothing', 'default'));
    }
    
    public function testGetWithoutArgumentReturnsAll()
    {
        $data = [
            'key1' => [
                'key2' => [
                    'key3' => 'value',
                ],
            ],
        ];
        
        $this->config->set($data);
        
        $this->assertEquals($data, $this->config->get());
    }
    
    public function testHasKey()
    {
        $this->config->set('exists');
        
        $this->assertTrue($this->config->has('exists'));
        $this->assertFalse($this->config->has('nothing'));
    }
    
    public function testHasWithDoNotatedKey()
    {        
        $this->config->set([
            'key1' => [
                'key2' => [
                    'key3' => 'value',
                ],
            ],
        ]);
        
        $this->assertTrue($this->config->has('key1.key2.key3'));
        $this->assertTrue($this->config->has('key1.key2'));
        $this->assertTrue($this->config->has('key1'));
        $this->assertFalse($this->config->has('key1.nothing'));
        $this->assertFalse($this->config->has('nothing'));
    }
    
    public function testHasAnything()
    {
        $this->assertFalse($this->config->has());
        
        $this->config->set('key', 'value');
        
        $this->assertTrue($this->config->has());
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