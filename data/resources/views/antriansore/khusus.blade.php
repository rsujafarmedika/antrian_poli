<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Data Antrian Pasien Khusus Sore</title>
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
                            <h4 class="card-title text-center">Data Antrian Pasien Khusus Sore</h4>
                        </div>
                        <div class="col-md-2 text-center">
                            <a href="{{ route('antriansore') }}" class="btn btn-sm btn-success">Kembali</a>
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
                                        <th scope="col" style="width: 10%"></th>
                                        <th scope="col" style="width: 60%">Pasien Dilewati</th>
                                        <th scope="col" style="width: 30%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th style="background-color: #229258" class="text-white text-center">BED 1
                                        </th>
                                        <td>
                                            <form action="{{ route('p_selesai') }}" method="post">
                                                {{ csrf_field() }}
                                            <select name="no_rawat" id="mySelect" onchange="updateInput()" class="form-select"
                                                aria-label="Default select example">
                                                <option value="">Pilih Nama Pasien</option>
                                                @foreach ($get_khusus as $skip)
                                                    <option value="{{ $skip->no_rawat }}">{{ intval($skip->no_reg) }} -- [
                                                        {{ strtolower($skip->nm_pasien) }} ]</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="text-center">
                                            <ul>
                                                <li>
                                                        {{-- <input type="text" id="noReg" name="no_reg" value="">
                                                        <input type="text" name="no_rawat" style="display: none"
                                                            value="{{ $skip->no_rawat }}">
                                                        <input type="text" name="no_rkm_medis" style="display: none"
                                                            value="{{ $skip->no_rkm_medis }}">
                                                        <input type="text" name="nm_pasien" style="display: none"
                                                            value="{{ $skip->nm_pasien }}">
                                                        <input type="text" name="bed" style="display: none"
                                                            value="6"> --}}
                                                        <button type="submit"
                                                            class="btn btn-sm btn-warning text-white">Selesai</button>
                                                    </form>
                                                </li>
                                                <li>
                                                    {{-- <input type="text" id="noreg"
                                                        value="{{ intval($skip->no_reg) }}" style="display: none">
                                                    <input type="text" id="namapasien"
                                                        value="{{ strtolower($skip->nm_pasien) }}"
                                                        style="display: none"> --}}
                                                    <input type="text" id="inputField" style="display: none">
                                                    <button onclick="speak()"
                                                        class="btn btn-sm btn-primary">Panggil</button>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="background-color: #229258" class="text-white text-center">BED 2
                                        </th>
                                        <td>
                                            <form action="{{ route('p_selesai') }}" method="post">
                                                {{ csrf_field() }}
                                            <select name="no_rawat" id="mySelect2" onchange="updateInput2()" class="form-select"
                                                aria-label="Default select example">
                                                <option value="">Pilih Nama Pasien</option>
                                                @foreach ($get_khusus as $skip)
                                                    <option value="{{ $skip->no_rawat }}">{{ intval($skip->no_reg) }} -- [
                                                        {{ strtolower($skip->nm_pasien) }} ]</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="text-center">
                                            <ul>
                                                <li>
                                                        <button type="submit"
                                                            class="btn btn-sm btn-warning text-white">Selesai</button>
                                                    </form>
                                                </li>
                                                <li>
                                                    {{-- <input type="text" id="noreg"
                                                        value="{{ intval($skip->no_reg) }}" style="display: none">
                                                    <input type="text" id="namapasien"
                                                        value="{{ strtolower($skip->nm_pasien) }}"
                                                        style="display: none"> --}}
                                                    <input type="text" id="inputField2" style="display: none">
                                                    <button onclick="speak2()"
                                                        class="btn btn-sm btn-primary">Panggil</button>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="background-color: #229258" class="text-white text-center">BED 3
                                        </th>
                                        <td>
                                            <form action="{{ route('p_selesai') }}" method="post">
                                                {{ csrf_field() }}
                                            <select name="no_rawat" id="mySelect3" onchange="updateInput3()" class="form-select"
                                                aria-label="Default select example">
                                                <option value="">Pilih Nama Pasien</option>
                                                @foreach ($get_khusus as $skip)
                                                    <option value="{{ $skip->no_rawat }}">{{ intval($skip->no_reg) }} -- [
                                                        {{ strtolower($skip->nm_pasien) }} ]</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="text-center">
                                            <ul>
                                                <li>
                                                        <button type="submit"
                                                            class="btn btn-sm btn-warning text-white">Selesai</button>
                                                    </form>
                                                </li>
                                                <li>
                                                    {{-- <input type="text" id="noreg"
                                                        value="{{ intval($skip->no_reg) }}" style="display: none">
                                                    <input type="text" id="namapasien"
                                                        value="{{ strtolower($skip->nm_pasien) }}"
                                                        style="display: none"> --}}
                                                    <input type="text" id="inputField3" style="display: none">
                                                    <button onclick="speak3()"
                                                        class="btn btn-sm btn-primary">Panggil</button>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="background-color: #229258" class="text-white text-center">BED 4
                                        </th>
                                        <td>
                                            <form action="{{ route('p_selesai') }}" method="post">
                                                {{ csrf_field() }}
                                            <select name="no_rawat" id="mySelect4" onchange="updateInput4()" class="form-select"
                                                aria-label="Default select example">
                                                <option value="">Pilih Nama Pasien</option>
                                                @foreach ($get_khusus as $skip)
                                                    <option value="{{ $skip->no_rawat }}">{{ intval($skip->no_reg) }} -- [
                                                        {{ strtolower($skip->nm_pasien) }} ]</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="text-center">
                                            <ul>
                                                <li>
                                                        <button type="submit"
                                                            class="btn btn-sm btn-warning text-white">Selesai</button>
                                                    </form>
                                                </li>
                                                <li>
                                                    {{-- <input type="text" id="noreg"
                                                        value="{{ intval($skip->no_reg) }}" style="display: none">
                                                    <input type="text" id="namapasien"
                                                        value="{{ strtolower($skip->nm_pasien) }}"
                                                        style="display: none"> --}}
                                                    <input type="text" id="inputField4" style="display: none">
                                                    <button onclick="speak4()"
                                                        class="btn btn-sm btn-primary">Panggil</button>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="background-color: #229258" class="text-white text-center">BED 5
                                        </th>
                                        <td>
                                            <form action="{{ route('p_selesai') }}" method="post">
                                                {{ csrf_field() }}
                                            <select name="no_rawat" id="mySelect5" onchange="updateInput5()" class="form-select"
                                                aria-label="Default select example">
                                                <option value="">Pilih Nama Pasien</option>
                                                @foreach ($get_khusus as $skip)
                                                    <option value="{{ $skip->no_rawat }}">{{ intval($skip->no_reg) }} -- [
                                                        {{ strtolower($skip->nm_pasien) }} ]</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="text-center">
                                            <ul>
                                                <li>
                                                        <button type="submit"
                                                            class="btn btn-sm btn-warning text-white">Selesai</button>
                                                    </form>
                                                </li>
                                                <li>
                                                    {{-- <input type="text" id="noreg"
                                                        value="{{ intval($skip->no_reg) }}" style="display: none">
                                                    <input type="text" id="namapasien"
                                                        value="{{ strtolower($skip->nm_pasien) }}"
                                                        style="display: none"> --}}
                                                    <input type="text" id="inputField5" style="display: none">
                                                    <button onclick="speak5()"
                                                        class="btn btn-sm btn-primary">Panggil</button>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="background-color: #229258" class="text-white text-center">Konsultasi
                                        </th>
                                        <td>
                                            <form action="{{ route('p_selesai') }}" method="post">
                                                {{ csrf_field() }}
                                            <select name="no_rawat" id="mySelect6" onchange="updateInput6()" class="form-select"
                                                aria-label="Default select example">
                                                <option value="">Pilih Nama Pasien</option>
                                                @foreach ($get_khusus as $skip)
                                                    <option value="{{ $skip->no_rawat }}">{{ intval($skip->no_reg) }} -- [
                                                        {{ strtolower($skip->nm_pasien) }} ]</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="text-center">
                                            <ul>
                                                <li>
                                                        <button type="submit"
                                                            class="btn btn-sm btn-warning text-white">Selesai</button>
                                                    </form>
                                                </li>
                                                <li>
                                                    {{-- <input type="text" id="noreg"
                                                        value="{{ intval($skip->no_reg) }}" style="display: none">
                                                    <input type="text" id="namapasien"
                                                        value="{{ strtolower($skip->nm_pasien) }}"
                                                        style="display: none"> --}}
                                                    <input type="text" id="inputField6" style="display: none">
                                                    <button onclick="speak6()"
                                                        class="btn btn-sm btn-primary">Panggil</button>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
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
            var inputField = document.getElementById("inputField");
            var noReg = document.getElementById("noReg");
            var selectedOption = selectElement.options[selectElement.selectedIndex].text;
            var selectedOptionnn = selectElement.options[selectElement.selectedIndex].text;
            inputField.value = "pasien nomer antrian " + selectedOption + ", silahkan ke ruang 1";
            noReg.value = selectedOptionnn;
        }

        function speak() {
            var text = document.getElementById("inputField").value;
            var utterance = new SpeechSynthesisUtterance();
            utterance.lang = "id-ID";
            utterance.text = text;
            speechSynthesis.speak(utterance);
        }

        function updateInput2() {
            var selectElement = document.getElementById("mySelect2");
            var inputField2 = document.getElementById("inputField2");
            var selectedOption = selectElement.options[selectElement.selectedIndex].text;
            inputField2.value = "pasien nomer antrian " + selectedOption + ", silahkan ke ruang 2";
        }

        function speak2() {
            var text = document.getElementById("inputField2").value;
            var utterance = new SpeechSynthesisUtterance();
            utterance.lang = "id-ID";
            utterance.text = text;
            speechSynthesis.speak(utterance);
        }

        function updateInput3() {
            var selectElement = document.getElementById("mySelect3");
            var inputField3 = document.getElementById("inputField3");
            var selectedOption = selectElement.options[selectElement.selectedIndex].text;
            inputField3.value = "pasien nomer antrian " + selectedOption + ", silahkan ke ruang 3";
        }

        function speak3() {
            var text = document.getElementById("inputField3").value;
            var utterance = new SpeechSynthesisUtterance();
            utterance.lang = "id-ID";
            utterance.text = text;
            speechSynthesis.speak(utterance);
        }

        function updateInput4() {
            var selectElement = document.getElementById("mySelect4");
            var inputField4 = document.getElementById("inputField4");
            var selectedOption = selectElement.options[selectElement.selectedIndex].text;
            inputField4.value = "pasien nomer antrian " + selectedOption + ", silahkan ke ruang 4";
        }

        function speak4() {
            var text = document.getElementById("inputField4").value;
            var utterance = new SpeechSynthesisUtterance();
            utterance.lang = "id-ID";
            utterance.text = text;
            speechSynthesis.speak(utterance);
        }

        function updateInput5() {
            var selectElement = document.getElementById("mySelect5");
            var inputField5 = document.getElementById("inputField5");
            var selectedOption = selectElement.options[selectElement.selectedIndex].text;
            inputField5.value = "pasien nomer antrian " + selectedOption + ", silahkan ke ruang 5";
        }

        function speak5() {
            var text = document.getElementById("inputField5").value;
            var utterance = new SpeechSynthesisUtterance();
            utterance.lang = "id-ID";
            utterance.text = text;
            speechSynthesis.speak(utterance);
        }

        function updateInput6() {
            var selectElement = document.getElementById("mySelect6");
            var inputField6 = document.getElementById("inputField6");
            var selectedOption = selectElement.options[selectElement.selectedIndex].text;
            inputField6.value = "pasien nomer antrian " + selectedOption + ", silahkan ke ruang akupuntur";
        }

        function speak6() {
            var text = document.getElementById("inputField6").value;
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
