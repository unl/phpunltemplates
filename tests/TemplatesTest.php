<?php

namespace UNLTest\Templates;

use UNL\Templates\Templates;
use UNL\Templates\CachingService\NullService;
use UNL\Templates\CachingService\UNLCacheLite;
use UNL\DWT\Region;

class TemplatesTest extends \PHPUnit_Framework_TestCase
{
	protected $template;

	public function setUp()
	{
		$this->template = $this->getMockForAbstractClass(Templates::class);
	}

	public function testFactory()
	{
		$this->assertInstanceOf(Templates::class, Templates::factory('Debug', Templates::VERSION_4));

		Templates::$options['version'] = '';
		$this->assertInstanceOf(Templates::class, Templates::factory('Debug'));

		Templates::$options['version'] = '4';
		$this->assertInstanceOf(Templates::class, Templates::factory('Debug'));
	}

	/**
	 * @expectedException \UNL\Templates\Exception\UnexpectedValueException
	 */
	public function testFactoryClassDoesNotExist()
	{
		Templates::factory('Foo', Templates::VERSION_4);
	}

	/**
	 * @expectedException \UNL\Templates\Exception\UnexpectedValueException
	 */
	public function testFactoryClassDoesNotExtend()
	{
		// create a fake class that doesn't follow the correct inheritance
		$mock = $this->getMockBuilder('BadTemplate')->getMock();
		class_alias(get_class($mock), 'UNL\\Templates\\Version4\\Bad');

		Templates::factory('Bad', Templates::VERSION_4);
	}

	public function testNullCleanCache()
	{
		Templates::setCachingService(new NullService());
		$this->assertTrue(Templates::cleanCache());
	}

	public function testMockCacheLite()
	{
		if (!class_exists('Cache_Lite', false)) {
			class_alias('UNLTest\Templates\MockCacheLite', 'Cache_Lite');
		}

		Templates::setCachingService();
		Templates::cleanCache();
		Templates::setCachingService();
	}

	public function testMockUNLCacheLite()
	{
		if (!class_exists('UNL_Cache_Lite', false)) {
			class_alias('UNLTest\Templates\MockCacheLite', 'UNL_Cache_Lite');
		}

		Templates::setCachingService();
		Templates::cleanCache('foo');
		Templates::cleanCache('bar');
		Templates::setCachingService();
	}

	public function testBadRender()
	{
		$this->template->addHeadLink('foo', 'home');
		$this->assertEquals('', $this->template->toHtml());
	}
}
