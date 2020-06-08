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

$options = Icons::getIconOptions();
$iconContent = '';
$iconKey = NULL;

if ($_POST) {
    $iconKey = $_POST['iconKey'];

    $title = $_POST['title'];
    $configTitle = !empty(trim($title)) ? '"title": "' . trim($title) . '", ': '';

    $width = $_POST['width'];
    $configWidth = !empty(trim($width)) ? '"width": "' . trim($width) . '", ': '';

    $height = $_POST['height'];
    $configHeight = !empty(trim($height)) ? '"height": "' . trim($height) . '", ': '';

    $viewBox = $_POST['viewBox'];
    $configViewBox = !empty(trim($viewBox)) ? '"viewBox": "' . trim($viewBox) . '", ': '';

    $style = $_POST['style'];
    $configStyle = !empty(trim($style)) ? '"style": "' . trim($style) . '", ': '';

    $configString = rtrim($configTitle . $configWidth . $configHeight . $configViewBox . $configStyle, ', ');
    $config = !empty($configString) ? '{' . $configString . '}' : NULL;
    $icon = Icons::get($iconKey, $config);

    $code = '\UNL\Templates\Icons::get(\UNL\Templates\Icons::' . Icons::getIconConstantName($iconKey);
    if (!empty($config)) {
        $code .= ', ' . $config;
    }
    $code .= ');';

    $iconContent = '
<div class="dcf-mt-6 dcf-mb-6 dcf-overflow-x-scroll">
    <div class="dcf-mb-3"><span class="dcf-bold">Icon:</span><br>' . $icon . '</div>
    <div class="dcf-mb-3"><span class="dcf-bold">SVG:</span><br>' . htmlentities($icon) . '</div>
    <div><span class="dcf-bold">PHP:</span><br>' . htmlentities($code) . '</div>
</div>';
}

$content = '
<form name="icon-form" class="dcf-form" method="POST">
    <fieldset>
        <legend>Icon Code Examples</legend>
        <p class="dcf-italic dcf-txt-xs">Note: Leave values blank to use SVG defaults.</p>
        
        <div class="dcf-form-group">
        <label for="icon">Icon</label>
            <select id="iconKey" name="iconKey">' . renderIconOptions($options, $iconKey) . '</select>
        </div>
        <div class="dcf-form-group">
            <label for="title">Title</label>
            <input id="title" name="title" type="text" value="'. $title .'">
        </div>
        <div class="dcf-form-group">
            <label for="height">Height</label>
            <input id="height" name="height" type="text" value="'. $height .'">
        </div>
        <div class="dcf-form-group">
            <label for="width">Width</label>
            <input id="width" name="width" type="text" value="'. $width .'">
        </div>
        <div class="dcf-form-group">
            <label for="viewBox">View Box</label>
            <input id="viewBox" name="viewBox" type="text" value="'. $viewBox .'">
        </div>
        <div class="dcf-form-group">
            <label for="style">Style</label>
            <input id="style" name="style" type="text" value="'. $style .'">
        </div>
    </fieldset>
    <input class="dcf-mt-6 dcf-btn dcf-btn-primary" name="submit" type="submit" value="Generate Icon">
</form>
';

$page->maincontentarea  = $content . $iconContent;
echo $page->toHTML();

function renderIconOptions($options, $selected) {
    $output = '';
    foreach ($options as $value => $label) {
        $selected = $value === $selected ? ' selected ' : '';
        $output .= '<option value="'. $value . '"'. $selected .'>' . $label . '</option>' . "\n";
    }
    return $output;
}
