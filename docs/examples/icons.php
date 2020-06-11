<?php

ini_set('display_errors', true);
error_reporting(E_ALL);

require_once __DIR__ . '/../../tests/bootstrap.php';

use UNL\Templates\Templates;
use UNL\Templates\Icons as Icons;

$page = Templates::factory('Fixed', Templates::VERSION_5_1);

$page->doctitle         = '<title>UNL Templates Icons</title>';
$page->affiliation      = '';
$page->titlegraphic     = 'UNL Templates Icons';
$page->pagetitle        = '<h1>Icon Example</h1>';
$page->navlinks         = '';
$page->breadcrumbs      = '';
$page->contactinfo      = '';

$iconOptions = Icons::getIconOptions();
$sizeOptions = array();
foreach (Icons::getSizes() as $sizeOption) {
    $sizeOptions[$sizeOption] = $sizeOption;
}
$iconContent = '';
$iconKey = NULL;

$title = '';
$size = '';

if ($_POST) {
    $iconKey = $_POST['iconKey'];

    $title = $_POST['title'];
    $configTitle = !empty(trim($title)) ? '"title": "' . trim($title) . '", ': '';

    $size = $_POST['size'];
    $configSize = !empty(trim($size)) ? '"size": "' . trim($size) . '", ': '';

    $configString = rtrim($configTitle . $configSize, ', ');
    $config = !empty($configString) ? '{' . $configString . '}' : NULL;
    $icon = Icons::get($iconKey, $config);

    $code = '\UNL\Templates\Icons::get(\UNL\Templates\Icons::' . Icons::getIconConstantName($iconKey);
    if (!empty($config)) {
        $code .= ', ' . $config;
    }
    $code .= ');';

    $iconContent = '
<dl class="dcf-mt-6 dcf-mb-6 dcf-overflow-x-scroll">
    <dt class="dcf-mb-3 dcf-bold">Icon:</dt>
    <dd>' . $icon . '</dd>
    <dt class="dcf-mb-3 dcf-bold">SVG:</dt>
    <dd>' . htmlentities($icon) . '</dd>
    <dt class="dcf-mb-3 dcf-bold">PHP:</dt>
    <dd>' . htmlentities($code) . '</dd>
</dl>';
}

$content = '
<form name="icon-form" class="dcf-form" method="POST">
    <fieldset>
        <legend>Icon Code Examples</legend>
        <p class="dcf-italic dcf-txt-xs">Note: Leave values blank to use SVG defaults.</p>
        
        <div class="dcf-form-group">
            <label for="icon">Icon</label>
            <select id="iconKey" name="iconKey">' . renderSelectOptions($iconOptions, $iconKey) . '</select>
        </div>
        <div class="dcf-form-group">
            <label for="title">Title</label>
            <input class="dcf-w-100%" id="title" name="title" type="text" maxlength="200" value="'. $title .'">
        </div>
        <div class="dcf-form-group">
            <label for="height">Size</label>
            <select id="size" name="size">
                <option value="">Default</option>
            ' . renderSelectOptions($sizeOptions, $size) . '</select>
        </div>
    </fieldset>
    <input class="dcf-mt-6 dcf-btn dcf-btn-primary" name="submit" type="submit" value="Generate Icon">
</form>
';

$page->maincontentarea  = $content . $iconContent;
echo $page->toHTML();

function renderSelectOptions($options, $selected) {
    $output = '';
    foreach ($options as $value => $label) {
        $selectedAttr = $value == $selected ? ' selected ' : '';
        $output .= '<option value="'. $value . '"'. $selectedAttr .'>' . $label . '</option>' . "\n";
    }
    return $output;
}
