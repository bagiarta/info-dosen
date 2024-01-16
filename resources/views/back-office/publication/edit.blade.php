<x-layout bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebar activePage="backoffice.publication.index"></x-navbars.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage='Edit Publication'></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="card card-body mx-3 mx-md-4 ">
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h6 class="mb-3">Publication Form</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        @if (session('status'))
                            <div class="row">
                                <div class="alert alert-success alert-dismissible text-white" role="alert">
                                    <span class="text-sm">{{ Session::get('status') }}</span>
                                    <button type="button" class="btn-close text-lg py-3 opacity-10"
                                        data-bs-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        @endif
                        @if (Session::has('demo'))
                            <div class="row">
                                <div class="alert alert-danger alert-dismissible text-white" role="alert">
                                    <span class="text-sm">{{ Session::get('demo') }}</span>
                                    <button type="button" class="btn-close text-lg py-3 opacity-10"
                                        data-bs-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        @endif
                        <form method='POST' action='{{ route('backoffice.publication.update',$publication->id) }}' enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Owner*</label>
                                    <select class="form-control form-select border border-2 p-2" name="user_id" id="" required>
                                        <option class="form-control" id="" disabled selected></option>
                                        @foreach ($dosens as $dosen)
                                        <option class="form-control" {{ $dosen->id == $publication->user_id ? 'selected' : NULL }} value="{{ $dosen->id }}">{{ $dosen->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Title*</label>
                                    <input type="text" name="title" class=" form-control border border-2 p-2" placeholder="Nama Lengkap dengan Gelar" required
                                        value='{{ old('title',$publication->title) }}'>
                                    @error('title')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Author*</label>
                                    <input type="text" name="author" class=" form-control border border-2 p-2" placeholder="author" required
                                        value='{{ old('author',$publication->author) }}'>
                                    @error('author')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Published in*</label>
                                    <input type="text" name="published_in" class="form-control border border-2 p-2" required
                                    value='{{ old('published_in',$publication->published_in) }}'>
                                    @error('published_in')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Kategori*</label>
                                    <select class="form-control form-select border border-2 p-2" name="publication_category_id" onchange="get_sub_category(this)" id="" required>
                                        <option class="form-control" id="" disabled selected></option>
                                        @foreach ($publication_categories as $publication_category)
                                        <option class="form-control" {{ $publication_category->id == $publication->publication_category_id ? 'selected' : NULL }} value="{{ $publication_category->id }}">{{ $publication_category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('publication_category_id')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Sub Kategori*</label>
                                    <select id="subCategory" class="form-control form-select border border-2 p-2" name="publication_sub_category_id" id="" required>
                                        <option class="form-control" id="" disabled selected></option>
                                        @foreach ($publication_sub_categories as $publication_sub_category)
                                        <option class="form-control" {{ $publication_sub_category->id == $publication->publication_sub_category_id ? 'selected' : NULL }} value="{{ $publication_sub_category->id }}">{{ $publication_sub_category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('publication_sub_category_id')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Published At*</label>
                                    <input type="date" name="published_at" class=" form-control border border-2 p-2" placeholder="Ex : https://ejournal.example.ac.id/index.php/article/view/8060" required
                                        value='{{ old('published_at',$publication->published_at) }}'>
                                    @error('published_at')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">url*</label>
                                    <input type="text" name="url" class=" form-control border border-2 p-2" placeholder="Ex : https://ejournal.example.ac.id/index.php/article/view/8060" required
                                        value='{{ old('url',$publication->url) }}'>
                                    @error('url')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn bg-gradient-dark">Submit</button>
                        </form>

                    </div>
                </div>
            </div>

        </div>
        <x-footers.auth></x-footers.auth>
    </div>
    <x-plugins></x-plugins>
    @push('js')
    <script>
        function get_sub_category(that){
            fetch('{{ route('backoffice.publication.create') }}/?category='+that.value)
            .then(response => response.json())
            .then(response => {
                let text = '<option class="form-control" id="" disabled selected></option>';
                for(let subCat of response){
                    text = text+`<option class="form-control" id="" value="${subCat.id}">${subCat.name}</option>`
                }
                document.getElementById('subCategory').innerHTML = text
            })
        }
    </script>
        
    @endpush

</x-layout>
