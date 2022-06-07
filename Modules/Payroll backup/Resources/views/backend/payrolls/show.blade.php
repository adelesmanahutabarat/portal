@extends ('layouts.vertical')

@section('title') {{ $module_action }} {{ $module_title }} @endsection

@section('breadcrumb')
<x-backend-breadcrumbs>
    <x-backend-breadcrumb-item type="active" icon='{{ $module_icon }}'>{{ $module_title }}</x-backend-breadcrumb-item>
</x-backend-breadcrumbs>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col">
                <h4 class="card-title mb-0">
                    <i class="{{ $module_icon }}"></i> {{ $module_title }} <small
                        class="text-muted">{{ $module_action }}</small>
                </h4>
                <div class="small text-muted">
                    Report Management
                </div>
            </div>

            <div class="col-6 col-sm-4">
                <div class="float-right">
                    <x-buttons.return-back />
                </div>
            </div>
            <!--/.col-->
        </div>
        <!--/.row-->

        <hr>

        <div class="row mt-4">
            <div class="col">
                <div class="form-group">
                    <table>
                        <tr>
                            <td>Cabang</td>
                            <td>:</td>
                            <td><b>{{$payroll->cabang}}</b></td>
                        </tr>
                        <tr>
                            <td>Periode</td>
                            <td>:</td>
                            <td><b>{{$payroll->date_period}}</b></td>
                        </tr>
                        <!-- <tr>
                            <td>Total</td>
                            <td>:</td>
                            <td><b>{{$payroll->total}}</b></td>
                        </tr>
                        <tr>
                            <td>Created By</td>
                            <td>:</td>
                            <td><b>{{$payroll->name}}</b></td>
                        </tr>
                        <tr>
                            <td>Created At</td>
                            <td>:</td>
                            <td><b>{{$payroll->created_at}}</b></td>
                        </tr> -->
                    </table>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table id="datatable" class="table table-hover  ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Karyawan</th>
                                <th>Nominal</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-7">
                <div class="float-left">

                </div>
            </div>
            <div class="col-5">
                <div class="float-right">

                </div>
            </div>
        </div>
    </div>
</div>
<x-library.datatable isDef="false" />
@endsection

@push ('after-scripts')
<script>
function myFunction() {
    if (!confirm("Yakin Ingin Menghapus Label Ini?"))
        event.preventDefault();
}
</script>

<!-- DataTables Core and Extensions -->
<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

let urlString = window.location.href;
let paramString = urlString.split('?')[1];
let queryString = new URLSearchParams(paramString);

table = $('#datatable').DataTable({
    processing: true,
    serverSide: true,
    autoWidth: true,
    responsive: false,
    order: [
        [2, 'desc']
    ],
    ajax: {
        'url': '{{ route("backend.$module_name.detail_list") }}',
        'data': function(d) {
            d.user_id = queryString.get('user_id');
            d.date = queryString.get('date');
        },
    },
    columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex',
            orderable: false,
            searchable: false,
        },
        {
            data: 'name',
            name: 'u.name',
        },
        {
            data: 'amount',
            name: 'amount',
            render: $.fn.dataTable.render.number('', '.', 2, ''),
        }
    ],
    "language": {
        "paginate": {
            "previous": "<i class='uil uil-angle-left'>",
            "next": "<i class='uil uil-angle-right'>"
        }
    },
    "drawCallback": function drawCallback() {
        $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
    }
});

</script>


@endpush