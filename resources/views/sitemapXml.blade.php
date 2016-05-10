<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}
{!! '<?xml-stylesheet type="text/xsl" href="' . asset('sitemap.xsl') . '"?>' !!}

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    @foreach($sitemapItems as $item)
        @include('parts.xmlItem')

        {{ \App\Helpers\View::getChildrenPages($item, 1, 'xml') }}
    @endforeach

</urlset>