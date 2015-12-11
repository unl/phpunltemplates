<?php

namespace UNLTest\Templates;

class MockCacheLite
{
	public function get($key, $group = '')
	{
		if ('bar' === $key) {
			return 'baz';
		}

		if ('4https://raw.githubusercontent.com/unl/wdntemplates/4.0Debug.tpl' === $key) {
			return file_get_contents(__DIR__ . '/_files/4.0Debug.tpl');
		}

		return false;
	}

	public function save($data, $key, $group = '')
	{
		return true;
	}

	public function clean($key)
	{
		return true;
	}

	public function remove($key)
	{
		return true;
	}

	public function setOption()
	{
	}
}
