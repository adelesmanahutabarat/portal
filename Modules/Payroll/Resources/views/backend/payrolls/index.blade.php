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
                {{ $module_title }} Management
                </div>
            </div>

            <div class="col-6 col-sm-4">
                <div class="float-right">
                    <x-buttons.create route='{{ route("backend.$module_name.create") }}' id='{{"btncreate"}}' title="{{__('Create')}} {{ ucwords(Str::singular($module_name)) }}"/>
                </div>
            </div>
            <!--/.col-->
        </div>
        <!--/.row-->

        <!-- <div class="row mt-4">
            <div class="col">
                <div>
                    <label for="">Periode Payroll</label>
                    <form id="frm-filter" class="form-inline" action="#">
                        <div class="form-group mb-2 ">
                            <label class="sr-only">Period</label>
                            <select class="form-control" name="date_period" id="date_period">
                                @foreach($payrolls as $item)
                                <option value="{{ $item->date_period }}">{{ $item->date_period }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="button" id="btnfilter" class="btn btn-primary mb-2 mx-3"><i
                                class="fa fa-sync"></i> Filter</button>
                    </form>
                </div>
            </div>
            <div class="ml-auto mr-3 text-right">
            </div>
        </div> -->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table id="datatable" class="table table-hover  ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date Period</th>
                                <th>Total</th>
                                <th>Created By</th>
                                <th>Created At</th>
                                <th class="text-right">{{ __('labels.backend.action') }}</th>
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
        if(!confirm("Yakin Ingin Menghapus Label Ini?"))
            event.preventDefault();
    }
</script>

<!-- DataTables Core and Extensions -->
<script type="text/javascript">
$('#datatable').DataTable({
    processing: true,
    serverSide: true,
    autoWidth: true,
    responsive: false,
    ajax: '{{ route("backend.$module_name.index_list") }}',
    columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex',
            orderable: false,
            searchable: false
        },
        {
            data: 'date_period',
            name: 'date_period'
        },
        {
            data: 'total',
            name: 'total',
            render: $.fn.dataTable.render.number('', '.', 2, ''),
        },
        {
            data: 'name',
            name: 'u.name'
        },
        {
            data: 'created_at',
            name: 'created_at'
        }, 
        {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false
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

$(document).on('ajaxComplete ready', function () {
    $('.modalMd').off('click').on('click', function () {
        $('#form-pencipta').load($(this).attr('value'));
    });
});

</script>


@endpush