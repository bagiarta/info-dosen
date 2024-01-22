<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage='backoffice.publication-category.index'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Publication Category Master"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3"
                                style="justify-content: space-between;display: flex;">
                                <h6 class="text-white text-capitalize ps-3">Publication Category table</h6>
                                <a class="nav-link bg-info  text-white me-3 "
                                    href="{{ route('backoffice.publication-category.create') }}">
                                    <span class="nav-link-text ms-1"> + Add Publication Category</span>
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
                                                Kategori</th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pub_cats as $pub_cat)
                                            <tr>

                                                <td class="align-middle text-sm">
                                                    <p class="text-xs font-weight-bold  mb-0">{{ $pub_cat->name }}
                                                    </p>

                                                </td>
                                                <td class="align-middle">
                                                    <a href='{{ route('backoffice.publication-category.edit', $pub_cat->id) }}'
                                                        class="text-secondary font-weight-bold text-xs"
                                                        data-toggle="tooltip" data-original-title="Edit user">
                                                        Edit
                                                    </a>
                                                    <form method="POST"
                                                        action="{{ route('backoffice.publication-category.destroy', $pub_cat->id) }}">
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
