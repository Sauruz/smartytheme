<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="favicon.png">
        <meta name="revisit-after" content="1 month" />
        <title>{$page['title']} - {$page['site_name']}</title>
        <meta name="description" content="{$page['meta_description']}"/>
        <meta name="keywords" content="{if isset($tags)}{$tags}{/if}"/>
        <meta name="author" content="Guido Rus">
        <meta name="copyright" content="{date('Y')} {$page['site_name']} ©">
        <meta name="robots" content="All">
        <link rel="canonical" href="{$page['permalink']}" />
        <meta property="og:locale" content="nl_NL" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="{$page['meta_title']}"/>
        <meta property="og:description" content="{$page['meta_description']}" />
        <meta property="og:url" content="{$page['permalink']}" />
        <meta property="og:site_name" content="{$page['site_name']}" />
        <meta property="og:image" content="{$page['oggimage']}"/>
        <link href="{$wp_path}/dist/css/styles.css" rel="stylesheet">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <link class="favicon-element" rel="mask-icon" href="{$wp_path}/dist/img/favicons/safari-pinned-tab.svg" color="#4CAF4E">
        <link class="favicon-element" rel="apple-touch-icon" sizes="180x180" href="{$wp_path}/dist/img/favicons/apple-touch-icon.png">
        <link class="favicon-element" rel="icon" type="image/png" href="{$wp_path}/dist/img/favicons/favicon-32x32.png" sizes="32x32">
        <link class="favicon-element" rel="icon" type="image/png" href="{$wp_path}/dist/img/favicons/favicon-16x16.png" sizes="16x16">
        <link class="favicon-element" rel="manifest" href="{$wp_path}/dist/img/favicons/manifest.json">
        <link class="favicon-element" rel="mask-icon" href="{$wp_path}/dist/img/favicons/safari-pinned-tab.svg" color="#4CAF4E">
        <link class="favicon-element" rel="shortcut icon" href="{$wp_path}/dist/img/favicons/favicon.ico">
        <meta class="favicon-element" name="msapplication-TileColor" content="#4CAF4E">
        <meta class="favicon-element" name="msapplication-TileImage" content="{$wp_path}/dist/img/favicons/mstile-144x144.png">
        <meta class="favicon-element" name="msapplication-config" content="{$wp_path}/dist/img/favicons/browserconfig.xml">
        <meta class="favicon-element" name="theme-color" content="#4CAF4E">
    </head>
    <body>