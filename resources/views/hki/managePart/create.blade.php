@extends('layouts.templateBaru', ['title' => 'Tambah User'])
@section('content')
    <div class="container">
        <h1 class="left-align" style="text-align: left;">Tambah Part</h1>
        <p class="left-align" style="text-align: left;">Dashboard>Data Master>Tambah Part</p>
        <div class="card">
            <div class="xformdm">
                <div class="form mt-4">
                    <form enctype="multipart/form-data" action="{{ route('hki.part.store') }}" method="POST">
                        @csrf
                        <div style="text-align: left" class="row">
                            <div class="col col-md-12 col-12 mt-4">
                                <div class="form-group">
                                    <label for="level" style="margin-bottom: 10px;">Produser</label>
                                    <select name="id_user" class="form-control @error('role_id') is-invalid @enderror">
                                        <option value="" selected disabled>-- Pilih Produser --</option>
                                        @foreach ($produser as $data)
                                            <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('role_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col col-md-12 col-12 mt-4">
                                <div class="form-group">
                                    <label for="#" style="margin-bottom: 10px;">Part No</label>
                                    <input type="text" class="form-control @error('part_no') is-invalid @enderror"
                                        id="part_no" name="part_no" placeholder="Masukkan Part No">
                                </div>
                            </div>
                            <div class="col col-md-12 col-12 mt-4">
                                <div class="form-group">
                                    <label for="#" style="margin-bottom: 10px;">Part Name</label>
                                    <input type="text" class="form-control @error('part_name') is-invalid @enderror"
                                        id="part_name" name="part_name" placeholder="Masukkan Part Name">
                                </div>
                            </div>
                            <div class="col col-md-12 col-12 mt-4">
                                <div class="form-group">
                                    <label for="#" style="margin-bottom: 10px;">Drawing No</label>
                                    <input type="number" class="form-control @error('drawing_no') is-invalid @enderror"
                                        id="drawing_no" name="drawing_no" placeholder="Masukkan Drawing No">
                                </div>
                            </div>

                            <div class="col col-md-12 col-12 mt-4">
                                <div class="form-group">
                                    <label for="class" style="margin-bottom: 10px;">Class</label>
                                    <select name="class" class="form-control @error('class') is-invalid @enderror">
                                        <option value="" selected disabled>-- Pilih Class --</option>
                                        <option value="Subcon">Subcon</option>
                                        <option value="Material">Material</option>
                                        <option value="Purchase">Purchase</option>
                                    </select>
                                    @error('class')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col col-md-12 col-12 mt-4">
                                <div class="form-group">
                                    <label for="#" style="margin-bottom: 10px;">Composition</label>
                                    <input type="number" step="0.00001"
                                        class="form-control @error('#') is-invalid @enderror" id="#"
                                        name="composition" placeholder="Masukkan Composition">
                                </div>
                            </div>
                            <div class="col col-md-12 col-12 mt-4">
                                <div class="form-group">
                                    <label for="#" style="margin-bottom: 10px;">Default Supplier</label>
                                    <select onchange="supplierName()" name="default_supplier" id="default_supplier"
                                        class="form-control">
                                        <option value="" selected disabled>-- Pilih Default Supplier --</option>
                                        @foreach ($perusahaan as $data)
                                            <option value="{{ $data->id_perusahaan }}">{{ $data->id_perusahaan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col col-md-12 col-12 mt-4">
                                <div class="form-group">
                                    <label for="#" style="margin-bottom: 10px;">Supplier Name</label>
                                    <input type="text" class="form-control @error('#') is-invalid @enderror"
                                        id="supplier_name" name="supplier_name" placeholder="Masukkan Default Supplier"
                                        readonly>
                                </div>
                            </div>
                            <div class="col col-md-12 col-12 mt-4">
                                <div class="form-group">
                                    <label for="#" style="margin-bottom: 10px;">Unit Price</label>
                                    <input type="number" class="form-control @error('#') is-invalid @enderror"
                                        id="#" name="unit_price" placeholder="Masukkan Unit Price">
                                </div>
                            </div>
                            <div class="col col-md-12 col-12 mt-4">
                                <div class="form-group">
                                    <label for="#" style="margin-bottom: 10px;">Effective Date</label>
                                    <input type="date" class="form-control @error('#') is-invalid @enderror"
                                        id="effective_date" name="effective_date" placeholder="">
                                </div>
                            </div>
                        </div>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary">Tambah Part</button>
                </div>
                </form>
            </div>

        </div>

    </div>
    </div>

    <script>
        // $(document).ready(function() {
        //     $('#part_no').keyup(function() {
        //         date = new Date();
        //         const effective_date = $('#effective_date').val(date.toLocaleDateString('id-ID') + ' - ' +
        //             date
        //             .toLocaleTimeString('id-ID'))
        //     });
        // })

        function supplierName() {
            var id_perusahaan = $("#default_supplier").val();
            $.get("{{ url('getnama') }}/" + id_perusahaan, {}, function(data, status) {
                $("#supplier_name").val(data);
            })
        }
    </script>
@endsection
