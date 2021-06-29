<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cek Ongkir</title>

    <link rel="stylesheet" href="{{ asset('assets/vendors/choices.js/choices.min.css')}} " />
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css')}} ">
    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css')}} ">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css')}} ">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg" type="image/x-icon')}} ">
</head>
<body>
<div class="main-content container-fluid" style="margin-top: 20px">
    @if ($active == 1)
    <div class="list-group list-group-horizontal-sm mb-1 text-center"  role="tablist">
        <a class="list-group-item list-group-item-action active" id="list-sunday-list" data-bs-toggle="list" href="#list-sunday" role="tab">Cek Ongkir</a>
        <a class="list-group-item list-group-item-action" id="list-monday-list" data-bs-toggle="list" href="#list-monday" role="tab">Cek Resi</a>
    </div>
    <div class="tab-content text-justify">
        <div class="tab-pane fade show active" id="list-sunday" role="tabpanel" aria-labelledby="list-sunday-list" style="margin-top: 20px">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="alert alert-primary card-title">
                                Form Cek Ongkir
                            </div>
                        </div>
                        <form method="POST" action="{{ route('store') }}">
                        @csrf
                        <div class="card-content" style="margin-top: -35px">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <h5>Asal Pengiriman : </h5>
                                        <div class="form-group">
                                            <label >Provinsi</label>
                                            <select required class="form-select" name="province_origin" id="province_origin">
                                                @foreach ($province as $key => $value)
                                                    <option value="{{ $key }}"> {{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label >Kota / Kabupaten</label>
                                            <select required class="form-select" name="origin_city" id="city_origin">
                                                <option value="">&nbsp;</option>
                                            </select>
                                        </div>
                                        <h5>Berat Paket :</h5>
                                        <div class="form-group">
                                            <input type="text" required name="weight" class="form-control">
                                            <small>Satuan Gram. Misalkan 1700G</small>
                                        </div>
                                        <div class="form-group">
                                            <button id="submit" type="submit" class="btn btn-primary round">Cek</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <h5>Tujuan Pengiriman : </h5>
                                        <div class="form-group">
                                            <label >Provinsi</label>
                                            <select class="form-select" name="province_destionation" id="province_destionation">
                                                @foreach ($province as $key => $value)
                                                    <option value="{{ $key }}"> {{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label >Kota / Kabupaten</label>
                                            <select  required class="form-select" name="city_destination" id="city_destination">
                                                <option value="">&nbsp;</option>
                                            </select>
                                        </div>
                                        <h5>Ekspedisi :</h5>
                                        <div class="form-group">
                                            <select required name="courier" id="" class="form-select">
                                            @foreach ($courier as $item)
                                                <option value="{{ $item->code }}">{{ $item->title }}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if ($result_cost)
                        <div class="card-header" style="margin-top: -40px">
                            <div class="alert alert-success card-title">
                                Result Cek Ongkir
                            </div>
                        </div>
                        <div class="card-content" style="margin-top: -40px">
                            <div class="card-body">
                                <p>
                                    <div class="row">
                                        <div class="col-md-2">
                                            Asal Pengiriman
                                        </div>
                                        <div class="col-md-4">
                                            : {{ $type_origin }} {{ $city_origin }} , {{ $province_origin }}
                                        </div>
                                    </div>
                                </p>
                                <p>
                                    <div class="row">
                                        <div class="col-md-2">
                                            Tujuan Pengiriman
                                        </div>
                                        <div class="col-md-4">
                                            : {{ $type_destination }} {{ $city_destination }} , {{ $province_destination }}
                                        </div>
                                    </div>
                                </p>
                            </div>
                        </div>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Nama Service</th>
                                        <th>Deskripsi</th>
                                        <th>Harga</th>
                                        <th>Estimasi Pengiriman</th>
                                    </tr>
                                </thead>
                                <tbody class="">
                                @foreach($result_cost as $result)
                                    <tr>
                                        <td>{{$result['service']}}</td>
                                        <td>{{$result['description']}}</td>
                                        <td>{{$result['cost'][0]['value']}}</td>
                                        <td>{{$result['cost'][0]['etd']}} Hari</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                        @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="list-monday" role="tabpanel" aria-labelledby="list-monday-list" style="margin-top:20px">
                <div class="card">
                    <div class="card-header">
                            <div class="alert alert-primary card-title">
                                Form Cek Resi
                            </div>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <form method="POST" action="{{ route('storeResi') }}">
                                    @csrf
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="resi">No Resi</label>
                                            <input type="text" id="resi" name="awb" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="courier">Ekspedisi</label>
                                            <select name="courier" id="courier" class="form-select">
                                                <option value="jne">JNE</option>
                                                <option value="pos">POS INDONESIA</option>
                                                <option value="jnt">JNT</option>
                                                <option value="sicepat">SiCepat</option>
                                                <option value="tiki">Tiki</option>
                                                <option value="anteraja">AnterAja</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary round" type="submit">Cari</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    @else
    <div class="list-group list-group-horizontal-sm mb-1 text-center"  role="tablist">
        <a class="list-group-item list-group-item-action" id="list-sunday-list" data-bs-toggle="list" href="#list-sunday" role="tab">Cek Ongkir</a>
        <a class="list-group-item list-group-item-action active" id="list-monday-list" data-bs-toggle="list" href="#list-monday" role="tab">Cek Resi</a>
    </div>
    <div class="tab-content text-justify">
        <div class="tab-pane fade" id="list-sunday" role="tabpanel" aria-labelledby="list-sunday-list" style="margin-top: 20px">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="alert alert-primary card-title">
                                Form Cek Ongkir
                            </div>
                        </div>
                        <form method="POST" action="{{ route('store') }}">
                        @csrf
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <h5>Asal Pengiriman : </h5>
                                        <div class="form-group">
                                            <label >Provinsi</label>
                                            <select required class="form-select" name="province_origin" id="province_origin">
                                                @foreach ($province as $key => $value)
                                                    <option value="{{ $key }}"> {{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label >Kota / Kabupaten</label>
                                            <select required class="form-select" name="origin_city" id="city_origin">
                                                <option value="">&nbsp;</option>
                                            </select>
                                        </div>
                                        <h5>Berat Paket :</h5>
                                        <div class="form-group">
                                            <input type="text" required name="weight" class="form-control">
                                            <small>Satuan Gram. Misalkan 1700G</small>
                                        </div>
                                        <div class="form-group">
                                            <button id="submit" type="submit" class="btn btn-primary round">Cek</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <h5>Tujuan Pengiriman : </h5>
                                        <div class="form-group">
                                            <label >Provinsi</label>
                                            <select class="form-select" name="province_destionation" id="province_destionation">
                                                @foreach ($province as $key => $value)
                                                    <option value="{{ $key }}"> {{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label >Kota / Kabupaten</label>
                                            <select  required class="form-select" name="city_destination" id="city_destination">
                                                <option value="">&nbsp;</option>
                                            </select>
                                        </div>
                                        <h5>Ekspedisi :</h5>
                                        <div class="form-group">
                                            <select required name="courier" id="" class="form-select">
                                            @foreach ($courier as $item)
                                                <option value="{{ $item->code }}">{{ $item->title }}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if ($result_cost)
                        <div class="card-header" style="margin-top: -400px">
                            <div class="alert alert-success card-title">
                                Result Cek Ongkir
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <p>
                                    <div class="row">
                                        <div class="col-md-2">
                                            Asal Pengiriman
                                        </div>
                                        <div class="col-md-4">
                                            : {{ $type_origin }} {{ $city_origin }} , {{ $province_origin }}
                                        </div>
                                    </div>
                                </p>
                                <p>
                                    <div class="row">
                                        <div class="col-md-2">
                                            Tujuan Pengiriman
                                        </div>
                                        <div class="col-md-4">
                                            : {{ $type_destination }} {{ $city_destination }} , {{ $province_destination }}
                                        </div>
                                    </div>
                                </p>
                            </div>
                        </div>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Nama Service</th>
                                        <th>Deskripsi</th>
                                        <th>Harga</th>
                                        <th>Estimasi Pengiriman</th>
                                    </tr>
                                </thead>
                                <tbody class="">
                                @foreach($result_cost as $result)
                                    <tr>
                                        <td>{{$result['service']}}</td>
                                        <td>{{$result['description']}}</td>
                                        <td>{{$result['cost'][0]['value']}}</td>
                                        <td>{{$result['cost'][0]['etd']}} Hari</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                        @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade show active" id="list-monday" role="tabpanel" aria-labelledby="list-monday-list" style="margin-top:20px">
                <div class="card">
                    <div class="card-header">
                            <div class="alert alert-primary card-title">
                                Form Cek Resi
                            </div>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row" style="margin-top: -40px">
                                <form method="POST" action="{{ route('storeResi') }}">
                                    @csrf
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="resi">No Resi</label>
                                            <input type="text" id="resi" name="awb" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="courier">Ekspedisi</label>
                                            <select name="courier" id="courier" class="form-select">
                                                <option value="jne">JNE</option>
                                                <option value="pos">POS INDONESIA</option>
                                                <option value="jnt">JNT</option>
                                                <option value="sicepat">SiCepat</option>
                                                <option value="tiki">Tiki</option>
                                                <option value="anteraja">AnterAja</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary round" type="submit">Cari</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @if ($status == 200)
                    <div class="card-header" >
                            <div class="alert alert-success card-title">
                                Result Cek Resi
                            </div>
                    </div>
                    <div class="card-content" style="margin-top: -50px">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p>
                                        <div class="row">
                                            <div class="col-md-2">
                                                No Resi
                                            </div>
                                            <div class="col-md-4">
                                                : {{ $no_resi['awb'] }}
                                            </div>
                                        </div>
                                    </p>
                                    <p>
                                        <div class="row">
                                            <div class="col-md-2">
                                                Kurir
                                            </div>
                                            <div class="col-md-4">
                                                : {{ $no_resi['courier'] }}
                                            </div>
                                        </div>
                                    </p>
                                    <p>
                                        <div class="row">
                                            <div class="col-md-2">
                                                Service
                                            </div>
                                            <div class="col-md-4">
                                                : {{ $no_resi['service'] }}
                                            </div>
                                        </div>
                                    </p>
                                    <p>
                                        <div class="row">
                                            <div class="col-md-2">
                                                Status
                                            </div>
                                            <div class="col-md-4">
                                                : {{ $no_resi['status'] }}
                                            </div>
                                        </div>
                                    </p>
                                </div>
                                <div class="col-md-4">
                                     <p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                Asal Pengiriman
                                            </div>
                                            <div class="col-md-6">
                                                : {{ $detail['origin'] }}
                                            </div>
                                        </div>
                                    </p>
                                    <p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                Tujuan Pengiriman
                                            </div>
                                            <div class="col-md-6">
                                                : {{ $detail['destination'] }}
                                            </div>
                                        </div>
                                    </p>
                                    <p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                Nama Pengiriman
                                            </div>
                                            <div class="col-md-6">
                                                : {{ $detail['shipper'] }}
                                            </div>
                                        </div>
                                    </p>
                                    <p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                Nama Penerima
                                            </div>
                                            <div class="col-md-6">
                                                : {{ $detail['receiver'] }}
                                            </div>
                                        </div>
                                    </p>

                                </div>
                            </div>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal </th>
                                        <th>Deskripsi</th>
                                        <th>Lokasi</th>
                                    </tr>
                                </thead>
                                <tbody class="">
                                <?php $i = 1; ?>
                                @foreach($history as $result)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$result['date']}}</td>
                                        <td>{{$result['desc']}}</td>
                                        <td>{{$result['location']}}</td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                            @else
                            <div class="card-header" style="margin-top:-30px">
                                <div class="alert alert-danger card-title">
                                    Result Cek Resi
                                </div>
                                <h5>No Resi Tidak Di temukan</h5>

                            </div>
                            @endif
                        </div>
                </div>
        </div>
    </div>
    @endif

</div>
</body>
    <script src="{{ asset('assets/js/feather-icons/feather.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{ asset('assets/js/app.js')}}"></script>
    <script src="{{ asset('js/app.js')}}"></script>
        <!-- Include Choices JavaScript -->
    <script src="{{ asset('assets/vendors/choices.js/choices.min.js')}}"></script>
    <script src="{{ asset('assets/js/main.js')}}"></script>

</html>
