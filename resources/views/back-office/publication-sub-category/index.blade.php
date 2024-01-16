<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage='backoffice.publication-sub-category.index'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Publication Sub Category Master"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3"
                                style="justify-content: space-between;display: flex;">
                                <h6 class="text-white text-capitalize ps-3">Publication Sub Category table</h6>
                                <a class="nav-link bg-success  text-white me-3 "
                                    href="{{ route('backoffice.publication-sub-category.create') }}">
                                    <span class="nav-link-text ms-1">Add Publication Sub Category</span>
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
                                            <th
                                                class="text-uppercase  text-secondary text-xxs font-weight-bolder opacity-7">
                                                Sub Category</th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pub_sub_cats as $pub_sub_cat)
                                            <tr>

                                                <td class=" text-sm">
                                                    <p class="text-xs font-weight-bold  mb-0">{{ $pub_sub_cat->publication_category->name }}
                                                    </p>

                                                </td>
                                                <td class=" text-sm">
                                                    <p class="text-xs font-weight-bold  mb-0">{{ $pub_sub_cat->name }}
                                                    </p>

                                                </td>
                                                <td class="align-middle">
                                                    <a href='{{ route('backoffice.publication-sub-category.edit', $pub_sub_cat->id) }}'
                                                        class="text-secondary font-weight-bold text-xs"
                                                        data-toggle="tooltip" data-original-title="Edit user">
                                                        Edit
                                                    </a>
                                                    <form method="POST"
                                                        action="{{ route('backoffice.publication-sub-category.destroy', $pub_sub_cat->id) }}">
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}
                                                        <button class="text-secondary border-0 font-weight-bold text-xs"
                                                            style="display: contents" type="submit">Delete</button>
                                                    </form>
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
