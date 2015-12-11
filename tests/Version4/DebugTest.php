<?php

namespace UNLTest\Templates\Version4;

use UNL\Templates\Templates;
use UNL\Templates\CachingService\UNLCacheLite;

class DebugTest extends \PHPUnit_Framework_TestCase
{
	protected $template;

	public function setUp()
	{
		// stub the UNL_Cache_Lite class, if needed
		if (!class_exists('UNL_Cache_Lite', false)) {
			class_alias('UNLTest\Templates\MockCacheLite', 'UNL_Cache_Lite');
		}

		$cachingService = new UNLCacheLite();
		$cachingService->setOption('foo', 'bar');

		Templates::setCachingService($cachingService);
		$this->template = Templates::factory('Debug', Templates::VERSION_4);
	}

	public function testOutput()
	{
		$needle = 'This should appear in the test';
		$this->template->maincontentarea = $needle;

		Templates::$options['templatedependentspath'] = 'https://raw.githubusercontent.com/unl/wdntemplates/4.0';
		$output = (string) $this->template;
		$this->assertContains($needle, $output);
		$this->assertContains('data-version="4.0"', $output);
		Templates::$options['templatedependentspath'] = '';

		$this->template->setLocalIncludePath('http://nowhere.unl.edu');
		$output = (string) $this->template;
		$this->assertContains($needle, $output);
		$this->assertContains(Templates::INCLUDE_ERROR, $output);
	}
}
