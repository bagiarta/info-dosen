<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage='backoffice.publication.index'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Publication Master"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3"
                                style="justify-content: space-between;display: flex;">
                                <h6 class="text-white text-capitalize ps-3">publication table</h6>
                                <a class="nav-link bg-info  text-white me-3 "
                                    href="{{ route('backoffice.publication.create') }}">
                                    <span class="nav-link-text ms-1"> + Add publication</span>
                                </a>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Judul</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Author</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Kategori</th>
                                            <th
                                                class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Published in</th>
                                            <th
                                                class="text-center text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Published at</th>
                                            <th
                                                class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Owner</th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($publications as $publication)
                                            <tr>

                                                <td class="align-middle text-sm">
                                                    <p class="text-xs font-weight-bold  mb-0">{{ $publication->title }}
                                                    </p>

                                                </td>
                                                <td class="align-middle text-sm">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $publication->author }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ $publication->publication_category->name }}</p>
                                                    <p class="text-xs text-secondary mb-0">
                                                        {{ $publication->publication_sub_category->name }}
                                                    </p>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <a href="{{ $publication->url }}" target="_blank"
                                                        class="text-xs font-weight-bold">{{ $publication->published_in }}</a>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <span
                                                        class="text-xs font-weight-bold">{{ date('d-M-Y', strtotime($publication->published_at)) }}</span>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $publication->user->name }}
                                                    </p>
                                                </td>
                                                <td class="align-middle">
                                                    <a href='{{ route('backoffice.publication.edit', ['publication' => $publication->id]) }}'
                                                        class="text-secondary font-weight-bold text-xs"
                                                        data-toggle="tooltip" data-original-title="Edit user">
                                                        Edit
                                                    </a>
                                                    <form method="POST"
                                                        action="{{ route('backoffice.publication.destroy', $publication->id) }}">
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}
                                                        <button class="text-secondary border-0 font-weight-bold text-xs"
                                                            style="display: contents" type="submit">Delete</button>
                                                    </form>
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
        <script src="{{ asset('assets') }}/js/plugins/chartjs.min.js"></script>
    @endpush
</x-layout>
