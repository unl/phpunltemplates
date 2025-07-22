<?php

namespace UNLTest\Templates\Version6x0;

use UNL\Templates\Templates;
use UNL\Templates\CachingService\NullService;

class DebugTest extends \PHPUnit_Framework_TestCase
{
    protected $template;

    public function setUp()
    {
        Templates::setCachingService(new NullService());
        $this->template = Templates::factory('Debug', Templates::VERSION_6_0);
        $this->template->head = '';
        $this->template->jsbody = '';
    }

    public function testGetLocalIncludePath()
    {
        $this->template->setLocalIncludePath('foo');
        $this->assertEquals('foo', $this->template->getLocalIncludePath());
    }

    public function testAddScript()
    {
        $this->assertEquals($this->template, $this->template->addScript('foo.js'));
        $this->assertEquals('', $this->template->head);
        $this->assertEquals('<script src="foo.js"></script>' . PHP_EOL, $this->template->jsbody);

        $this->template->head = '';
        $this->template->jsbody = '';

        $this->template->addScript('foo.js', 'text/js-template');
        $this->assertEquals('', $this->template->head);
        $this->assertEquals('<script src="foo.js" type="text/js-template"></script>' . PHP_EOL, $this->template->jsbody);

        $this->template->head = '';
        $this->template->jsbody = '';

        $this->template->addScript('foo.js', '', TRUE);
        $this->assertEquals('<script src="foo.js"></script>' . PHP_EOL, $this->template->head);
        $this->assertEquals('', $this->template->jsbody);

        $this->template->head = '';
        $this->template->jsbody = '';

        $this->template->addScript('foo.js', 'text/js-template', TRUE);
        $this->assertEquals('<script src="foo.js" type="text/js-template"></script>' . PHP_EOL, $this->template->head);
        $this->assertEquals('', $this->template->jsbody);;
    }

    public function testAddSStylesheet()
    {
        $this->assertEquals($this->template, $this->template->addStyleSheet('foo.css'));
        $this->assertEquals('<link rel="stylesheet" href="foo.css"/>' . PHP_EOL, $this->template->head);

        $this->template->head = '';

        $this->template->addStyleSheet('foo.less', 'print');
        $this->assertEquals('<link media="print" rel="stylesheet" href="foo.less"/>' . PHP_EOL, $this->template->head);
    }
    public function testAddStyleDeclaration()
    {
        $this->assertEquals($this->template, $this->template->addStyleDeclaration('.foo {}'));
        $this->assertEquals('<style>.foo {}</style>' . PHP_EOL, $this->template->head);

        $this->template->head = '';

        $this->template->addStyleDeclaration('@foo = red;', 'text/less');
        $this->assertEquals('<style type="text/less">@foo = red;</style>' . PHP_EOL, $this->template->head);
    }

    public function testAddScriptDeclaration()
    {
        $this->assertEquals($this->template, $this->template->addScriptDeclaration('var foo;'));
        $this->assertEquals('', $this->template->head);
        $this->assertEquals('<script>var foo;</script>' . PHP_EOL, $this->template->jsbody);

        $this->template->head = '';
        $this->template->jsbody = '';

        $this->template->addScriptDeclaration('foo', 'text/js-template');
        $this->assertEquals('', $this->template->head);
        $this->assertEquals('<script type="text/js-template">foo</script>' . PHP_EOL, $this->template->jsbody);

        $this->template->head = '';
        $this->template->jsbody = '';

        // Test Force to append to head vs jsbody
        $this->template->addScriptDeclaration('var foo;', '', TRUE);
        $this->assertEquals('<script>var foo;</script>' . PHP_EOL, $this->template->head);
        $this->assertEquals('', $this->template->jsbody);

        $this->template->head = '';
        $this->template->jsbody = '';

        $this->template->addScriptDeclaration('foo', 'text/js-template', TRUE);
        $this->assertEquals('<script type="text/js-template">foo</script>' . PHP_EOL, $this->template->head);
        $this->assertEquals('', $this->template->jsbody);
    }

    public function testOutput()
    {
        $needle = 'This should appear in the test';
        $this->template->maincontentarea = $needle;

        $output = (string) $this->template;
        $this->assertContains($needle, $output);
        $this->assertContains('data-version="5.3"', $output);

        $this->template->setLocalIncludePath(__DIR__ . '/../_files/');
        $output = (string) $this->template;
        $this->assertContains($needle, $output);
        $this->assertContains('data-version="5.3"', $output);
    }
}
