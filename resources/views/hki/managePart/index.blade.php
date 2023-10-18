@extends('layouts.templateBaru', ['title' => 'Manage Part'])
@section('content')
    <div class="container">
        <h1 class="left-align" style="text-align: left;">Data Master</h1>
        <p class="left-align" style="text-align: left;">Dashboard>Data Master>Part</p>
        <div class="d-flex justify-content-end">
            <a href="{{ route('hki.part.create') }}" class="btn btn-primary" style="width:300px;margin-right:1em;">Tambah
                Part</a>
            <a href="#" class="btn btn-success" style="width:300px"data-bs-toggle="modal"
                data-bs-target="#import1">Import
                Part</a>
        </div>
        @if ($message = session('success'))
            <script>
                window.onload = function() {
                    swal.fire("{{ $message }}");
                };
            </script>
        @endif

        <div class="row">
            <div class="col-12 mt-2">
                <div class="ss" data-aos="fade-up">
                    <table id="myPart" class="display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Produser</th>
                                <th>Id Part</th>
                                <th>Part No</th>
                                <th>Part Name</th>
                                <th>Composition</th>
                                <th>Unit Price</th>
                                <th>Action</th>
                            </tr>

                        </thead>
                        <tbody>
                            @foreach ($part as $data)
                                <tr>
                                    <td></td>
                                    <td>{{ $data->nama }}</td>
                                    <td>{{ $data->id_part }}</td>
                                    <td>{{ $data->part_no }}</td>
                                    <td>{{ $data->part_name }}</td>
                                    <td>{{ $data->composition }}</td>
                                    <td>{{ $data->unit_price }}</td>
                                    <td>
                                        <a
                                            href="{{ route('hki.part.edit', $data->id_part) }}"class="btn btn-warning btn-sm">Edit</a>
                                        <a id="hapus" href="#"
                                            onclick="modalHapus({{ $data->id_part }})"class="btn btn-danger btn-sm">Hapus</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>



        </div>


    </div>

    {{-- Modal Import --}}
    <div id="import1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Import Excel</h5>
                    {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button> --}}
                </div>
                <form action="{{ route('hki.part.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="col col-md-12 col-12">
                            <div class="form-group">
                                <label for="">Produser Part</label>
                                <select onchange="getNama()" name="id_user" id="id_user" class="form-control">
                                    <option value="" selected disabled>-- Pilih Produser Part --</option>
                                    @foreach ($produser as $data)
                                        <option value="{{ $data->id }}">{{ $data->id_perusahaan }} -
                                            {{ $data->nama }}</option>
                                    @endforeach
                                </select>
                                <input type="text" id="nama" name="nama" hidden>
                                <span id="errorExcel1" style="color: red;display:none;">Bidang ini harap diisi</span>
                            </div>
                        </div>
                        <div class="col col-md-12 col-12 mt-4">
                            <div class="form-group">
                                <label for="">Upload Excel</label>
                                <input type="file" name="excel" id="excel" class="form-control">
                            </div>
                        </div>
                        <span id="errorExcel2" style="color: red;display:none;">Bidang ini harap diisi</span>
                    </div>
                    <div id="modalFooter" class="modal-footer">
                        <a style="color:white" class="btn  btn-secondary" data-bs-dismiss="modal">Tutup</a>
                        {{-- <a href="{{ asset('foto/dm/pengguna/Akun.xlsx') }}" class="btn btn-primary" download>Download
                            Format</a> --}}
                        <button id="send" type="submit" class="btn  btn-success" hidden>Import</button>
                </form>
                <a style="color:white" onclick="confirm()" class="btn  btn-success">Import</a>
            </div>

        </div>
    </div>
    </div>
    {{-- End Modal Import --}}
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            var t = $('#myPart').DataTable({
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                responsive: true,
                stateSave: true,
                columnDefs: [{
                    searchable: false,
                    orderable: false,
                    targets: 0,
                }, ],
                order: [
                    [1, 'asc']
                ],

            });

            t.on('order.dt search.dt', function() {
                let i = 1;

                t.cells(null, 0, {
                    search: 'applied',
                    order: 'applied'
                }).every(function(cell) {
                    this.data(i++);
                });
            }).draw();
        });
    </script>

    <script>
        function modalHapus(id_part) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Untuk menghapus user?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "get",
                        url: "{{ url('hki/part/destroy') }}/" + id_part,
                        success: function(data) {
                            location.reload(true);
                            Swal.fire(
                                'Berhasil!',
                                'User berhasil dihapus',
                                'success',
                                '10000'
                            )
                        }
                    });

                }
            })
        }

        function confirm() {
            var id_user = $("#id_user").val();
            var excel = $("#excel").val();
            if (!id_user) {
                document.getElementById('errorExcel1').style.display = "block";
            } else if (!excel) {
                document.getElementById('errorExcel2').style.display = "block";
            } else {
                $("#send").click();
            }
        }

        function getNama() {
            var id_perusahaan = $("#id_user").val();
            $.get("{{ url('getnama') }}/" + id_perusahaan, {}, function(data, status) {
                var nama = data.nama;
                $("#nama").val(nama);
            })
        }
    </script>
@endsection
