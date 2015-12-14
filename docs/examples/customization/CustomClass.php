<?php

namespace Example;

use UNL\Templates\Templates;

/**
 * @SuppressWarnings(PHPMD.Superglobals)
 */
class CustomClass
{
    protected $template;

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function __construct()
    {
        $this->template = Templates::factory('Fixed');
        $this->autoGenerate('Department of Mathematics', 'Math');
    }

    protected function autoGenerateBreadcrumbs(
        $unitShortName,
        array $organization = array(
            'name' => 'UNL',
            'url' => 'http://www.unl.edu/'
        ),
        $delimiter = ' | '
    ) {
        $scriptNamePath = explode(DIRECTORY_SEPARATOR, htmlentities($_SERVER['SCRIPT_NAME']));
        $scriptNamePath = explode('.', array_pop($scriptNamePath));
        $fileName = array_shift($scriptNamePath);
        $generatedBreadcrumbs = '';
        $generatedDocTitle    = '';

        $isIndexPage = preg_match('/index/', $fileName);

        $searchFor = array($_SERVER['DOCUMENT_ROOT'], '_');
        $replaceWith = array($unitShortName, ' ');

        $keys = explode(DIRECTORY_SEPARATOR, str_replace($searchFor, $replaceWith, getcwd()));
        $values = array();

        for ($i = count($keys)-1; $i >= 0; $i--) {
            array_push(
                $values,
                str_replace(
                    $_SERVER['DOCUMENT_ROOT'],
                    '',
                    implode(DIRECTORY_SEPARATOR, explode(DIRECTORY_SEPARATOR, getcwd(), -$i)) . DIRECTORY_SEPARATOR
                )
            );
        }

        for ($i = 0; $i < count($keys)  - $isIndexPage; $i++) {
            $generatedBreadcrumbs .= '<li><a href="'. $values[$i] .'">' . ucwords($keys[$i]) .' </a></li> ';
            $generatedDocTitle    .= ucwords($keys[$i]) . $delimiter;
        }

        $generatedBreadcrumbs .= '<li>'. ucwords($fileName) .'</li></ul>';
        $generatedDocTitle    .= ucwords($fileName);

        if ($isIndexPage) {
            $generatedBreadcrumbs .= '<li>'. ucwords(end($keys)) .'</li></ul>';
            $generatedDocTitle    .= ucwords(end($keys));
        }

        $doctitle    = '<title>' . $organization['name'] . $delimiter . $generatedDocTitle . '</title>';
        $breadcrumbs = '<ul><li class="first"><a href="'.$organization['url'].'">' .
            $organization['name'].'</a></li> ' . $generatedBreadcrumbs;

        $this->template->doctitle = $doctitle;
        $this->template->breadcrumbs = $breadcrumbs;
    }

    /**
     * This function finds an html file with the content of the body file and
     * inserts it into the template.
     *
     * @param string $unitName Name of the department/unit
     */
    protected function autoGenerateBody($unitName)
    {
        // The file that has the body is in the same dir with the same base file name.
        $scriptNamePath = explode(DIRECTORY_SEPARATOR, htmlentities($_SERVER['SCRIPT_NAME']));
        $scriptNamePath = explode('.', array_pop($scriptNamePath));
        $bodyFile = array_shift($scriptNamePath) . '.html';

        $maincontentArray = file(__DIR__ . DIRECTORY_SEPARATOR . $bodyFile);
        $maincontentarea = implode(' ', $maincontentArray);
        $subhead = preg_replace('/<!--\s*(.+)\s*-->/i', '$1', array_shift($maincontentArray));

        $titlegraphic = '<h1>' . $unitName . '</h1><h2>' . $subhead    . '</h2>';

        $this->template->titlegraphic    = $titlegraphic;
        $this->template->maincontentarea = $maincontentarea;
    }

    /**
     * Autogenerate the contents of a page.
     *
     * @param string $unitName      name of the unit/department
     * @param string $unitShortName abbreviation for the unit
     * @param array  $organization  organization heirarchy
     * @param string $delimiter     what separates files
     */
    protected function autoGenerate(
        $unitName,
        $unitShortName,
        array $organization = array(
            'name' => 'UNL',
            'url' => 'http://www.unl.edu/'
        ),
        $delimiter = ' | '
    ) {
        $this->autoGenerateBreadcrumbs($unitShortName, $organization, $delimiter);
        $this->autoGenerateBody($unitName);
    }

    /**
     * renders a string representation of the template
     *
     * @return string
     */
    public function __toString()
    {
        return $this->template->toHtml();
    }
}
