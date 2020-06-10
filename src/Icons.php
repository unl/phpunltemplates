<?php
namespace UNL\Templates;

class Icons
{
    const ICON_ATTR_CONST_NAME = 'icon-const-name';
    const ICON_ATTR_NAME = 'icon-name';
    const ICON_ATTR_PATH = 'icon-path';

    const DEFAULT_SIZE = 5;

    const ICON_INFO = 'icon-info';
    const ICON_ALERT = 'icon-alert';
    const ICON_PERSON = 'icon-person';
    const ICON_PERSON_CIRCLE = 'icon-person-circle';

    static public function get($iconKey, $configJSON = NULL) {
        $icon = static::getIcon($iconKey);
        if (empty($icon)) { return '<!-- Invalid WDN Templates Icon: ' . $iconKey . '-->'; }
        $path = $icon[static::ICON_ATTR_PATH];

        // icon defaults
        $size = static::DEFAULT_SIZE;
        $title = $titleID = $ariaLabelledBy = uniqid($iconKey . '-');

        if (!empty($configJSON)) {
            $config = json_decode($configJSON);
            if ($config instanceof \stdClass) {
                if (property_exists($config, 'size')) {
                    $size = static::isValidSize($config->size) ? $config->size : static::DEFAULT_SIZE;
                }
                if (property_exists($config, 'title')) {
                    $title = $config->title;
                }
            }
        }
        return "<svg class=\"dcf-h-{$size} dcf-w-{$size} dcf-fill-current\" focusable=\"false\" height=\"16\" width=\"16\" viewBox=\"0 0 24 24\" aria-labelledby=\"{$ariaLabelledBy}\"><title id=\"{$titleID}\">{$title}</title>{$path}</svg>";
    }

    static public function getSizes() {
        return array(1,2,3,4,5,6,7,8,9,10,'100%');
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
            static::ICON_INFO => [
                static::ICON_ATTR_CONST_NAME => 'ICON_INFO',
                static::ICON_ATTR_NAME => 'Info',
                static::ICON_ATTR_PATH => '<path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/><path d="M0 0h24v24H0z" fill="none"/>'
            ],
            static::ICON_ALERT => [
                static::ICON_ATTR_CONST_NAME => 'ICON_ALERT',
                static::ICON_ATTR_NAME => 'Alert',
                static::ICON_ATTR_PATH => '<path d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"/><path d="M0 0h24v24H0z" fill="none"/>'
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

    static private function isValidSize($size) {
        return in_array($size, static::getSizes());
    }
}
