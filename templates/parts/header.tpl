<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="favicon.png">
        <meta name="author" content="Indaad www.indaad.nl" />
        <meta name="robots" content="index, follow" />
        <meta name="revisit-after" content="1 month" />
        <title>{$page['site_name']} - {$page['title']}</title>
        <meta name="description" content="{$page['meta_description']}"/>
        <meta name="keywords" content="{if isset($tags)}{$tags}{/if}"/>
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
        <link rel="shortcut icon" href="{$wp_path}/favicon.png" type="image/x-icon" />
    </head>
    <body>