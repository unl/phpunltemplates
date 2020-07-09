<?php
namespace UNL\Templates;

use UNL\Templates\Templates as UNL_Templates;

class Theme {

    const TYPE_APP = 'App';
    const TYPE_APP_LOCAL = 'AppLocal';
    const TYPE_FIXED = 'Fixed';
    const TYPE_LOCAL = 'Local';

    const CUSTOM_VERSION = 1;

    private $themePath;
    private $type;
    private $version;
    private $template;
    private $templateSavvy;
    private $page;
    private $isCustom = TRUE;

    public static $WDNIncludePath;

    public function __construct($savvy, $themePath, $type = NULL, $version = NULL, $template = NULL) {
        $this->templateSavvy = clone $savvy;
        $this->themePath = $themePath;

        // Set template paths with theme and maintain savvy
        $this->templateSavvy->setTemplatePath($themePath);
        $this->templateSavvy->addTemplatePath($savvy->getTemplatePath());

        if (!empty($template)) {
            $this->type = $type;
            $this->version = self::CUSTOM_VERSION;
            $this->template  = $template;
            $this->page = $this->setCustomThemePage();
            $this->isCustom = TRUE;
        } else {
            $this->type = (!empty($type)) ? $type : UNL_Templates::VERSION_DEFAULT;
            $this->version = (!empty($version)) ? $version : UNL_Templates::VERSION_DEFAULT;
            $this->page = UNL_Templates::factory($this->type, $this->version);
            $this->isCustom = FALSE;
        }
    }

    public function isCustomTheme() {
        return $this->isCustom;
    }

    public function getType() {
        return $this->type;
    }

    public function getPage() {
        return $this->page;
    }

    public function getWDNIncludePath() {
        return $this->WDNIncludePath;
    }

    public function setWDNIncludePath($wdnIncludePath){
        $this->WDNIncludePath = $wdnIncludePath;
    }

    public function renderThemeTemplate($context, $template){
        return $this->templateSavvy->render($context, $template);
    }

    public function addGlobal($name, $value){
        return $this->templateSavvy->addGlobal($name, $value);
    }

    private function setCustomThemePage() {

        $class = 'UNL\\Templates\\Custom' . $this->version . '\\' . $this->type;

        if (!class_exists($class)) {
            throw new Exception\UnexpectedValueException('Requested custom theme does not exist');
        }

        $instance = new $class;

        if (!$instance instanceof UNL_Templates) {
            throw new Exception\UnexpectedValueException('Template version must be an instance of Templates class');
        }

        $themeTemplate = $this->themePath . '/' . $this->template;
        if (!file_exists($themeTemplate)) {
            throw new Exception\UnexpectedValueException('Requested custom theme template does not exist (' . $themeTemplate . ')');
        }

        $instance->setTemplatePath($themeTemplate);

        return $instance;
    }
}
