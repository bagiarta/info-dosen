<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage='backoffice.dosen.index'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Dosen Master"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3"
                                style="justify-content: space-between;display: flex;">
                                <h6 class="text-white text-capitalize ps-3">Dosen table</h6>
                                <form action="{{ route('backoffice.dosen.index') }}" method="GET">

                                    <div class="input-group ">
                                        <div class="form-outline " data-mdb-input-init>
                                            <input type="search" id="form1" name="search" placeholder="Search"
                                                value="{{ request()->search }}" class="form-control bg-white" />
                                            <label class="form-label" for="form1"></label>
                                        </div>
                                        <button type="submit" class="btn btn-primary" data-mdb-ripple-init>
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </form>
                                @if (auth()->user()->role != 'dosen')
                                    <a class="nav-link bg-info  text-white me-3 "
                                        href="{{ route('backoffice.dosen.create') }}">
                                        <span class="nav-link-text ms-1"> + Add Dosen</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Dosen</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Fakultas</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Status Dosen</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Status</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Topic</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Borndate</th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dosens as $dosen)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div>
                                                            <img src="{{ asset($dosen->user->photo != null ? $dosen->user->photo : 'assets/img/profile.png') }}"
                                                                class="avatar avatar-sm me-3 border-radius-lg"
                                                                alt="user1">
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $dosen->user->name }}</h6>
                                                            <p class="text-xs text-secondary mb-0">
                                                                {{ $dosen->user->email }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">{{ $dosen->faculty }}</p>
                                                    <p class="text-xs text-secondary mb-0">{{ $dosen->study_program }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ $dosen->lecturer_status }}</p>
                                                    <p class="text-xs text-secondary mb-0">{{ $dosen->is_active }}</p>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <span
                                                        class="badge badge-sm bg-gradient-success">{{ $dosen->status }}</span>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <span class="text-xs font-weight-bold">{{ $dosen->topic }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $dosen->birthday }}</span>
                                                </td>
                                                <td class="align-middle">
                                                    <a href='{{ route('backoffice.dosen.edit', ['dosen' => $dosen->user->id]) }}'
                                                        class="text-secondary font-weight-bold text-xs"
                                                        data-toggle="tooltip" data-original-title="Edit user">
                                                        Edit
                                                    </a>
                                                    @if (auth()->user()->role != 'dosen')
                                                        <form method="POST"
                                                            action="{{ route('backoffice.dosen.destroy', $dosen->user->id) }}">
                                                            {{ csrf_field() }}
                                                            {{ method_field('DELETE') }}
                                                            <button
                                                                class="text-secondary border-0 font-weight-bold text-xs"
                                                                style="display: contents" type="submit">Delete</button>
                                                        </form>
                                                    @endif
                                                    {{-- <a href="#" onclick="deleteDosen('{{ csrf_token() }}','{{ route('backoffice.dosen.destroy',$dosen->user->id) }}','{{ $dosen->user->id }}','{{ route('backoffice.dosen.index') }}')"
                                                        class="text-secondary font-weight-bold text-xs"
                                                        data-toggle="tooltip" data-original-title="Edit user">
                                                        Delete
                                                    </a> --}}
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </main>
    <x-plugins></x-plugins>
    </div>
    @push('js')
        <script>
            function deleteDosen(csrf_token, route_destroy, id_dosen, route_index) {
                console.log(csrf_token, route_destroy, id_dosen, route_index)
                fetch(`${route_destroy}`, {
                        method: "DELETE",
                        headers: {
                            // 'X-CSRF-TOKEN': csrf_token
                        },
                        body: JSON.stringify({
                            '_method': 'DELETE',
                            '_token': csrf_token
                        })
                    })
                    .then(async response => console.log(response))
                    .catch(e => console.log(e))
                // .then(result => {
                //     window.location.href = route_index
                // });
            }
        </script>
        <script src="{{ asset('assets') }}/js/plugins/chartjs.min.js"></script>
    @endpush
</x-layout>
