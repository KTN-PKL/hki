@extends('layouts.templateBaru', ['title' => 'Update Part'])
@section('content')
    <div class="container">
        <h1 class="left-align" style="text-align: left;">Update Part</h1>
        <p class="left-align" style="text-align: left;">Dashboard>Data Master>Update Part</p>
        <div class="card">
            <div class="xformdm">
                <div class="form mt-4">
                    <form enctype="multipart/form-data" action="{{ route('hki.part.update', $part->id_part) }}"
                        method="POST">
                        @csrf
                        <div style="text-align: left" class="row">
                            <div class="col col-md-12 col-12 mt-4">
                                <div class="form-group">
                                    <label for="level" style="margin-bottom: 10px;">Produser</label>
                                    <select onchange="supplierName()" name="id_user" id="id_user"
                                        class="form-control @error('role_id') is-invalid @enderror">
                                        @foreach ($produser as $data)
                                            <option value="{{ $data->id }}"
                                                @if ($data->id == $part->id) selected @endif>{{ $data->nama }}
                                            </option>
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
                                    <label for="#" style="margin-bottom: 10px;">Default Supplier</label>
                                    <input type="text" name="" class="form-control" id="default_supplier"
                                        readonly>
                                    {{-- <select name="default_supplier" id="default_supplier" class="form-control">
                                        <option value="" selected disabled>-- Pilih Default Supplier --</option>
                                        @foreach ($perusahaan as $data)
                                            <option value="{{ $data->id_perusahaan }}">{{ $data->id_perusahaan }}</option>
                                        @endforeach
                                    </select> --}}
                                </div>
                            </div>
                            <div class="col col-md-12 col-12 mt-4">
                                <div class="form-group">
                                    <label for="#" style="margin-bottom: 10px;">Supplier Name</label>
                                    <input type="text" class="form-control @error('#') is-invalid @enderror"
                                        id="supplier_name" name="supplier_name" readonly>
                                </div>
                            </div>
                            <div class="col col-md-12 col-12 mt-4">
                                <div class="form-group">
                                    <label for="#" style="margin-bottom: 10px;">Part No</label>
                                    <input type="text" class="form-control @error('part_no') is-invalid @enderror"
                                        id="#" name="part_no" placeholder="Masukkan Part No"
                                        value="{{ $part->part_no }}">
                                    @error('part_no')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col col-md-12 col-12 mt-4">
                                <div class="form-group">
                                    <label for="#" style="margin-bottom: 10px;">Part Name</label>
                                    <input type="text" class="form-control @error('part_name') is-invalid @enderror"
                                        id="#" name="part_name"
                                        placeholder="Masukkan Part Name"value="{{ $part->part_name }}">
                                    @error('part_name')
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
                                        class="form-control @error('composition') is-invalid @enderror" id="#"
                                        name="composition" placeholder="Masukkan Composition"
                                        value="{{ $part->composition }}">
                                    @error('composition')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col col-md-12 col-12 mt-4">
                                <div class="form-group">
                                    <label for="#" style="margin-bottom: 10px;">Drawing No</label>
                                    <input type="number" class="form-control @error('drawing_no') is-invalid @enderror"
                                        id="drawing_no" name="drawing_no" placeholder="Masukkan Drawing No"
                                        value="{{ $part->drawing_no }}">
                                    @error('drawing_no')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col col-md-12 col-12 mt-4">
                                <div class="form-group">
                                    <label for="class" style="margin-bottom: 10px;">Class</label>
                                    <select name="class_part"
                                        class="form-control @error('class_part') is-invalid @enderror">
                                        <option value="" selected disabled>-- Pilih Class --</option>
                                        <option value="Subcon" @if ($part->class_part == 'Subcon') selected @endif>Subcon
                                        </option>
                                        <option value="Material" @if ($part->class_part == 'Material') selected @endif>Material
                                        </option>
                                        <option value="Purchase" @if ($part->class_part == 'Purchase') selected @endif>Purchase
                                        </option>
                                    </select>
                                    @error('class_part')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col col-md-12 col-12 mt-4">
                                <div class="form-group">
                                    <label for="#" style="margin-bottom: 10px;">Unit Price</label>
                                    <input type="number" class="form-control @error('unit_price') is-invalid @enderror"
                                        id="#" name="unit_price"
                                        placeholder="Masukkan Unit Price"value="{{ $part->unit_price }}">
                                    @error('unit_price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col col-md-12 col-12 mt-4">
                                <div class="form-group">
                                    <label for="#" style="margin-bottom: 10px;">Effective Date</label>
                                    <input type="date"
                                        class="form-control @error('effective_date') is-invalid @enderror"
                                        id="effective_date" name="effective_date" placeholder=""
                                        value="{{ $part->effective_date }}">
                                    @error('effective_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                </div>

                <div class="text-center mt-4">
                    <button type="button" class="btn btn-warning cancel-button" onclick="showDeleteConfirmation()"
                        style="color: white">Cancel</button>
                    <button type="submit" class="btn btn-primary submit-button">Update Data</button>
                </div>
                </form>
            </div>

        </div>

    </div>
    </div>

@section('script')
    <script>
        $(document).ready(function() {
            var id_perusahaan = $("#id_user").val();
            $.get("{{ url('getnama') }}/" + id_perusahaan, {}, function(data, status) {
                var id = data.id;
                var nama = data.nama;

                $("#supplier_name").val(nama);
                $("#default_supplier").val(id);

            });
        });

        function showDeleteConfirmation() {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Untuk membatalkan tindakan?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Batalkan!',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('hki.part.index') }}";
                }
            });
        }

        function supplierName() {
            var id_perusahaan = $("#id_user").val();
            $.get("{{ url('getnama') }}/" + id_perusahaan, {}, function(data, status) {
                var id = data.id;
                var nama = data.nama;

                $("#supplier_name").val(nama);
                $("#default_supplier").val(id);
            })
        }
    </script>
@endsection
<style>
    .cancel-button {
        margin-right: 10px;
        /* Tambahkan jarak margin ke kanan */
    }

    /* Atau jika Anda ingin memberi jarak ke kedua sisi tombol */
    .submit-button {
        margin-left: 10px;
    }
</style>

@endsection
