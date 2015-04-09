<?php

namespace JoeBengalen\Config\Test;

use JoeBengalen\Config\Config;

class ConfigTest extends \PHPUnit_Framework_TestCase
{
    protected $config;

    public function setUp()
    {
        $this->config = new Config();
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
    
    public function testOverwritingExistingValueWithDotNotatedNesting()
    {
        $this->config->set('key1', 'value1');
        
        $this->assertEquals('value1', $this->config->get('key1'));
        
        $this->config->set('key1.key2', 'value2');
        
        $this->assertEquals(['key2' => 'value2'], $this->config->get('key1'));
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
        $this->config->set([
            'key1.key3' => 'value',
        ]);

        $this->assertEquals('default1', $this->config->get('nothing', 'default1'));
        $this->assertEquals('default2', $this->config->get('key1.nothing', 'default2'));
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
        $this->assertFalse($this->config->has('key1'));

        $this->config->set('key', 'value');

        $this->assertTrue($this->config->has('key'));

        $result = $this->config->remove('key');

        $this->assertFalse($this->config->has('key'));

        $this->assertInstanceOf('\JoeBengalen\Config\Config', $result);
    }

    public function testRemoveWithDotNotation()
    {
        $this->assertFalse($this->config->has('key1.key2.key3'));
        $this->assertFalse($this->config->has('key1.key2.key4'));

        $this->config->set([
            'key1' => [
                'key2' => [
                    'key3' => 'value1',
                    'key4' => 'value2',
                ],
            ],
        ]);

        $this->assertTrue($this->config->has('key1.key2.key3'));
        $this->assertTrue($this->config->has('key1.key2.key4'));

        $this->config->remove('key1.key2.nothing');
        $this->config->remove('key1.key2.key3');

        $this->assertFalse($this->config->has('key1.key2.key3'));
        $this->assertTrue($this->config->has('key1.key2.key4'));

        $this->config->remove('key1.key2');

        $this->assertFalse($this->config->has('key1.key2'));
        $this->assertTrue($this->config->has('key1'));

        $this->config->remove('key1');

        $this->assertFalse($this->config->has('key1'));
    }

    public function testClearAll()
    {
        $this->assertFalse($this->config->has());

        $this->config->set([
            'key1' => [
                'key2' => [
                    'key3' => 'value1',
                    'key4' => 'value2',
                ],
            ],
        ]);

        $this->assertTrue($this->config->has());

        $this->config->clear();

        $this->assertFalse($this->config->has());
    }

    public function testSettingWithArrayAccess()
    {
        $this->assertFalse($this->config->has('key1'));

        $this->config['key1']      = ['key2' => 'value1'];
        $this->config['key1.key3'] = 'value2';

        $this->assertTrue($this->config->has('key1'));
        $this->assertTrue($this->config->has('key1.key2'));
        $this->assertTrue($this->config->has('key1.key3'));
        $this->assertEquals('value1', $this->config->get('key1.key2'));
        $this->assertEquals('value2', $this->config->get('key1.key3'));
    }

    public function testIssetWithArrayAccess()
    {
        $this->assertFalse(isset($this->config['key1']));

        $this->config->set([
            'key1' => [
                'key2' => 'value1',
            ],
        ]);

        $this->assertTrue(isset($this->config['key1']));
        $this->assertTrue(isset($this->config['key1.key2']));
        $this->assertFalse(isset($this->config['key1.nothing']));
    }

    public function testGettingWithArrayAccess()
    {
        $this->config->set([
            'key1' => [
                'key2' => 'value',
            ],
        ]);

        $this->assertEquals(['key2' => 'value'], $this->config['key1']);
        $this->assertEquals('value', $this->config['key1.key2']);
        $this->assertNull($this->config['key1.nothing']);
    }

    public function testUnsettingWithArrayAccess()
    {
        $this->assertFalse($this->config->has('key1'));

        $this->config->set([
            'key1' => [
                'key2' => 'value1',
                'key3' => 'value2',
            ],
        ]);

        $this->assertTrue($this->config->has('key1.key2'));
        $this->assertTrue($this->config->has('key1.key3'));

        unset($this->config['key1.key2']);

        $this->assertFalse($this->config->has('key1.key2'));
        $this->assertTrue($this->config->has('key1.key3'));

        unset($this->config['key1']);

        $this->assertFalse($this->config->has('key1'));
    }

    public function testLoadingArrayFile()
    {
        $this->assertFalse($this->config->has());

        $this->config->load(__DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'array.php');

        $expected = [
            'key1' => [
                'key2' => 'value1',
                'key3' => 'value2',
            ],
            'key4' => [
                'key5' => 'value3',
            ],
            'key6' => [
                'value4',
                'value5',
                true,
                false,
                null,
            ],
        ];

        $this->assertEquals($expected, $this->config->get());
    }

    public function testLoadingEmptyArrayFile()
    {
        $this->assertFalse($this->config->has());

        $this->config->load(__DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'emptyArray.php');

        $this->assertFalse($this->config->has());
    }

    public function testLoadingNonExistingFileThrowsException()
    {
        $this->setExpectedException('\InvalidArgumentException');

        $this->config->load(__DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'notExisting.php');
    }

    public function testLoadingStringFileThrowsException()
    {
        $this->setExpectedException('\RuntimeException');

        $this->config->load(__DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'string.php');
    }
}
