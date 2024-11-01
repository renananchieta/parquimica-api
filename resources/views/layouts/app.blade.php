<!DOCTYPE html>
<html lang="pt-br">

    @include('components.Head', ['seo' => $seo])

    <body>
        @include('components.Header')
        {{-- @include('components.Menu') --}}

        @yield('content')

        @include('components.Footer')

    </body>
</html>
