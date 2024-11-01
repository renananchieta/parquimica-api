@if ($blog->isNotEmpty())

    <section>
        <div class="bg-light blog-section">
            <div class="container py-5">
                <div class="mb-4 linha_marcador">
                    <h2 class="marcador fw-bold">Mantenha-se informado</h2>
                </div>

                <div class="row">
                    @foreach ($blog as $post)

                    <div class="col-lg-3 col-md-6 mb-3">
                        <a href="{{ route('post', ['slug' => Str::slug($post['id'].'-'.$post['titulo'])]) }}" class="text-decoration-none">
                            <div class="card border-0 shadow-sm">
                                <img loading="lazy" src="{{ asset('img/empresa.webp') }}" class="img-fluid" width="412" height="auto" alt="{{ $post['titulo'] }}" title="{{ $post['titulo'] }}" />
                                <div class="card-body">
                                    <h3 class="text-secondary">{{ $post['titulo'] }}</h3>
                                    <a href="{{ route('post', ['slug' => Str::slug($post['id'].'-'.$post['titulo'])]) }}" class="btn btn-warning btn-sm" role="button" aria-disabled="true" title="{{ $post['titulo'] }}">Leia mais</a>
                                </div>
                            </div>
                        </a>
                    </div>

                    @endforeach

                </div>

            </div>
        </div>
    </section>
@endif
