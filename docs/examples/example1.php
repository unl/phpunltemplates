<?php

ini_set('display_errors', true);
error_reporting(E_ALL);

require_once __DIR__ . '/../../tests/bootstrap.php';

use UNL\Templates\Templates;

$page = Templates::factory('Fixed', Templates::VERSION_5);

// if we want to be certain we have the latest includes, uncomment the next line
// $page->setLocalIncludePath('https://unlcms.unl.edu');

$page->addScript('test.js');
$page->addScriptDeclaration('function sayHello(){alert("Hello!");}');
$page->addStylesheet('foo.css');
$page->addStyleDeclaration('.foo {font-weight:bold;}');
$page->titlegraphic     = 'Hello UNL Templates';
$page->pagetitle        = '<h1>This is my page title h1.</h1>';
$page->maincontentarea  = '<p>This is my main content.</p>';
$page->navlinks         = '<ul><li><a href="#">Hello world!</a></li></ul>';
$page->maincontentarea  .= highlight_file(__FILE__, true);
echo $page->toHTML();
