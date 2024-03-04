<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Admin Antrian Poliklinik Syaraf</title>
    <meta http-equiv="refresh" content="30">
    <link rel="stylesheet" href="public/css/style.css">
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
        {{-- <div class="row" style="display: none">
            <audio id="audioPlayer" controls>
                <source id="audioSource" src="public/audio/bel.mp3" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>
        </div> --}}
        <div class="row">
            <div class="col">
                <div class="card footer text-dark mt-2">
                    <div class="row">
                        <div class="col-md-2 text-center">
                        </div>
                        <div class="col-md-8">
                            <h4 class="card-title text-center">Admin Antrian Poliklinik Syaraf</h4>
                        </div>
                        <div class="col-md-2 text-center">
                            <a href="" class="btn btn-sm btn-success">Pasien Dilewati</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card content text-dark mt-3">
                    <div class="row">
                        <div class="col-md-12">
                            @if (session('kosong'))
                                <div id="alert" class="alert alert-danger" role="alert">
                                    {{ session('kosong') }}
                                </div>
                            @endif
                            @if (session('habis'))
                                <div id="alert" class="alert alert-success" role="alert">
                                    {{ session('habis') }}
                                </div>
                            @endif
                            <table class="table table-bordered">
                                <thead style="background-color: #229258" class="text-white text-center">
                                    <tr style="width: 100%">
                                        <th scope="col" style="width: 4%">REG</th>
                                        <th scope="col" style="width: 10%">RM</th>
                                        <th scope="col" style="width: 15%">No Rawat</th>
                                        <th scope="col" style="width: 40%">Nama Pasien</th>
                                        <th scope="col" style="width: 11%">STATUS</th>
                                        <th scope="col" style="width: 20%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($syaraf as $no => $data)
                                        <tr>
                                            <td class="text-center">{{ $data['no_reg'] }}</td>
                                            <td class="text-center">{{ $data['no_rkm_medis'] }}</td>
                                            <td class="text-center">{{ $data['no_rawat'] }}</td>
                                            <td>{{ $data['nm_pasien'] }}</td>
                                            <td class="text-center">
                                                @if ($data['stts'] = 'Sudah')
                                                    <span class="badge text-white"
                                                        style="background-color: #229258">{{ $data['stts'] }}</span>
                                                @else
                                                    <span class="badge text-white"
                                                        style="background-color: #FF0000">{{ $data['stts'] }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <ul>
                                                    <li>
                                                        <input type="text" id="inputText1" value="pasien nomer antrian , silahkan ke poli gigi" style="display: none">
                                                        {{-- <input type="text" id="inputText1" value="pasien nomer antrian {{ intval($bed1->no_reg) }}, {{ strtolower($bed1->nm_pasien) }}, silahkan ke ruang 1" style="display: none"> --}}
                                                        <button onclick="speak1()" class="btn btn-sm btn-primary">PANGGIL</button>
                                                    </li>
                                                    <li>
                                                        <a href="" class="btn btn-sm btn-warning text-white" id="playButton">SELESAI</a>
                                                        {{-- <a href="{{ route('nexts1') }}" class="btn btn-sm btn-warning text-white" id="playButton">SELANJUTNYA</a> --}}
                                                    </li>
                                                    <li>
                                                        <a href="" class="btn btn-sm btn-danger">LEWATI</a>
                                                        {{-- <a href="{{ route('skips1') }}" class="btn btn-sm btn-danger">LEWATI</a> --}}
                                                    </li>
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
    </div>

    {{-- Auto Reload --}}
    <script>
        window.setTimeout(function() {
            window.location.reload();
        }, 300000);
    </script>
    {{-- Auto Reload --}}

    <script>
        function speak1() {
            var text = document.getElementById("inputText1").value;
            var utterance = new SpeechSynthesisUtterance();
            utterance.lang = "id-ID"; // Bahasa Indonesia
            utterance.text = text;
            speechSynthesis.speak(utterance);
        }

        function speak2() {
            var text = document.getElementById("inputText2").value;
            var utterance = new SpeechSynthesisUtterance();
            utterance.lang = "id-ID"; // Bahasa Indonesia
            utterance.text = text;
            speechSynthesis.speak(utterance);
        }

        function speak3() {
            var text = document.getElementById("inputText3").value;
            var utterance = new SpeechSynthesisUtterance();
            utterance.lang = "id-ID"; // Bahasa Indonesia
            utterance.text = text;
            speechSynthesis.speak(utterance);
        }

        function speak4() {
            var text = document.getElementById("inputText4").value;
            var utterance = new SpeechSynthesisUtterance();
            utterance.lang = "id-ID"; // Bahasa Indonesia
            utterance.text = text;
            speechSynthesis.speak(utterance);
        }

        function speak5() {
            var text = document.getElementById("inputText5").value;
            var utterance = new SpeechSynthesisUtterance();
            utterance.lang = "id-ID"; // Bahasa Indonesia
            utterance.text = text;
            speechSynthesis.speak(utterance);
        }
    </script>

    {{-- <script src="public/js/script.js"></script>
    <script src="public/js/script2.js"></script> --}}

    <script>
        const playButton = document.getElementById('playButton');
        const audioPlayer = document.getElementById('audioPlayer');

        playButton.addEventListener('click', function() {
            audioPlayer.play();
        });
    </script>

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

    {{-- Alert --}}
    <script>
        setTimeout(function() {
            document.getElementById('alert').style.display = 'none';
        }, 5000);
    </script>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script>
        const myModal = document.getElementById('myModal')
        const myInput = document.getElementById('myInput')

        myModal.addEventListener('shown.bs.modal', () => {
            myInput.focus()
        })
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
