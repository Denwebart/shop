<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

<?php echo '<?xml version="1.0" encoding="UTF-8"?>' ?>
<?php echo '<?xml-stylesheet type="text/xsl" href="' . asset('sitemap.xsl') . '"?>' ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    @foreach($sitemapItems as $item)
        @include('parts.xmlItem')

        {{ \App\Helpers\View::getChildrenPages($item, $item->getUrl(), 1, 'xml') }}
    @endforeach

    <image>
        <url>@if(is_object($siteLogo)){{ $siteLogo->value }}@endif</url>
        <title>@if(is_object($siteTitle)){{ $siteTitle->value }}@endif</title>
        <siteurl>shop.dev</siteurl>
        <copyright>2016 @if(date('Y') != 2016) - {{ date('Y') }} @endif ©</copyright>
    </image>
</urlset>