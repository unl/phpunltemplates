<?php
/**
 * Generates PHP template-definition classes from Dreamweaver template (.tpl / DWT) files.
 *
 * Usage:
 *   php generate_template_classes.php <input_dir> <output_dir> [VersionName]
 *
 * Example:
 *   php generate_template_classes.php data/tpl_cache/Version6x1 src/Version6x1
 *
 * If VersionName (e.g. Version6x1) is omitted, it is inferred from the name of the
 * input directory when it matches /^Version\d+x\d+$/.
 *
 * For each <Name>.tpl in the input directory, a <Name>.php file is written to the
 * output directory. Each class contains a $regions array whose keys are the
 * TemplateBeginEditable region names and whose values are the default content
 * found between TemplateBeginEditable and TemplateEndEditable.
 */

if (PHP_SAPI !== 'cli') {
    exit("This script must be run from the command line.\n");
}

if ($argc < 3) {
    fwrite(STDERR, "Usage: php {$argv[0]} <input_dir> <output_dir> [VersionName]\n");
    exit(1);
}

$inputDir  = rtrim($argv[1], '/\\');
$outputDir = rtrim($argv[2], '/\\');
$version   = $argv[3] ?? basename($inputDir);

if (!preg_match('/^Version\d+x\d+$/', $version)) {
    fwrite(STDERR, "Could not determine a version name like 'Version6x1' (got '$version'). Pass it as the third argument.\n");
    exit(1);
}

if (!is_dir($inputDir)) {
    fwrite(STDERR, "Input directory not found: $inputDir\n");
    exit(1);
}

if (!is_dir($outputDir) && !mkdir($outputDir, 0775, true)) {
    fwrite(STDERR, "Could not create output directory: $outputDir\n");
    exit(1);
}

/**
 * Escape a string for use inside a single-quoted PHP string literal.
 */
function php_single_quote(string $value): string
{
    return "'" . addcslashes($value, "'\\") . "'";
}

/**
 * Extract editable regions (name => default content) from DWT source.
 * Both TemplateBeginEditable and InstanceBeginEditable regions are returned,
 * in document order. Each begin marker is paired with its own kind of end
 * marker (TemplateEndEditable / InstanceEndEditable).
 */
function parse_regions(string $source): array
{
    $regions = array();
    $pattern = '/<!--\s*(Template|Instance)BeginEditable\s+name="([^"]+)"\s*-->(.*?)<!--\s*\1EndEditable\s*-->/s';

    if (preg_match_all($pattern, $source, $matches, PREG_SET_ORDER)) {
        foreach ($matches as $match) {
            $name = $match[2];
            if (isset($regions[$name])) {
                fwrite(STDERR, "Warning: duplicate region name '$name' found; keeping the first one.\n");
                continue;
            }
            $regions[$name] = $match[3];
        }
    }

    return $regions;
}

/**
 * Extract template params (<!-- TemplateParam name="x" type="text" value="y" -->).
 * Falls back to the default 'class' param when none are defined.
 */
function parse_params(string $source): array
{
    $params = array();

    if (preg_match_all('/<!--\s*TemplateParam\s+([^>]*?)-->/s', $source, $matches)) {
        foreach ($matches[1] as $attrString) {
            preg_match_all('/(\w+)="([^"]*)"/', $attrString, $attrs, PREG_SET_ORDER);
            $attributes = array();
            foreach ($attrs as $attr) {
                $attributes[$attr[1]] = $attr[2];
            }
            if (!isset($attributes['name'])) {
                continue;
            }
            $params[$attributes['name']] = array(
                'name'  => $attributes['name'],
                'value' => $attributes['value'] ?? '',
                'type'  => $attributes['type'] ?? 'text',
            );
        }
    }

    if (empty($params)) {
        $params['class'] = array('name' => 'class', 'value' => '', 'type' => 'text');
    }

    return $params;
}

/**
 * Convert a file base name into a CamelCase PHP class name, capitalizing each word.
 * Words are separated by any non-alphanumeric character (hyphen, underscore, space, dot).
 * e.g. "app_cloud" => "AppCloud", "my-page" => "MyPage", "app" => "App".
 * Existing inner capitals are kept, so "myPage" => "MyPage" and "MyPage" => "MyPage".
 */
function class_name_from_file(string $baseName): string
{
    $parts = preg_split('/[^A-Za-z0-9]+/', $baseName, -1, PREG_SPLIT_NO_EMPTY);
    $name  = implode('', array_map('ucfirst', $parts));
    if ($name === '' || ctype_digit($name[0])) {
        $name = '_' . $name;
    }
    return $name;
}

/**
 * Build the PHP class source for a template.
 */
function build_class(string $className, string $tplFile, string $version, array $regions, array $params): string
{
    $out  = "<?php\n";
    $out .= "/**\n * AUTO-GENERATED FILE\n */\n\n\n";
    $out .= "namespace UNL\\Templates\\{$version};\n\n";
    $out .= "/**\n";
    $out .= " * Template Definition for " . strtolower(pathinfo($tplFile, PATHINFO_FILENAME)) . ".dwt\n";
    $out .= " *\n";
    $out .= " * This class is an auto-generated class. Do not manually edit.\n";
    $out .= " */\n";
    $out .= "class {$className} extends \\UNL\\Templates\\{$version}\n{\n\n";
    $out .= "    protected \$template = " . php_single_quote($tplFile) . ";\n\n";

    $out .= "    protected \$regions = array(\n";
    foreach ($regions as $name => $content) {
        $out .= "        " . php_single_quote($name) . " => " . php_single_quote($content) . ",\n";
    }
    $out .= "    );\n\n";

    $out .= "    protected \$params = array(\n";
    foreach ($params as $key => $param) {
        $out .= "        " . php_single_quote($key) . " => array(\n";
        $out .= "            'name' => " . php_single_quote($param['name']) . ",\n";
        $out .= "            'value' => " . php_single_quote($param['value']) . ",\n";
        $out .= "            'type' => " . php_single_quote($param['type']) . ",\n";
        $out .= "        ),\n";
    }
    $out .= "    );\n\n\n";
    $out .= "}\n\n";

    return $out;
}

$files = glob($inputDir . '/*.tpl');
if (!$files) {
    fwrite(STDERR, "No .tpl files found in $inputDir\n");
    exit(1);
}
sort($files);

$count = 0;
foreach ($files as $path) {
    $tplFile = basename($path);
    $source  = file_get_contents($path);

    if ($source === false) {
        fwrite(STDERR, "Could not read $path, skipping.\n");
        continue;
    }

    $regions = parse_regions($source);
    if (empty($regions)) {
        fwrite(STDERR, "Warning: no editable regions found in $tplFile\n");
    }

    $className = class_name_from_file(pathinfo($tplFile, PATHINFO_FILENAME));
    $code      = build_class($className, $tplFile, $version, $regions, parse_params($source));
    $target    = $outputDir . '/' . $className . '.php';

    if (file_put_contents($target, $code) === false) {
        fwrite(STDERR, "Could not write $target\n");
        continue;
    }

    echo "Generated $target (" . count($regions) . " regions)\n";
    $count++;
}

echo "Done. $count class file(s) generated.\n";