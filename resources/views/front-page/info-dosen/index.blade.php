@extends('front-page.template')
@section('head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
@endsection
@section('body')
    <div class="container bg-white" style="margin-top: 150px;min-height: 100vh">
        <p>List Dosen</p>
        <div class="container">
            <table class="table bg-secondary align-middle mt-5 mb-0 bg-white">
                <thead class="bg-light">
                    <tr>
                        <th>Name</th>
                        <th>NIP</th>
                        <th>Status Pekerjaan</th>
                        <th>Fakultas</th>
                        <th>Topic</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset($user->photo) }}" alt="" style="width: 45px; height: 45px"
                                        class="rounded-circle" />
                                    <div class="ms-3">
                                        <p class="fw-bold mb-1">{{ $user->name }}</p>
                                        <p class="text-muted mb-0">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="text-secondary rounded-pill d-inline">{{ $user->lecturer_user->nip }}</span>
                            </td>
                            <td>
                                <p class="fw-normal mb-1">{{ $user->lecturer_user->lecturer_status }}</p>
                                <p class="text-muted mb-0">{{ $user->lecturer_user->is_active}}</p>
                            </td>
                            <td>
                                <p class="fw-normal mb-1">{{ $user->lecturer_user->faculty }}</p>
                                <p class="text-muted mb-0">{{ $user->lecturer_user->study_program}}</p>
                            </td>
                            <td>
                                <span class="text-secondary rounded-pill d-inline">{{ $user->lecturer_user->topic }}</span>
                            </td>
                            <td>
                                <a href="{{ route('info-dosen.detail',$user->encrypt_id) }}" class="btn btn-link btn-sm btn-rounded">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
@endsection
