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

            <!--/.col-->
        </div>
        <!--/.row-->

        <hr>

        <div class="row mt-4">
            <div class="col">
                <div>
                    <label for="">Cabang</label>
                    <form id="frm-filter" class="form-inline" action="#">
                        <div class="form-group mb-2 ">
                            <label class="sr-only">Bulan</label>
                            <select class="form-control" name="bulan" id="bulan">
                                @foreach($branches as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="button" id="btnfilter" class="btn btn-primary mb-2 mx-3"><i
                                class="fa fa-sync"></i> Filter</button>
                    </form>
                </div>
            </div>
            <div class="ml-auto mr-3 text-right">
                <!-- <h5><span class="badge badge-success text-white">Total <span id="grossTotalSum">0</span></span></h5> -->
            </div>
        </div>

        <div class="row mt-4">
            <div class="col">
                <!-- <div class="table-responsive"> -->
                <table id="datatable" class="table table-hover  ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No.HP</th>
                            <th>Jenis Kelamin</th>
                            <th>Penempatan</th>
                            <th>Status</th>
                            <th>Tgl Lahir</th>
                            <th>Tempat Lahir</th>
                            <th>Agama</th>
                            <th>Alamat</th>
                            <th>Jabatan</th>
                            <th>NPWP</th>
                            <th>Nomor KTP</th>
                            <th>Pendidikan Terakhir</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                </table>
                <!-- </div> -->
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

table = $('#datatable').DataTable({
    order: [
        [2, 'desc']
    ],
    processing: true,
    serverSide: true,
    autoWidth: true,
    responsive: false,
    ajax: {
        'url': '{{ route("backend.$module_name.index_list") }}',
        'data': function(d) {
            d.bulan = $("#bulan").val()
        },
    },
    columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex',
            orderable: false,
            searchable: false,
        },
        {
            data: 'label_name',
            name: 'sr.label_name',
        },
        {
            data: 'gross_revenue',
            name: 'gross_revenue',
            searchable: false,
        },
        {
            data: 'net_revenue',
            name: 'net_revenue',
            searchable: false,
        },
        {
            data: 'partner_revenue',
            name: 'partner_revenue',
            searchable: false,
        },
        {
            data: 'user',
            name: 'user',
            orderable: false,
            searchable: false,
        },
        {
            data: 'user',
            name: 'user',
            orderable: false,
            searchable: false,
        },
        {
            data: 'user',
            name: 'user',
            orderable: false,
            searchable: false,
        },
        {
            data: 'user',
            name: 'user',
            orderable: false,
            searchable: false,
        },
        {
            data: 'user',
            name: 'user',
            orderable: false,
            searchable: false,
        },
        {
            data: 'user',
            name: 'user',
            orderable: false,
            searchable: false,
        },
        {
            data: 'user',
            name: 'user',
            orderable: false,
            searchable: false,
        },
        {
            data: 'user',
            name: 'user',
            orderable: false,
            searchable: false,
        },
        {
            data: 'user',
            name: 'user',
            orderable: false,
            searchable: false,
        },
        {
            data: 'user',
            name: 'user',
            orderable: false,
            searchable: false,
        },
        {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false,
        }
    ],
    "language": {
        "paginate": {
            "previous": "<i class='uil uil-angle-left'>",
            "next": "<i class='uil uil-angle-right'>"
        }
    },
    "drawCallback": function drawCallback() {
        var sumGross = this.api().ajax.json().gross_revenue;
        var sumNet = this.api().ajax.json().net_revenue;
        var sumPartner = this.api().ajax.json().partner_revenue;

        $('#grossTotalSum').html(sumGross.toFixed(2));
        $('#netTotalSum').html(sumNet.toFixed(2));
        $('#PartnerTotalSum').html(sumPartner.toFixed(2));

        $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
    }
});

$("#btnfilter").click(function() {
    // alert("test filter");
    table.draw();
});
</script>


@endpush