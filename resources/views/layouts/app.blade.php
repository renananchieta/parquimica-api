<!DOCTYPE html>
<html lang="pt-br">

    @include('components.Head', ['seo' => $seo])

    <body>
        <noscript>
            <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5KFBF85M" height="0" width="0" style="display:none;visibility:hidden" title="TAG"></iframe>
        </noscript>
        
        @include('components.Header')
        {{-- @include('components.Menu') --}}

        @yield('content')

        @include('components.Footer')

    </body>
</html>
