<?php
/**
 * Base class for Custom template files.
 *
 * @category  Templates
 * @package   UNL_Templates
 * @author    Jeff Sturek <jsturek8@unl.edu>
 * @copyright 2015 Regents of the University of Nebraska
 * @license   http://wdn.unl.edu/software-license BSD License
 */

namespace UNL\Templates;

abstract class Custom1 extends Templates
{
    const VERSION = '1';
    const LOCAL_NAME = 'Custom1';
    const SOURCE_ROOT = '';
    const INCLUDE_ROOT = '';
    const TOKEN_DEP_VERSION = false;

    private $templatePath = '';

    protected function getTemplatePath() {
        return $this->templatePath;
    }

    public function setTemplatePath($templatePath) {
        $this->templatePath = $templatePath;
    }
}
