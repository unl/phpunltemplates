<?php

namespace UNLTest\Templates;

use UnexpectedValueException;
use UNL\Templates\Templates;
use UNL\Templates\CachingService\NullService;
use UNL\Templates\CachingService\UNLCacheLite;
use UNL\DWT\Region;


class TemplatesTest extends \PHPUnit\Framework\TestCase
{
	protected $template;

	public function setUp(): void
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

	public function testFactoryClassDoesNotExist()
	{
		$this->expectException(UnexpectedValueException::class);

		Templates::factory('Foo', Templates::VERSION_4);
	}

	public function testFactoryClassDoesNotExtend()
	{
		$this->expectException(UnexpectedValueException::class);

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
		$this->assertTrue(Templates::cleanCache());
		Templates::setCachingService();
	}

	public function testMockUNLCacheLite()
	{
		if (!class_exists('UNL_Cache_Lite', false)) {
			class_alias('UNLTest\Templates\MockCacheLite', 'UNL_Cache_Lite');
		}

		Templates::setCachingService();
		$this->assertFalse(Templates::cleanCache('foo'));
		$this->assertTrue(Templates::cleanCache('bar'));
		Templates::setCachingService();
	}

	public function testBadRender()
	{
		$this->template->addHeadLink('foo', 'home');
		$this->assertEquals('', $this->template->toHtml());
	}

	public function testFactoryVersion6x1Debug()
	{
		$template = Templates::factory('Debug', Templates::VERSION_6_1);

		$this->assertInstanceOf(Templates::class, $template);
		$this->assertInstanceOf(\UNL\Templates\Version6x1\Debug::class, $template);
	}

	public function testFactoryVersion6x1AppLocal()
	{
		$template = Templates::factory('AppLocal', Templates::VERSION_6_1);

		$this->assertInstanceOf(Templates::class, $template);
		$this->assertInstanceOf(\UNL\Templates\Version6x1\AppLocal::class, $template);
	}

	public function testFactoryVersion6x1Fixed()
	{
		$template = Templates::factory('Fixed', Templates::VERSION_6_1);

		$this->assertInstanceOf(Templates::class, $template);
		$this->assertInstanceOf(\UNL\Templates\Version6x1\Fixed::class, $template);
	}
}
