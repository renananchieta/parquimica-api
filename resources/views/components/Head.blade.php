<head>
    <meta charset="utf-8">
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <meta name="copyright" content="© {{ date('Y') }} New Box Tecnologia" />

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="{{ asset('img/parquimica-favicon.png') }}" sizes="192x192" />

    <title>{{ $seo['title'] }}</title>

    <meta name="editoria" content="New Box Tecnologia"/>
    <meta name="author" content="New Box - https://www.newboxinfo.com.br">
    <meta name="description" content="{{ $seo['meta_description'] }}">
    <meta name="keywords" content="{{ $seo['meta_keywords'] }}">

    <meta name="robots" content="index, follow" />
    <meta name="revisit-after" content="1 Day" />
    <meta name="rating" content="general" />

    <!-- META TAGS EXT -->
    <link rel="shortlink" href="{{ $seo['url'] }}"/>
    <link rel="canonical" href="{{ $seo['url'] }}" />
    <link rel="alternate" href="{{ $seo['url'] }}" />

    <meta property="og:title" content="{{ $seo['title'] }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ $seo['url'] }}" />
    <meta property="og:image" content="{{ $seo['image'] }}" />
    <meta property="og:image:alt" content="{{ $seo['title'] }}" />
    <meta property="og:site_name" content="{{ $seo['title'] }}" />
    <meta property="og:description" content="{{ $seo['meta_description'] }}" />
    <meta property="og:image:width" id="meta_width_imagem" content="500" />
    <meta property="og:image:height" id="meta_height_imagem" content="731" />
    <meta property="og:locale" content="pt_BR" />
    <meta property="fb:pages" content="109542657396699" />
    <meta property="fb:app_id" content="0" />

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:domain" content="{{ $seo['url'] }}">
    <meta name="twitter:title" content="{{ $seo['title'] }}" />
    <meta name="twitter:description" content="{{ $seo['meta_description'] }}" />
    <meta name="twitter:label1" content="Escrito por" />
    <meta name="twitter:data1" content="Redator do Site {{ config('app.name', 'Laravel') }}" />
    <meta name="twitter:label2" content="Tempo para leitura" />
    <meta name="twitter:data2" content="5 minutos" />
    <meta name="twitter:image" content="{{ $seo['image'] }}" />
    <meta property="twitter:image:width" content="500" />
    <meta property="twitter:image:height" content="731" />
    <meta property="twitter:image:alt" content="{{ $seo['image'] }}" />

    <link itemprop="thumbnailUrl" href="{{ $seo['image'] }}">
    <meta property="image" content="{{ $seo['image'] }}">
    <link rel="image_src" href="{{ $seo['image'] }}" />

    <script type="application/ld+json">
        {
          "@context": "http://schema.org",
          "@type": "Website",
          "name": "{{ $seo['title'] }}",
          "url": "{{ $seo['url'] }}",
          "publisher": {
            "@type": "Organization",
            "name": "{{ $seo['title'] }}",
            "logo": {
              "@type": "ImageObject",
              "url": "{{ $seo['image'] }}",
              "height": 731,
              "width": 500        }
          }
        }
    </script>

    {{-- @vite(['resources/css/app.css']) --}}
    <link href="{{secure_asset('css/fonts.css?v=1')}}" rel="stylesheet" media/>
    <link href="{{secure_asset('css/app-min.css?v=2')}}" rel="stylesheet" media/>
    <link href="{{secure_asset('css/banner-min.css?v=3')}}" rel="stylesheet" media/>
  
    <style>
        .submenu {
        display: none;
        }

        .nav li:hover .submenu {
        display: block;
        }
    </style>
    
</head>
