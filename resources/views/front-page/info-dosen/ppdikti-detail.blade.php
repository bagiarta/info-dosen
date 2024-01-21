@extends('front-page.template')
@section('head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <meta name="theme-color" content="#000000">
    <meta name="keywords"
        content="PDDikti, Pangkalan Data Pendidikan Tinggi, Forlap, Ristek Dikti, Mahasiswa, Perguruan, Tinggi">
    <meta name="description"
        content="PDDikti adalah Pangkalan Data Pendidikan Tinggi, Dimana semua informasi dan statistik tentang perguruan tinggi di indonesia di sajikan secara real time dan akurat.">
    <link rel="manifest" href="/manifest.json">
    <link rel="icon" href="https://pddikti.kemdikbud.go.id/asset/gambar/faviconpddikti.png">
    <link
        href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="https://pddikti.kemdikbud.go.id/asset/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://pddikti.kemdikbud.go.id/asset/css/elements.css" rel="stylesheet">
    <link href="https://pddikti.kemdikbud.go.id/asset/css/easy-autocomplete.css" rel="stylesheet">
    <link href="https://pddikti.kemdikbud.go.id/style.css" rel="stylesheet">
    <link href="https://pddikti.kemdikbud.go.id/responsive.css" rel="stylesheet">
    <link href="https://pddikti.kemdikbud.go.id/leaflet.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script type="text/javascript" async="" src="https://www.google-analytics.com/analytics.js"></script>
    <script type="text/javascript" async=""
        src="https://www.googletagmanager.com/gtag/js?id=G-6NXX5DTK0E&amp;l=dataLayer&amp;cx=c"></script>
    <script src="/asset/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    <title>PDDikti - Pangkalan Data Pendidikan Tinggi</title>
    <link href="https://pddikti.kemdikbud.go.id/static/css/1.dd6d9387.chunk.css" rel="stylesheet">
    <link href="https://pddikti.kemdikbud.go.id/static/css/main.5283edf9.chunk.css" rel="stylesheet">
    <style data-emotion=""></style>
@endsection
@section('body')
    <div id="root" style="margin-top:10pxpx">
        <div>
            <main>
                <div>

                    <section class="testimonial-area ">
                        <div class="container pt-5">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="single-blog-box">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr class="info">
                                                    <td align="left" colspan="4"> <b> Biodata Dosen </b> </td>
                                                </tr>
                                                <tr>
                                                    <td width="20%" rowspan="10" style="padding-left: 4%;"> <img
                                                            class="img-responsive" src="data:image/png;base64,{{ $ppdikti_detail['dataumum']['foto'] }}">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="right">Nama </td>
                                                    <td>:</td>
                                                    <td align="left">{{ $ppdikti_detail['dataumum']['nm_sdm'] }}</td>
                                                </tr>
                                                {{-- <tr>
                                                    <td align="right">Perguruan Tinggi</td>
                                                    <td>:</td>
                                                    <td align="left"><a
                                                            href="/data_pt/RUMwMjlDMTItMjIzRC00OTA2LTlGMTQtNjQ4MDZDNjY0Q0NB">Institut
                                                            Teknologi dan Pendidikan Markandeya Bali</a></td>
                                                </tr> --}}
                                                <tr>
                                                    <td align="right">Program Studi</td>
                                                    <td>:</td>
                                                    <td align="left"><a
                                                            href="#">
                                                            {{ $ppdikti_detail['dataumum']['namaprodi'] }}
                                                        </a></td>
                                                </tr>
                                                <tr>
                                                    <td align="right">Jenis Kelamin</td>
                                                    <td>:</td>
                                                    <td align="left">{{ $ppdikti_detail['dataumum']['jk'] == 'L' ? 'Laki Laki' : 'Perempuan' }}</td>
                                                </tr>
                                                <tr>
                                                    <td align="right">Jabatan Fungsional</td>
                                                    <td>:</td>
                                                    <td align="left"> {{ $ppdikti_detail['dataumum']['fungsional']  }}</td>
                                                </tr>
                                                <tr>
                                                    <td align="right">Pendidikan Tertinggi</td>
                                                    <td>:</td>
                                                    <td align="left">{{ $ppdikti_detail['dataumum']['pend_tinggi'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td align="right">Status Ikatan Kerja</td>
                                                    <td>:</td>
                                                    <td align="left">{{ $ppdikti_detail['dataumum']['ikatankerja'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td align="right">Status Aktivitas</td>
                                                    <td>:</td>
                                                    <td align="left">{{ $ppdikti_detail['dataumum']['statuskeaktifan'] }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="single-blog-box">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a data-toggle="pill" href="#home">Riwayat
                                                    Pendidikan</a></li>
                                            <li class=""><a data-toggle="pill" href="#menu1">Riwayat
                                                    Mengajar</a></li>
                                        </ul>
                                        <div style="padding-top: 2%;"></div>
                                        <div class="tab-content">
                                            <div id="home" class="tab-pane fade active in">
                                                <h3>Riwayat Pendidikan</h3>
                                                <div class="tabelFlow">
                                                    <table id="t01" class="table table-bordered table-responsive">
                                                        <thead>
                                                            <tr>
                                                                <th width="5%">No.</th>
                                                                <th align="left"><a href="#sortpt"
                                                                        class="sort-by">Perguruan Tinggi</a></th>
                                                                <th align="left"><a href="#sortgelar"
                                                                        class="sort-by">Gelar Akademik</a></th>
                                                                <th align="left"><a href="#sorttglijazah"
                                                                        class="sort-by">Tanggal Ijazah</a></th>
                                                                <th align="left"><a href="#sortjenjang"
                                                                        class="sort-by">Jenjang</a></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($ppdikti_detail['datapendidikan'] as $key => $pendidikan)
                                                            <tr>
                                                                <td align="center">{{ $key+1 }}</td>
                                                                <td align="left">{{ $pendidikan['nm_sp_formal'] }}</td>
                                                                <td align="left">{{ $pendidikan['singkat_gelar'] }}</td>
                                                                <td align="left">{{ $pendidikan['thn_lulus'] }}</td>
                                                                <td align="left">{{ $pendidikan['namajenjang'] }}</td>
                                                            </tr>
                                                            <tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div id="menu1" class="tab-pane fade ">
                                                <h3>Riwayat Mengajar</h3>
                                                <div class="tabelFlow">
                                                    <table id="t01" class="table table-bordered table-responsive">
                                                        <thead>
                                                            <tr>
                                                                <th width="5%">No.</th>
                                                                <th align="left"><a href="#sortsmt"
                                                                        class="sort-by">Semester</a></th>
                                                                <th align="left"><a href="#sortkmatkul"
                                                                        class="sort-by">Kode Mata Kuliah</a></th>
                                                                <th align="left"><a href="#sortmatkul"
                                                                        class="sort-by">Nama Mata Kuliah</a></th>
                                                                <th align="left"><a href="#sortkelas"
                                                                        class="sort-by">Kode Kelas</a></th>
                                                                <th align="left"><a href="#sortpt"
                                                                        class="sort-by">Perguruan Tinggi</a></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($ppdikti_detail['datamengajar'] as $key => $mengajar)

                                                            <tr>
                                                                <td align="center">{{ $key+1 }}</td>
                                                                <td align="left">{{ substr($mengajar['id_smt'], 4, 1) == 1 ? 'Ganjil' : 'Genap' }} {{ substr($mengajar['id_smt'], 0, 4) }}</td>
                                                                <td align="left">{{ $mengajar['kode_mk'] }}</td>
                                                                <td align="left">{{ $mengajar['nm_mk'] }}</td>
                                                                <td align="left">{{ $mengajar['nm_kls'] }}</td>
                                                                <td align="left"><a
                                                                        href="#">Institut
                                                                        Teknologi dan Pendidikan Markandeya Bali</a>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div id="menu2" class="tab-pane fade">
                                                <h3>Penelitian</h3>
                                                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                                                    accusantium doloremque laudantium, totam rem aperiam.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </main>

        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="https://pddikti.kemdikbud.go.id//asset/js/jquery.min.js"></script>
    <script src="https://pddikti.kemdikbud.go.id//asset/js/jquery.easy-autocomplete.js"></script>
    <script src="https://pddikti.kemdikbud.go.id//asset/js/bootstrap.min.js"></script>
    <script src="https://pddikti.kemdikbud.go.id//asset/js/plugins.js"></script>
    <script src="https://pddikti.kemdikbud.go.id//asset/js/main.js"></script>
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-68662576-2"></script>

    <script src="https://pddikti.kemdikbud.go.id//static/js/1.ccbd096a.chunk.js"></script>
    <script src="https://pddikti.kemdikbud.go.id//static/js/main.5e369273.chunk.js"></script>
@endsection
