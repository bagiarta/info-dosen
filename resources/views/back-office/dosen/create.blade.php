<x-layout bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebar activePage="backoffice.dosen.index"></x-navbars.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage='Create Dosen'></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            {{-- <div class="page-header min-height-300 border-radius-xl mt-4">
                <span class="mask bg-gradient-secondary  opacity-6"></span>
            </div> --}}
            <div class="card card-body mx-3 mx-md-4 ">
                {{-- <div class="row gx-4 mb-2">
                    <div class="col-auto">
                        <div class="avatar avatar-xl position-relative">
                            <img src="{{ asset('assets') }}/img/bruce-mars.jpg" alt="profile_image"
                                class="w-100 border-radius-lg shadow-sm">
                        </div>
                    </div>
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1">
                                {{ auth()->user()->name }}
                            </h5>
                            <p class="mb-0 font-weight-normal text-sm">
                                CEO / Co-Founder
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                        <div class="nav-wrapper position-relative end-0">
                            <ul class="nav nav-pills nav-fill p-1" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link mb-0 px-0 py-1 active " data-bs-toggle="tab" href="javascript:;"
                                        role="tab" aria-selected="true">
                                        <i class="material-icons text-lg position-relative">home</i>
                                        <span class="ms-1">App</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="javascript:;"
                                        role="tab" aria-selected="false">
                                        <i class="material-icons text-lg position-relative">email</i>
                                        <span class="ms-1">Messages</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="javascript:;"
                                        role="tab" aria-selected="false">
                                        <i class="material-icons text-lg position-relative">settings</i>
                                        <span class="ms-1">Settings</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div> --}}
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h6 class="mb-3">Dosen Form</h6>
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
                        <form method='POST' action='{{ route('backoffice.dosen.store') }}' enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Photo</label>
                                    <input type="file" name="photo" class="d-block border border-2 p-1">
                                    @error('name')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Name*</label>
                                    <input type="text" name="name" class=" form-control border border-2 p-2" placeholder="Nama Lengkap dengan Gelar" required
                                        value='{{ old('name') }}'>
                                    @error('name')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">NIP*</label>
                                    <input type="text" name="nip" class=" form-control border border-2 p-2" placeholder="NIP" required
                                        value='{{ old('nip') }}'>
                                    @error('nip')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">NIDN*</label>
                                    <input type="text" name="nidn" class=" form-control border border-2 p-2" placeholder="nidn" required
                                        value='{{ old('nidn') }}'>
                                    @error('nidn')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Email address*</label>
                                    <input type="email" name="email" class="form-control border border-2 p-2" required
                                    value='{{ old('email') }}'>
                                    @error('email')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>


                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Password*</label>
                                    <input type="password" name="password" class="form-control border border-2 p-2" required
                                    value='{{ old('password') }}'>
                                    @error('password')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Agama*</label>
                                    <select class="form-control form-select border border-2 p-2" name="religion" id="" required>
                                        <option class="form-control" id="" disabled selected></option>
                                        @foreach ($religions as $religion)
                                        <option class="form-control" value="{{ $religion->id }}">{{ $religion->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('religion')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">status*</label>
                                    <input type="text" name="status" class=" form-control border border-2 p-2" placeholder="Ex : Tersertivikasi" required
                                        value='{{ old('status') }}'>
                                    @error('status')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Jenis Kontrak Kerja*</label>
                                    <input type="text" name="lecturer_status" class=" form-control border border-2 p-2" placeholder="Ex : PNS" required
                                        value='{{ old('lecturer_status') }}'>
                                    @error('lecturer_status')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Status Kontrak Kerja*</label>
                                    <input type="text" name="is_active" class=" form-control border border-2 p-2" placeholder="Ex : Aktif | Pensiun" required
                                        value='{{ old('is_active') }}'>
                                    @error('is_active')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Fakultas*</label>
                                    <input type="text" name="faculty" class=" form-control border border-2 p-2" placeholder="Ex : Fakultas Kedokteran | Fakultas Teknik" required
                                        value='{{ old('faculty') }}'>
                                    @error('faculty')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Program Studi*</label>
                                    <input type="text" name="study_program" class=" form-control border border-2 p-2" placeholder="Ex : Fakultas Kedokteran | Fakultas Teknik" required
                                        value='{{ old('study_program') }}'>
                                    @error('study_program')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Borndate*</label>
                                    <input type="date" name="birthday" class=" form-control border border-2 p-2" placeholder="Ex : Fakultas Kedokteran | Fakultas Teknik" required
                                        value='{{ old('birthday') }}'>
                                    @error('birthday')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Topic*</label>
                                    <input type="text" name="topic" class=" form-control border border-2 p-2" placeholder="Ex : Ilmu Kesehatan, Ilmu Kedokteran" required
                                        value='{{ old('topic') }}'>
                                    @error('topic')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>


                                <div class="mb-3 col-md-12">
                                    <label for="floatingTextarea2">Deskripsi Singkat Tentang Dosen</label>
                                    <textarea class="form-control border border-2 p-2" placeholder=" Say something about yourself" id="floatingTextarea2"
                                        name="description" rows="4" cols="50">{{ old('description') }}</textarea>
                                    @error('description')
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

</x-layout>
