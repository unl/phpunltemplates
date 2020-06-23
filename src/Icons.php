<?php
namespace UNL\Templates;

class Icons
{
    const ICON_ATTR_CONST_NAME = 'icon-const-name';
    const ICON_ATTR_NAME = 'icon-name';
    const ICON_ATTR_PATH = 'icon-path';

    const DEFAULT_SIZE = 5;

    const ICON_ALERT = 'icon-alert';
    const ICON_ARROW_DOWN = 'icon-arrow-down';
    const ICON_ARROW_LEFT = 'icon-arrow-left';
    const ICON_ARROW_RIGHT = 'icon-arrow-right';
    const ICON_ARROW_UP = 'icon-arrow-up';
    const ICON_COMMENT = 'icon-comment';
    const ICON_INFO = 'icon-info';
    const ICON_PERSON = 'icon-person';
    const ICON_PERSON_CIRCLE = 'icon-person-circle';
    const ICON_PLUS = 'icon-plus';
    const ICON_ROCKET = 'icon-rocket';
    const ICON_RSS_BOX = 'icon-rss-box';
    const ICON_SEARCH = 'icon-search';
    const ICON_WRENCH = 'icon-wrench';

    static public function get($iconKey, $configJSON = NULL) {
        $icon = static::getIcon($iconKey);
        if (empty($icon)) { return '<!-- Invalid WDN Templates Icon: ' . $iconKey . '-->'; }
        $path = $icon[static::ICON_ATTR_PATH];

        // icon defaults
        $size = static::DEFAULT_SIZE;
        $title = str_replace('-', ' ', $iconKey);
        $titleID = $ariaLabelledBy = uniqid($iconKey . '-');

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
            static::ICON_ALERT => [
                static::ICON_ATTR_CONST_NAME => 'ICON_ALERT',
                static::ICON_ATTR_NAME => 'Alert',
                static::ICON_ATTR_PATH => '<path d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"/><path d="M0 0h24v24H0z" fill="none"/>'
            ],
            static::ICON_ARROW_DOWN => [
                static::ICON_ATTR_CONST_NAME => 'ICON_ARROW_DOWN',
                static::ICON_ATTR_NAME => 'Arrow Down',
                static::ICON_ATTR_PATH => '<path fill="none" d="M0 0h24v24H0V0z"/><path d="M20 12l-1.41-1.41L13 16.17V4h-2v12.17l-5.58-5.59L4 12l8 8 8-8z"/>'
            ],
            static::ICON_ARROW_LEFT => [
                static::ICON_ATTR_CONST_NAME => 'ICON_ARROW_LEFT',
                static::ICON_ATTR_NAME => 'Arrow Left',
                static::ICON_ATTR_PATH => '<path d="M0 0h24v24H0z" fill="none"/><path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>'
            ],
            static::ICON_ARROW_RIGHT => [
                static::ICON_ATTR_CONST_NAME => 'ICON_ARROW_RIGHT',
                static::ICON_ATTR_NAME => 'Arrow Right',
                static::ICON_ATTR_PATH => '<path d="M0 0h24v24H0z" fill="none"/><path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"/>'
            ],
            static::ICON_ARROW_UP => [
                static::ICON_ATTR_CONST_NAME => 'ICON_ARROW_UP',
                static::ICON_ATTR_NAME => 'Arrow Up',
                static::ICON_ATTR_PATH => '<path fill="none" d="M0 0h24v24H0V0z"/><path d="M4 12l1.41 1.41L11 7.83V20h2V7.83l5.58 5.59L20 12l-8-8-8 8z"/>'
            ],
            static::ICON_COMMENT => [
                static::ICON_ATTR_CONST_NAME => 'ICON_COMMENT',
                static::ICON_ATTR_NAME => 'Comment',
                static::ICON_ATTR_PATH => '<path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z"/><path d="M0 0h24v24H0z" fill="none"/>'
            ],
            static::ICON_INFO => [
                static::ICON_ATTR_CONST_NAME => 'ICON_INFO',
                static::ICON_ATTR_NAME => 'Info',
                static::ICON_ATTR_PATH => '<path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/><path d="M0 0h24v24H0z" fill="none"/>'
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
            ],
            static::ICON_PLUS => [
                static::ICON_ATTR_CONST_NAME => 'ICON_PLUS',
                static::ICON_ATTR_NAME => 'Plus (+)',
                static::ICON_ATTR_PATH => '<path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/><path d="M0 0h24v24H0z" fill="none"/>'
            ],
            static::ICON_ROCKET => [
                static::ICON_ATTR_CONST_NAME => 'ICON_ROCKET',
                static::ICON_ATTR_NAME => 'Rocket',
                static::ICON_ATTR_PATH => '<path d="M23.772.142c-.114-.115-.277-.168-.436-.141-.45.076-4.434.766-5.575 1.908-.528.527-6.769 6.785-9.893 9.918l4.236 4.223 9.9-9.898c1.142-1.141 1.832-5.125 1.907-5.574C23.939.417 23.887.255 23.772.142zM11.398 16.757l-4.235-4.223c-.651.654-1.054 1.057-1.054 1.057-.194.195-.194.512.002.707l3.52 3.519c.093.094.221.146.353.146.133 0 .26-.053.353-.146L11.398 16.757zM16.147 14.269c0-.203-.122-.385-.308-.463-.188-.078-.403-.035-.546.109l-4.648 4.647c-.08.078-.131.184-.144.297l-.5 4.375c-.024.211.088.414.279.508.07.033.144.049.218.049.13 0 .258-.051.354-.146l3.535-3.535c.475-.475 1.266-1.508 1.535-2.316.312-.934.267-2.188.237-3.018C16.153 14.579 16.147 14.405 16.147 14.269zM5.57 13.075l4.542-4.555c.137-.092.231-.24.231-.408 0-.021-.006-.502-.565-.502-.44 0-2.689.017-3.688.35C5.295 8.227 4.287 9.042 3.804 9.526l-3.535 3.535c-.152.152-.189.385-.092.578.085.17.259.275.446.275.024 0 .05-.002.075-.006l4.593-.691C5.397 13.2 5.494 13.151 5.57 13.075zM6.802 15.696c-.828-.828-2.148-.68-3.182.354-1.045 1.045-2.134 5.412-2.254 5.906-.042.17.009.35.133.473.095.096.222.146.353.146.039 0 .081-.004.12-.014.493-.123 4.846-1.225 5.892-2.268 1.056-1.059 1.198-2.338.352-3.184L6.802 15.696z"></path><g><path fill="none" d="M0 0H24V24H0z"></path></g>'
            ],
            static::ICON_RSS_BOX => [
                static::ICON_ATTR_CONST_NAME => 'ICON_RSS_BOX',
                static::ICON_ATTR_NAME => 'RSS Box',
                static::ICON_ATTR_PATH => '<path d="M20.512,0h-17c-1.931,0-3.5,1.57-3.5,3.5v17c0,1.931,1.569,3.5,3.5,3.5h17c1.93,0,3.5-1.569,3.5-3.5v-17 C24.012,1.57,22.441,0,20.512,0z M7.012,19c-1.104,0-2-0.897-2-2s0.896-2,2-2c1.103,0,2,0.898,2,2S8.114,19,7.012,19z M13.012,19 c0-4.411-3.59-8-8-8v-1c4.963,0,9,4.037,9,9H13.012z M18.012,19c0-7.168-5.832-13-13-13V5c7.719,0,14,6.28,14,14H18.012z"></path><g><path fill="none" d="M0 0H24V24H0z"></path></g>'
            ],
            static::ICON_SEARCH => [
                static::ICON_ATTR_CONST_NAME => 'ICON_SEARCH',
                static::ICON_ATTR_NAME => 'Search',
                static::ICON_ATTR_PATH => '<path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/><path d="M0 0h24v24H0z" fill="none"/>'
            ],
            static::ICON_WRENCH => [
                static::ICON_ATTR_CONST_NAME => 'ICON_WRENCH',
                static::ICON_ATTR_NAME => 'Wrench',
                static::ICON_ATTR_PATH => '<path clip-rule="evenodd" fill="none" d="M0 0h24v24H0z"/><path d="M22.7 19l-9.1-9.1c.9-2.3.4-5-1.5-6.9-2-2-5-2.4-7.4-1.3L9 6 6 9 1.6 4.7C.4 7.1.9 10.1 2.9 12.1c1.9 1.9 4.6 2.4 6.9 1.5l9.1 9.1c.4.4 1 .4 1.4 0l2.3-2.3c.5-.4.5-1.1.1-1.4z"/>'
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
