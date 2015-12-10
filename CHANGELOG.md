## PHP UNL Templates Changelog

### 2.0.0
* Complete API refactor
* Removal of unsupported and end-of-life template versions
* Removed API for loading sharedcode files. These should be loaded manually

### 1.4.0

* Finalize support for version 4.0 of the templates
* Updated tpl files with latest from released templates
* Allow the makeIncludeReplacements to find files of any name
* Use local .tpl files instead of always pulling remotely
* Make HTML and DEP replacements when local files do not exist

### 1.3.0

* Add support for version 3.1 of the UNL Templates
* Update template cache files with validation fixes
* Reflect UNL_DWT API changes

### 1.2.0

* Update .tpl cache so template files are in sync with latest wdntemplates.
* Allow underscores within Version3 template include files.
* New templates:
  * Fixed_html5
  * Unlaffiliate
* Template updates:
  * Meta lang fixes
  * Remove IDM region from the secure template
  * Mobile template now supports navigation and move to HTML5

### 1.1.0

* Added the mobile template.
* Fix support for version 2 templates.
* Only set templatedependentspath if it has not been set.

### 1.0.0

* Added support for specifying the template version, 2 or 3
* `UNL_Templates::$options['version'] = 3;` to use the new templates
* Added the secure template
* Add debug template
* Updated Version 3 templates to reflect footer changes
* Multiple template caching backends
* Additional work to prevent broken pages
  * If local files are not present for the `<!--#include statements`, it will grab them remotely
  * If `wdn/templates_3.0` does not exist locally it will use a template with absolute references to prevent broken pages
* Auto loading of files - now supporting:
  * `optionalfooter` => `optionalFooter.html`
  * `collegenavigationlist` => `unitNavigation.html`
  * `contactinfo` => `footerContactInfo.html`
* New remote template scanner `UNL_Templates_Scanner` scans a rendered UNL Template page for the editable content areas
* Use static vars instead of `PEAR::getStaticProperty()` - fixes `E_STRICT` warnings
* Remove debug code causing cache to never be used
* Fix debugging
* Merge UNL_DWT::$options with options from ini file instead of overwriting
* Set default timezone to use before we use date functions
* Add newlines after header additions
* Fix addScriptDeclaration method to comment out CDATA to prevent syntax errors
* Add example of a custom class with auto-breadcrumb generation and body content loading

#### API Changes

* `addHeadLink($href, $relation, $relType = 'rel', array $attributes = array())`
* `addScript($url, $type = 'text/javascript')`
* `addScriptDeclaration($content, $type = 'text/javascript')`
* `addStyleDeclaration($content, $type = 'text/css')`
* `addStyleSheet($url, $media = 'all')`
* `__toString()` Now you can just use echo $page;

### 0.5.2

*  Add check that file can actually be opened.

### 0.5.1

* Change license to BSD, update `tpl_cache` to UNL Templates created on 2007-01-05. No other changes.
* All users with previous versions do not need to upgrade because the server will automatically serve out new tpl files.

### 0.5.0

* Updates the package to use the new 2006-08 UNL Templates. Template dependents `/ucomm/templatedependents/` are still required outside of this package. Added new replacement functions to handle the template dependent replacements.
* Removed `evalPHPFile` function... not needed anymore.
