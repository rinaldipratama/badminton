@extends('layouts.components')

@section('title', 'Wasit')

@section('content')
<div class="container" style="padding-top: 100px">
    <div class="row">
        <div class="col-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-black"><b>Daftar Wasit</b></h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tb_wasit" class="table table-hover scroll-horizontal-vertical w-100">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Email</th>
                                    <th>Nama</th>
                                    <th>Nomor HP</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('after-scripts')
<script>
    $('#tb_wasit').DataTable({
        processing: true,
        serverSide: true,
        ordering: [[1, 'asc']],
        ajax: {
            url: "{{ url('/wasit') }}",
        },
        columns: [
            { data: 'DT_RowIndex', name: 'id' },
            { data: 'email', name: 'email' },
            { data: 'name', name: 'name' },
            { data: 'phone', name: 'phone' },
        ],
    });
</script>
@endpush