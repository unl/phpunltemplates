<!DOCTYPE html>
<!--[if IEMobile 7 ]><html class="ie iem7"><![endif]-->
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"><![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"><![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"><![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7) ]><html class="ie" lang="en"><![endif]-->
<!--[if !(IEMobile) | !(IE)]><!--><html lang="en"><!-- InstanceBegin template="/Templates/debug.dwt" codeOutsideHTMLIsLocked="false" --><!--<![endif]-->
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta name="author" content="University of Nebraska-Lincoln | Web Developer Network" />
<meta name="viewport" content="initial-scale=1.0, width=device-width" />

<!-- For Microsoft -->
<!--[if IE]>
<meta http-equiv="cleartype" content="on">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<![endif]-->

<!-- For iPhone 4 -->
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/wdn/templates_4.0/includes/icons/h-apple-touch-icon-precomposed.png">
<!-- For iPad 1-->
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="/wdn/templates_4.0/includes/icons/m-apple-touch-icon-precomposed.png">
<!-- For iPhone 3G, iPod Touch and Android -->
<link rel="apple-touch-icon-precomposed" href="/wdn/templates_4.0/includes/icons/l-apple-touch-icon-precomposed.png">
<!-- For everything else -->
<link rel="shortcut icon" href="/wdn/templates_4.0/includes/icons/favicon.ico" />

<!--
    Membership and regular participation in the UNL Web Developer Network
    is required to use the UNL templates. Visit the WDN site at 
    http://wdn.unl.edu/. Click the WDN Registry link to log in and
    register your unl.edu site.
    All UNL template code is the property of the UNL Web Developer Network.
    The code seen in a source code view is not, and may not be used as, a 
    template. You may not use this code, a reverse-engineered version of 
    this code, or its associated visual presentation in whole or in part to
    create a derivative work.
    This message may not be removed from any pages based on the UNL site template.
    
    $Id: debug.dwt | 252c2891a48c70db689be6d897d4f34768b8258a | Thu Aug 1 15:08:19 2013 -0500 | Kevin Abel  $
-->
<!-- Load Cloud.typography fonts -->
	<link rel="stylesheet" type="text/css" media="all" href="//cloud.typography.com/7717652/616662/css/fonts.css" />
<!-- Load our base CSS file -->
<!--[if gte IE 9]><!-->    
    <link rel="stylesheet" type="text/css" media="all" href="/wdn/templates_4.0/css/all.css?dep=4.0.35" />
<!--<![endif]-->
    
<!-- Load the template JS file -->
    <script type="text/javascript" src="/wdn/templates_4.0/scripts/debug.js?dep=4.0.35" id="wdn_dependents"></script>
    
<!--[if lt IE 9]>
    <link rel="stylesheet" type="text/css" media="all" href="/wdn/templates_4.0/css/all_oldie.css?dep=4.0.35" />
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!-- For all IE versions, bring in the tweaks -->
<!--[if IE]>
    <link rel="stylesheet" type="text/css" media="all" href="/wdn/templates_4.0/css/ie.css" />
<![endif]-->

<!-- Load the print styles -->
    <link rel="stylesheet" type="text/css" media="print" href="/wdn/templates_4.0/css/print.css" />

<!-- InstanceBeginEditable name="doctitle" -->
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- Place optional header elements here -->
<!-- InstanceEndEditable -->
<!-- InstanceParam name="class" type="text" value="debug" -->
</head>
<body class="debug" data-version="4.0">
    <nav class="skipnav" role="navigation">
    <a href="#maincontent">Skip Navigation</a>
</nav>
    <div id="wdn_wrapper">
        <input type="checkbox" id="wdn_menu_toggle" value="Show navigation menu" class="wdn-content-slide wdn-input-driver" />
        <noscript>
    <!-- This is a simple shim to provide vertical space for the noscript warning -->
    <div id="wdn_noscript_padding"></div>
</noscript>

        <header id="header" role="banner" class="wdn-content-slide wdn-band">
            
            <div class="wdn-inner-wrapper">
                <div id="logo">
    <h3 class="wdn_list_descriptor wdn-text-hidden">Social Outposts</h3>
    <ul id="wdn_social">
        <li>
            <a href="https://www.facebook.com/UNLincoln" class="wdn-icon-facebook-circled">Facebook</a>
        </li>
        <li>
            <a href="https://twitter.com/UNLincoln" class="wdn-icon-twitter-circled">Twitter</a>
        </li>
    </ul>
    <a href="http://www.unl.edu/" title="UNL website" id="wdn_logo_link">UNL</a>
</div>
                <div id="wdn_resources">
                    <div class="wdn-resource-label wdn-resource-login-trigger" id="wdn_identity_management" role="navigation" aria-labelledby="wdn_idm_username">
    <div class="wdn-profile-options">
        <a class="wdn-icon-user wdn-idm-login" href="https://login.unl.edu/cas/login" id="wdn_idm_username" title="Log in to UNL" accesskey="l">
            My.UNL Login
        </a>
        <h3 class="wdn_list_descriptor wdn-text-hidden">Account Links</h3>
        <ul id="wdn_idm_user_options">
            <li id="wdn_idm_logout">
                <a href="https://login.unl.edu/cas/logout?url=http%3A//www.unl.edu/">Logout</a>
            </li>
        </ul>
    </div>
</div>

                    <div id="wdn_search" class="wdn-resource-label">
    <form id="wdn_search_form" action="//www1.unl.edu/search/" method="get" role="search">
		<label class="wdn-icon-search" for="wdn_search_query">Search</label>
        <input required accesskey="f" id="wdn_search_query" name="q" type="search" />
        <button type="submit" title="Search"></button>
    </form>
</div>

                </div>
                <span id="wdn_institution_title">University of Nebraska&ndash;Lincoln</span>
            </div>
            <div class="wdn-share-this-page" id="wdn-main-share-button">
<div class="wdn-share-button">
    <input type="checkbox" id="wdn_share_toggle" value="Show share options" class="wdn-input-driver" />
    <label for="wdn_share_toggle" class="wdn-icon-share"><span class="wdn-text-hidden">Share This Page</span></label>
    <ul class="wdn-share-options">
        <li><a href="http://go.unl.edu/?url=referer" id="wdn_createGoURL" class="wdn-icon-link" rel="nofollow">Get a Go URL</a></li>
        <li class="outpost" id="wdn_emailthis"><a href="mailto:" class="wdn-icon-mail" rel="nofollow">Email this page</a></li>
        <li class="outpost" id="wdn_facebook"><a href="https://www.facebook.com/sharer/sharer.php" class="wdn-icon-facebook" rel="nofollow">Share on Facebook</a></li>
        <li class="outpost" id="wdn_twitter"><a href="https://twitter.com/share" class="wdn-icon-twitter" rel="nofollow">Share on Twitter</a></li>
        <li class="outpost" id="wdn_linkedin"><a href="https://www.linkedin.com/shareArticle?mini=true" class="wdn-icon-linkedin-squared" rel="nofollow">Share on LinkedIn</a></li>
    </ul>
</div>
</div>
            <div class="wdn-inner-wrapper">
                <div id="wdn_site_title">
                    <span><!-- InstanceBeginEditable name="titlegraphic" --><!-- InstanceEndEditable --></span>
                </div>
            </div>
        </header>
        <div id="wdn_navigation_bar" role="navigation" class="wdn-band">
            <nav id="breadcrumbs" class="wdn-inner-wrapper">
                <!-- WDN: see glossary item 'breadcrumbs' -->
                <h3 class="wdn_list_descriptor wdn-text-hidden">Breadcrumbs</h3>
                <!-- InstanceBeginEditable name="breadcrumbs" -->
                <!-- InstanceEndEditable -->
            </nav>
            <div id="wdn_navigation_wrapper">
                <nav id="navigation" role="navigation" class="wdn-band">
                    <h3 class="wdn_list_descriptor wdn-text-hidden">Navigation</h3>
                    <!-- InstanceBeginEditable name="navlinks" -->
                    <!-- InstanceEndEditable -->
                    <label for="wdn_menu_toggle" class="wdn-icon-menu">Menu</label>
                </nav>
            </div>
        </div>
        <!-- Navigation Trigger -->
        <div class="wdn-menu-trigger wdn-content-slide">
            <label for="wdn_menu_toggle" class="wdn-icon-menu">Menu</label>
        </div>
        <!-- End navigation trigger -->
        <div id="wdn_content_wrapper" role="main" class="wdn-content-slide">
            <div class="wdn-band">
                <div class="wdn-inner-wrapper">
                    <div id="pagetitle">
                        <!-- InstanceBeginEditable name="pagetitle" -->
                        <!-- InstanceEndEditable -->
                    </div>
                </div>
            </div>
            <div id="maincontent" class="wdn-main">
                <!--THIS IS THE MAIN CONTENT AREA; WDN: see glossary item 'main content area' -->
                <!-- InstanceBeginEditable name="maincontentarea" -->
                <!-- InstanceEndEditable -->
                <!--THIS IS THE END OF THE MAIN CONTENT AREA.-->
            </div>
        </div>
        <div class="wdn-band wdn-content-slide" id="wdn_optional_footer">
            <div class="wdn-inner-wrapper">
                <!-- InstanceBeginEditable name="optionalfooter" -->
                <!-- InstanceEndEditable -->
            </div>
        </div>
        <footer id="footer" role="contentinfo" class="wdn-content-slide">
            <div class="wdn-band" id="wdn_footer_related">
                <div class="wdn-inner-wrapper">
                    <!-- InstanceBeginEditable name="leftcollinks" -->
                    <!-- InstanceEndEditable -->
                </div>
            </div>
            <div class="wdn-band">
                <div class="wdn-inner-wrapper">
                    <div class="footer_col" id="wdn_footer_contact">
                        <h3>Contact Us</h3>
                        <div class="wdn-contact-wrapper">
                            <!-- InstanceBeginEditable name="contactinfo" -->
                            <!-- InstanceEndEditable -->
                        </div>
                    </div>
                    <div id="wdn_copyright">
                        <div class="wdn-footer-text">
                            <!-- InstanceBeginEditable name="footercontent" -->
                            <!-- InstanceEndEditable -->
                            <span id="wdn_attribution"><br/><a href="http://www.unl.edu/equity/notice-nondiscrimination">Notice of Nondiscrimination</a><br/><br />UNL web templates and quality assurance provided by the <a href="http://wdn.unl.edu/" title="UNL Web Developer Network">Web&nbsp;Developer&nbsp;Network</a> &middot; <a href="https://webaudit.unl.edu/qa-test/" id="wdn_qa_link">QA&nbsp;Test</a></span>

                        </div>
                    <div id="wdn_logos">
    <div class="wdn-float-center">
        <a href="http://www.unl.edu/" id="unl_wordmark">UNL Home</a>
        <a href="http://www.bigten.org/" id="b1g_wordmark">Big Ten Website</a>
        <a href="http://www.cic.net/home" id="cic_wordmark">CIC Website</a>
        <a href="http://go.unl.edu/86bw" id="tips_wordmark">TIPS Incident Reporting</a>
    </div>
</div>
                    </div>
                </div>
            </div>
            <!-- Not currently used -->
        </footer>
        <noscript>
    <div id="wdn_noscript">
        <p class="wdn-content-slide">
            Some parts of this site work best with JavaScript enabled.
        </p>
    </div>
</noscript>

    </div>
</body>
<!-- InstanceEnd --></html>
