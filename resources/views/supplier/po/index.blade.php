@extends('layouts.templateBaru',['title'=>'PO Supplier'])
@section('content')
<div class="container">
	<h3>Purchase Order Supplier {{Auth::user()->name}}</h3>
	@if (session()->has('success'))
    <script>
        window.onload = function () {
                swal.fire("Berhasil");
            };
    </script>
    @endif
	
    <div class="row">
        <div class="col col-md-12 col-12 mt-2">
            <div class="ss" data-aos="fade-up">
                <table id="supplierPO" class="display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>PO No</th>
                            <th>Issue Date</th>
                            <th>Class</th>
                            <th style="text-align: center">ID<br>(Default Supplier)</th>
                            <th>Currency</th>
                            <th>Nama Perusahaan</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no=1;    
                        @endphp
                       @foreach($PO as $data)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$data->po_number}}</td>
                            <td>{{$data->issue_date}}</td>
                            <td>{{$data->class}}</td>
                            <td>{{$data->default_supplier_id}}</td>
                            <td>{{$data->currency_code}}</td>
                            <td>{{$data->nama}}</td>
                                <td> @if($data->status == "On Progress")
                                    <a  class="btn" style="background-color:orangered;color:white">On Progress</a>
                                    @elseif($data->status == "Finish")
                                    <a class="btn" style="background-color:rgb(21, 181, 0);color:white">Finish</a>
                                    @endif
                                </td>
                                <td style="width:15%">
                                    <a href="#" onclick="modalRead({{$data->id_po}})" class="btn btn-warning">Read</a>
                                    <a href="{{url('supplier/po/download/'.$data->id_po)}}" class="btn btn-primary">Download</a>
                                </td>
                            </tr>
                          @endforeach
                    </tbody>
                </table>
              </div>
        </div>
    </div>
	
  
</div>

{{-- Modal --}}
<div id="exampleModalCenter" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Modal Title</h5>
            </div>
            <div class="modal-body">
                <p class="mb-0" id="page"></p>
            </div>
            <div id="modalFooter" class="modal-footer">
             
            </div>
        </div>
    </div>
</div>
{{-- endModal --}}


@endsection

@section('script')
<script>
    $(document).ready(function () {
     var t = $('#supplierPO').DataTable({
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true,
        stateSave: true,
        columnDefs: [
             {
                 searchable: false,
                 orderable: false,
                 targets: 0,
             },
         ],
         order: [[1, 'asc']],

    });

    t.on('order.dt search.dt', function () {
         let i = 1;
  
         t.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
             this.data(i++);
         });
     }).draw();
 });
 </script>

 <script>
   
     function modalRead(no) {
        $.get("{{ url('supplier/po/detailpo') }}/" + no, {}, function(data, status) {
            $("#exampleModalCenterTitle").html(`Detail Purchase Order`)
            $("#page").html(data);
            $("#exampleModalCenter").modal('show');
           })  
    }

 </script>


 @endsection