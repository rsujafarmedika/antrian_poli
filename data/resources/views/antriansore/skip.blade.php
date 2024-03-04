<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Data Antrian Akupuntur Sore Dilewati</title>
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
        <div class="row">
            <div class="col">
                <div class="card footer text-dark mt-2">
                    <div class="row">
                        <div class="col-md-10">
                            <h4 class="card-title text-center">Data Antrian Akupuntur Pagi Dilewati</h4>
                        </div>
                        <div class="col-md-2 text-center">
                            <a href="{{ route('antrian') }}" class="btn btn-sm btn-success">Antrian</a>
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
                            <table class="table table-bordered">
                                <thead style="background-color: #229258" class="text-white text-center">
                                    <tr style="width: 100%">
                                        <th scope="col" style="width: 4%">No</th>
                                        <th scope="col" style="width: 10%">REG</th>
                                        <th scope="col" style="width: 40%">Nama Pasien</th>
                                        <th scope="col" style="width: 26%">Pilih BED</th>
                                        <th scope="col" style="width: 20%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($get_skip as $no => $skip)
                                        <tr>
                                            <td class="text-center">{{ $no + 1 }}</td>
                                            <td class="text-center">
                                                {{ $skip->no_reg }}
                                            </td>
                                            <td>{{ $skip->nm_pasien }}</td>
                                            <td>
                                                <select id="mySelect" onchange="updateInput()" class="form-select" aria-label="Default select example">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">konsultasi</option>
                                                </select>
                                            </td>
                                            <td class="text-center">
                                                {{-- <input type="text" id="inputText1" value="pasien nomer antrian {{ intval($skip->no_reg) }}, {{ strtolower($skip->nm_pasien) }}, silahkan ke ruang 1" style="display: none"> --}}
                                                <input type="text" id="noreg" value="{{ intval($skip->no_reg) }}" style="display: none">
                                                <input type="text" id="namapasien" value="{{ strtolower($skip->nm_pasien) }}" style="display: none">
                                                <input type="text" id="inputField" style="display: none">
                                                <button onclick="speak()" class="btn btn-sm btn-primary">Panggil</button>
                                                <form action="{{ route('p_selesai') }}" method="post">
                                                    {{ csrf_field() }}
                                                    <input type="text" name="no_reg" style="display: none"
                                                        value="{{ $skip->no_reg }}">
                                                    <input type="text" name="no_rawat" style="display: none"
                                                        value="{{ $skip->no_rawat }}">
                                                    <input type="text" name="no_rkm_medis" style="display: none"
                                                        value="{{ $skip->no_rkm_medis }}">
                                                    <input type="text" name="nm_pasien" style="display: none"
                                                        value="{{ $skip->nm_pasien }}">
                                                    <input type="text" name="bed" style="display: none"
                                                        value="6">
                                                    <button type="submit"
                                                        class="btn btn-sm btn-warning text-white">Selesai</button>
                                                </form>
                                                {{-- <a href="{{ route('next1') }}" class="btn btn-sm btn-warning text-white" id="playButton">Selesai</a> --}}
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

    {{-- Alert --}}
    <script>
        setTimeout(function() {
            document.getElementById('alert').style.display = 'none';
        }, 5000);
    </script>

    <script>
        function updateInput() {
            var selectElement = document.getElementById("mySelect");
            var noreg = document.getElementById("noreg").value;
            var namapasien = document.getElementById("namapasien").value;
            var inputField = document.getElementById("inputField");
            var selectedOption = selectElement.options[selectElement.selectedIndex].text;
            inputField.value = "pasien nomer antrian " + noreg + "," + namapasien + ", silahkan ke ruang " + selectedOption;
        }

        function speak() {
            var text = document.getElementById("inputField").value;
            var utterance = new SpeechSynthesisUtterance();
            utterance.lang = "id-ID";
            utterance.text = text;
            speechSynthesis.speak(utterance);
        }
    </script>

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
