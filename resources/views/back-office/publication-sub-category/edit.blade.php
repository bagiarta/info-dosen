<x-layout bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebar activePage="backoffice.publication-sub-category.index"></x-navbars.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage='Edit Publication Sub Category'></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="card card-body mx-3 mx-md-4 ">
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h6 class="mb-3">Publication Sub Kategori Form</h6>
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
                        <form method='POST' action='{{ route('backoffice.publication-sub-category.update',$pub_sub_cat->id) }}' enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Kategori*</label>
                                    <select class="form-control form-select border border-2 p-2" name="publication_category_id" id="" required>
                                        <option class="form-control" id="" disabled selected></option>
                                        @foreach ($pub_cats as $pub_cat)
                                        <option class="form-control" {{ $pub_cat->id == $pub_sub_cat->publication_category_id ? 'selected' : NULL }} value="{{ $pub_cat->id }}">{{ $pub_cat->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('publication_category_id')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Sub Kategori*</label>
                                    <input type="text" name="name" class=" form-control border border-2 p-2" placeholder="Nama Kategori Publikasi" required
                                        value='{{ old('name',$pub_cat->name) }}'>
                                    @error('name')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                            </div>
                            <button type="submit" class="btn bg-gradient-success">Submit</button>
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
