<?php
namespace UNL\Templates;

class Icons
{
    const ICON_ATTR_CONST_NAME = 'icon-const-name';
    const ICON_ATTR_NAME = 'icon-name';
    const ICON_ATTR_PATH = 'icon-path';

    const DEFAULT_HEIGHT = 20;
    const DEFAULT_WIDTH = 20;
    const DEFAULT_VIEW_BOX = '0 0 24 24';

    const ICON_INFO_PIN = 'icon-info-pin';
    const ICON_PERSON = 'icon-person';
    const ICON_PERSON_CIRCLE = 'icon-person-circle';

    const STYLE_FILL_BLACK = 'fill: rgb(0, 0, 0);';
    const STYLE_FILL_LIGHTBLUE = 'fill: rgb(36, 154, 181);';

    static public function get($iconKey, $configJSON = NULL) {
        $icon = static::getIcon($iconKey);
        if (empty($icon)) { return '<!-- Invalid WDN Templates Icon: ' . $iconKey . '-->'; }
        $path = $icon[static::ICON_ATTR_PATH];

        // icon defaults
        $viewBox = static::DEFAULT_VIEW_BOX;
        $width = static::DEFAULT_WIDTH;
        $height = static::DEFAULT_HEIGHT;
        $style = static::STYLE_FILL_BLACK;
        $title = $titleID = $ariaLabelledBy = uniqid($iconKey . '-');

        if (!empty($configJSON)) {
            $config = json_decode($configJSON);
            if ($config instanceof \stdClass) {
                if (property_exists($config, 'width')) {
                    $width = $config->width;
                }
                if (property_exists($config, 'height')) {
                    $height = $config->height;
                }
                if (property_exists($config, 'title')) {
                    $title = $config->title;
                }
                if (property_exists($config, 'viewBox')) {
                    $viewBox = $config->viewBox;
                }
                if (property_exists($config, 'style')) {
                    $style = $config->style;
                }
            }
        }

        return "<svg width=\"{$width}\" viewBox=\"{$viewBox}\" aria-labelledby=\"{$ariaLabelledBy}\" style=\"{$style}\" height=\"{$height}\"><title id=\"{$titleID}\">{$title}</title>{$path}</svg>";
    }

    static public function getIconOptions() {
        $iconOptions = array();
        $icons = static::getIcons();
        foreach ($icons as $iconKey => $icon) {
            $iconOptions[$iconKey] = $icon[static::ICON_ATTR_NAME];
        }
        return $iconOptions;
    }

    static public function getIconConstantName($iconKey) {
        $icons = static::getIcons();
        return array_key_exists($iconKey, $icons) ? $icons[$iconKey][static::ICON_ATTR_CONST_NAME] : NULL;
    }

    static private function getIcons() {
        return array(
            static::ICON_INFO_PIN => [
                static::ICON_ATTR_CONST_NAME => 'ICON_INFO_PIN',
                static::ICON_ATTR_NAME => 'Information Pin',
                static::ICON_ATTR_PATH => '<path d="M11.5,0C6.084,0,2,4.298,2,10c0,7.173,8.831,13.634,9.207,13.905C11.294,23.969,11.398,24,11.5,24s0.206-0.031,0.293-0.095 C12.168,23.634,21,17.173,21,10C21,4.298,16.916,0,11.5,0z M11,3.5c0.551,0,1,0.449,1,1c0,0.551-0.449,1-1,1c-0.552,0-1-0.449-1-1 C10,3.949,10.448,3.5,11,3.5z M13.5,14h-4C9.224,14,9,13.776,9,13.5C9,13.223,9.224,13,9.5,13H11V8H9.5C9.224,8,9,7.776,9,7.5 C9,7.223,9.224,7,9.5,7h2C11.776,7,12,7.223,12,7.5V13h1.5c0.276,0,0.5,0.223,0.5,0.5C14,13.776,13.776,14,13.5,14z"></path><path fill="none" d="M0 0H24V24H0z"></path>'
                ],
            static::ICON_PERSON => [
                static::ICON_ATTR_CONST_NAME => 'ICON_PERSON',
                static::ICON_ATTR_NAME => 'Person',
                static::ICON_ATTR_PATH => '<path d="M16.489,9.754c0.808-0.764,0.749-2.433,0.094-3c0.521-1.385,1.189-2.997,0.907-4.409C17.144,0.614,14.686,0,12.686,0 c-1.551,0-3.435,0.391-4.029,1.461C8.06,1.527,7.599,1.774,7.284,2.198C6.416,3.37,7.009,5.169,7.436,6.735 C6.781,7.303,6.703,8.99,7.511,9.754c0.111,1.588,1.05,2.561,1.489,2.934v2.408c-0.421,0.157-0.833,0.309-1.234,0.456 c-3.471,1.276-5.979,2.199-6.713,3.668C0.012,21.301,0,23.411,0,23.5C0,23.776,0.224,24,0.5,24h23c0.276,0,0.5-0.224,0.5-0.5 c0-0.089-0.012-2.199-1.053-4.28c-0.735-1.47-3.243-2.392-6.714-3.668c-0.4-0.148-0.813-0.299-1.233-0.456v-2.408 C15.439,12.314,16.378,11.342,16.489,9.754z"></path><g><path fill="none" d="M0 0H24V24H0z"></path></g>'
                ],
            static::ICON_PERSON_CIRCLE => [
                static::ICON_ATTR_CONST_NAME => 'ICON_PERSON_CIRCLE',
                static::ICON_ATTR_NAME => 'Person Circle',
                static::ICON_ATTR_PATH => '<path d="M12,0C5.383,0,0,5.383,0,12c0,3.18,1.232,6.177,3.469,8.438l0.001,0.001C5.743,22.735,8.772,24,12,24 c3.234,0,6.268-1.27,8.542-3.573C22.772,18.166,24,15.174,24,12C24,5.383,18.617,0,12,0z M20.095,19.428 c-1.055-0.626-5.165-2.116-5.595-2.275v-1.848c0.502-0.309,1.384-1.107,1.49-2.935c0.386-0.226,0.63-0.727,0.63-1.37 c0-0.578-0.197-1.043-0.52-1.294c0.242-0.757,0.681-2.145,0.385-3.327C16.138,4.992,14.256,4.5,12.75,4.5 c-1.342,0-2.982,0.391-3.569,1.456C8.477,5.922,8.085,6.229,7.891,6.487c-0.635,0.838-0.216,2.368,0.02,3.21 C7.582,9.946,7.38,10.415,7.38,11c0,0.643,0.244,1.144,0.63,1.37c0.106,1.828,0.989,2.626,1.49,2.935v1.848 c-0.385,0.144-4.464,1.625-5.583,2.288C2.04,17.405,1,14.782,1,12C1,5.935,5.935,1,12,1s11,4.935,11,11 C23,14.775,21.965,17.394,20.095,19.428z"></path><g><path fill="none" d="M0 0H24V24H0z"></path></g>'
                ]
        );
    }

    static private function getIcon($iconKey) {
        $icons = static::getIcons();
        return array_key_exists($iconKey, $icons) ? $icons[$iconKey] : NULL;
    }
}
