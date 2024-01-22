@extends('front-page.template')
@section('head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
@endsection
@section('body')
    @php
        use Illuminate\Support\Str;
    @endphp
    <div class="" style="margin-top:150px">
        <main class="container">
            <div class="p-4 p-md-5 mb-4 text-white w-100 rounded bg-dark">
                <div class="col-md-6 col-lg-12 px-0">
                    <img src="{{ asset($user->photo ? $user->photo:'assets/img/profile.png') }}" alt="">
                    <h1 class="display-4 fst-italic">{{ $user->name }}</h1>
                    <p class="lead my-3">{{ $user->lecturer_user->nip }} - {{ $user->lecturer_user->nidn }}</p>
                    <p class="lead my-3">{{ $user->lecturer_user->faculty }} - {{ $user->lecturer_user->study_program }}
                    </p>
                    <p class="lead my-3">{{ $user->lecturer_user->lecturer_status }} - {{ $user->lecturer_user->is_active }}
                    </p>
                    <p class="lead my-3">{{ $user->lecturer_user->jenis_kelamin == 'L' ? 'Laki Laki' : ($user->lecturer_user->jenis_kelamin == 'P' ? 'Perempuan' : '') }}
                    </p>
                    <p class="lead my-3 rounded-pill bg-success p-3" style="width: max-content">
                        {{ $user->lecturer_user->status }} </p>
                </div>
            </div>

            {{-- <div class="row mb-2">
                <div class="col-md-6">
                    <div
                        class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-static">
                            <strong class="d-inline-block mb-2 text-primary">World</strong>
                            <h3 class="mb-0">Featured post</h3>
                            <div class="mb-1 text-muted">Nov 12</div>
                            <p class="card-text mb-auto">This is a wider card with supporting text below as a natural
                                lead-in to
                                additional content.</p>
                            <a href="#" class="stretched-link">Continue reading</a>
                        </div>
                        <div class="col-auto d-none d-lg-block">
                            <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg"
                                role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice"
                                focusable="false">
                                <title>Placeholder</title>
                                <rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%"
                                    fill="#eceeef" dy=".3em">Thumbnail</text>
                            </svg>

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div
                        class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-static">
                            <strong class="d-inline-block mb-2 text-success">Design</strong>
                            <h3 class="mb-0">Post title</h3>
                            <div class="mb-1 text-muted">Nov 11</div>
                            <p class="mb-auto">This is a wider card with supporting text below as a natural lead-in to
                                additional content.</p>
                            <a href="#" class="stretched-link">Continue reading</a>
                        </div>
                        <div class="col-auto d-none d-lg-block">
                            <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg"
                                role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice"
                                focusable="false">
                                <title>Placeholder</title>
                                <rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%"
                                    fill="#eceeef" dy=".3em">Thumbnail</text>
                            </svg>

                        </div>
                    </div>
                </div>
            </div> --}}

            <div class="row g-5">
                <div class="col-md-8">
                    <article class="blog-post">
                        <h2 class="blog-post-title">Deskripsi</h2>
                        {{-- <p class="blog-post-meta">January 1, 2021 by <a href="#">Mark</a></p> --}}
                        <p>{{ $user->lecturer_user->description }}.</p>
                    </article>
                    <hr>

                    <article class="blog-post row" id="table">
                        <div class="col-6">
                            <h2 class="blog-post-title">Topic</h2>
                            <p class="blog-post-meta">{{ $user->lecturer_user->topic }}</p>
                        </div>
                        <div class="col-6">
                            <h2 class="blog-post-title">Agama</h2>
                            <p class="blog-post-meta">{{ $user->lecturer_user->religion ? $user->lecturer_user->religion->name : '' }}</p>
                        </div>
                        <div class="col-6">
                            <h2 class="blog-post-title">Tanggal Lahir</h2>
                            <p class="blog-post-meta">{{ $user->lecturer_user->birthday ? date('d-M-Y', strtotime($user->lecturer_user->birthday)) : '' }}</p>
                        </div>
                    </article>
                    <hr>
                    @foreach ($publications as $publication)
                        <article class="blog-post">
                            <h2 id="{{ Str::slug($publication->name) }}" class="blog-post-title">{{ $publication->name }}</h2>
                            @foreach ($publication->publication_sub_categories as $pub_sub)
                                <h3 id="{{ Str::slug($pub_sub->name) }}" class="blog-post-title">{{ $pub_sub->name }}</h3>
                                @foreach ($pub_sub->lecturer_publications as $lec_pub)
                                    <a href="{{ $lec_pub->url }}" target="_blank">
                                        <h5 class="">
                                            {{ $lec_pub->author }}.{{ $lec_pub->title }}.{{ $lec_pub->published_in }}.{{ date('Y', strtotime($lec_pub->published_at)) }}
                                        </h5>
                                    </a>
                                @endforeach
                            @endforeach
                        </article>
                        <hr>
                    @endforeach


                </div>

                <div class="col-md-4">
                    <div class="position-sticky" style="top: 2rem;">
                        <div class="p-4">
                            <h4 class="fst-italic">Publikasi</h4>
                            <ol class="list-unstyled mb-0 ms-3">
                                @foreach ($publications as $publication)
                                    <li><a href="#{{ Str::slug($publication->name) }}">{{ $publication->name }}</a></li>
                                    <ol class="list-unstyled mb-0 ms-5">
                                      @foreach ($publication->publication_sub_categories as $pub_sub)
                                      <li><a href="#{{ Str::slug($pub_sub->name) }}">{{ $pub_sub->name }}</a></li>
                                      @endforeach
                                    </ol>
                                @endforeach
                            </ol>

                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
@endsection
