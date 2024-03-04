<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Display Antrian Akupuntur</title>
    <link rel="stylesheet" href="public/css/style.css">

    {{-- <script>
        window.onload = function() {
            // Fungsi untuk melakukan refresh div secara periodik
            function autoRefreshDiv() {
                // Gunakan XMLHttpRequest untuk memuat konten baru dari server
                var xhr = new XMLHttpRequest();
                xhr.open('GET', 'display/index',
                true); // Ganti '/path/to/your/endpoint' dengan URL endpoint Anda
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // Jika permintaan berhasil, perbarui konten di dalam div
                            document.getElementById('autorefresh').innerHTML = xhr.responseText;
                        } else {
                            // Jika ada kesalahan, tampilkan pesan kesalahan
                            console.error('Error:', xhr.status);
                        }
                    }
                };
                xhr.send();
            }

            // Panggil fungsi autoRefreshDiv() setiap beberapa detik
            setInterval(autoRefreshDiv, 5000); // Refresh setiap 5 detik (5000 milidetik)
        };
    </script> --}}
    {{-- <meta http-equiv="refresh" content="30"> --}}
</head>

<body>
    <div class="container container-fluid">
        <div class="row">
            <div class="col">
                <div class="card header text-dark mt-2">
                    <div class="row">
                        <div class="col-md-2 header-images">
                            <img src="public/images/logo.jpg" alt="" srcset="" width="80vh">
                        </div>
                        <div class="col-md-8 text-center">
                            <b>RSU JAFAR MEDIKA</b><br>
                            <b>MUNGGUR RT 09 RW 04 KEC. MOJOGEDANG , KARANGANYAR, JAWA TENGAH</b> <br>
                            <b>Antrian Poli AKUPUNKTUR, Dokter dr. Yuni Ratna Dewi</b> <br>
                            <b>{{ date('d M Y') }}</b>
                        </div>
                        <div class="col-md-2 header-images">
                            <img src="public/images/paripurna.png" alt="" srcset="" width="170vh">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card content text-dark mt-3">
                    <div class="row">
                        <div class="col-md-7">
                            <div http-equiv="refresh" content="30">
                                @if (date('H')<15)
                                    <h5 class="card-title text-center">Pasien Akupuntur Pagi</h5>
                                @else
                                    <h5 class="card-title text-center">Pasien Akupuntur Sore</h5>
                                @endif
                                <table class="table table-bordered">
                                    <thead style="background-color: #229258" class="text-white text-center">
                                        <tr style="width: 100%">
                                            <th scope="col" style="width: 3%">No</th>
                                            <th scope="col" style="width: 15%">RM</th>
                                            <th scope="col" style="width: 40%">Nama Pasien</th>
                                            <th scope="col" style="width: 30%">Dokter</th>
                                            <th scope="col" style="width: 12%">No REG</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="content1 scrollable-container" style="max-height: 500px; overflow-y: auto;"
                                id="scrollableContainer">
                                <table class="table table-bordered">

                                    <tbody>
                                        @foreach ($reg as $no => $data)
                                            <tr style="width: 100%">
                                                <th scope="row" class="text-center" style="width: 5%">
                                                    {{ $no + 1 }}</th>
                                                <td class="text-center" style="width: 15%">{{ $data->no_rkm_medis }}
                                                </td>
                                                <td style="width: 40%">{{ $data->nm_pasien }}</td>
                                                <td class="text-center" style="width: 30%">{{ $data->nm_dokter }}</td>
                                                <td class="text-center" style="width: 10%">{{ $data->no_reg }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{-- <div class="col-md-1 content2">
                        </div> --}}
                        <div class="col-md-5 content3" id="autorefresh">
                            <div class="row content31 border">
                                <div class="col mb-3">
                                    <h4 class="card-title text-center">Antrian Poliklinik Akupuntur</h4>
                                </div>
                            </div>
                            <div class="row content31 border">
                                <div class="col-md-8 content311">
                                    <div class="row c_antrian1">
                                        <div class="col text-center">
                                            <b>BED 1</b>
                                        </div>
                                    </div>
                                    <div class="row c_antrian2">
                                        <div class="col">
                                            @if ($bed1 == null)
                                                <h4 class="text-center"></h4>
                                            @else
                                                <h4 class="text-center">{{ $bed1['nm_pasien'] }}</h4>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row c_antrian3">
                                        <div class="col">
                                            @if ($bed1 == null)
                                                <b>RM : </b>
                                            @else
                                                <b>RM : {{ $bed1['no_rkm_medis'] }}</b>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 content312">
                                    @if ($bed1 == null)
                                    @else
                                        {{ $bed1['no_reg'] }}
                                    @endif
                                </div>
                            </div>
                            <div class="row content31 border mt-1">
                                <div class="col-md-8 content311">
                                    <div class="row c_antrian1">
                                        <div class="col text-center">
                                            <b>BED 2</b>
                                        </div>
                                    </div>
                                    <div class="row c_antrian2">
                                        <div class="col">
                                            @if ($bed2 == null)
                                                <h4 class="text-center"></h4>
                                            @else
                                                <h4 class="text-center">{{ $bed2['nm_pasien'] }}</h4>
                                            @endif
                                            {{-- @if ($c_bed2 != 0)
                                                <h4 class="text-center">{{ $bed2['nm_pasien'] }}</h4>
                                            @else
                                                <h4 class="text-center"></h4>
                                            @endif --}}
                                        </div>
                                    </div>
                                    <div class="row c_antrian3">
                                        <div class="col">
                                            @if ($bed2 == null)
                                                <b>RM : </b>
                                            @else
                                                <b>RM : {{ $bed2['no_rkm_medis'] }}</b>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 content312">
                                    @if ($bed2 == null)
                                    @else
                                        {{ $bed2['no_reg'] }}
                                    @endif
                                </div>
                            </div>
                            <div class="row content31 border mt-1">
                                <div class="col-md-8 content311">
                                    <div class="row c_antrian1">
                                        <div class="col text-center">
                                            <b>BED 3</b>
                                        </div>
                                    </div>
                                    <div class="row c_antrian2">
                                        <div class="col">
                                            @if ($bed3 == null)
                                                <h4 class="text-center"></h4>
                                            @else
                                                <h4 class="text-center">{{ $bed3['nm_pasien'] }}</h4>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row c_antrian3">
                                        <div class="col">
                                            @if ($bed3 == null)
                                                <b>RM : </b>
                                            @else
                                                <b>RM : {{ $bed3['no_rkm_medis'] }}</b>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 content312">
                                    @if ($bed3 == null)
                                    @else
                                        {{ $bed3['no_reg'] }}
                                    @endif
                                </div>
                            </div>
                            <div class="row content31 border mt-1">
                                <div class="col-md-8 content311">
                                    <div class="row c_antrian1">
                                        <div class="col text-center">
                                            <b>BED 4</b>
                                        </div>
                                    </div>
                                    <div class="row c_antrian2">
                                        <div class="col">
                                            @if ($bed4 == null)
                                                <h4 class="text-center"></h4>
                                            @else
                                                <h4 class="text-center">{{ $bed4['nm_pasien'] }}</h4>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row c_antrian3">
                                        <div class="col">
                                            @if ($bed4 == null)
                                                <b>RM : </b>
                                            @else
                                                <b>RM : {{ $bed4['no_rkm_medis'] }}</b>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 content312">
                                    @if ($bed4 == null)
                                    @else
                                        {{ $bed4['no_reg'] }}
                                    @endif
                                </div>
                            </div>
                            <div class="row content31 border mt-1">
                                <div class="col-md-8 content311">
                                    <div class="row c_antrian1">
                                        <div class="col text-center">
                                            <b>BED 5</b>
                                        </div>
                                    </div>
                                    <div class="row c_antrian2">
                                        <div class="col">
                                            @if ($bed5 == null)
                                            @else
                                                <h4 class="text-center">{{ $bed5['nm_pasien'] }}</h4>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row c_antrian3">
                                        <div class="col">
                                            @if ($bed5 == null)
                                                <b>RM : </b>
                                            @else
                                                <b>RM : {{ $bed5['no_rkm_medis'] }}</b>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 content312">
                                    @if ($bed5 == null)
                                    @else
                                        {{ $bed5['no_reg'] }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card footer text-dark mt-3">
                    <div class="row">
                        <h6 class="card-title text-center">RSU Ja'far Medika Karanganyar</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Auto Scroll --}}
    <script>
        // Get the scrollable container element
        var scrollableContainer = document.getElementById('scrollableContainer');

        // Set the interval for auto-scrolling (e.g., every 2 seconds)
        setInterval(function() {
            // Calculate the new scroll position (scroll down by 1 pixel)
            var newScrollTop = scrollableContainer.scrollTop + 1;

            // Set the new scroll position
            scrollableContainer.scrollTop = newScrollTop;

            // Check if the scroll has reached the bottom, then reset to the top
            if (newScrollTop >= scrollableContainer.scrollHeight - scrollableContainer.clientHeight) {
                scrollableContainer.scrollTop = 0;
            }
        }, 50); // Adjust the interval as needed
    </script>
    {{-- Auto Scrooll --}}


    {{-- Auto Reload --}}
    <script>
        window.setTimeout( function() {
            window.location.reload();
        }, 20000);
    </script>    
    {{-- Auto Reload --}}

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    -->
</body>

</html>
