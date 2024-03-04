<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Truncate Data Table</title>
    <meta http-equiv="refresh" content="30">
    <link rel="stylesheet" href="public/css/style.css">
</head>

<body>
    <div class="container container-fluid">
        <div class="row">
            <div class="col">
                <div class="card footer text-dark mt-2">
                    <div class="row">
                        <h1 class="text-center">Truncate Data Table</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card content text-dark mt-3">
                    @if (session('success'))
                        <div id="alert" class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="row truncate">
                        <div class="col-md-12 d-flex justify-content-center">
                            <a href="{{route('pagi')}}" class="btn btn-warning">Antrian Pagi</a>
                            <a href="{{route('sore')}}" class="btn btn-danger">Antrian Sore</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
