@extends('layouts.app')

@section('title', 'Perlombaan')

@section('content')
    <section class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="header-title">
                                <h3 class="card-title">Data Perlombaan</h3>
                                <a href="javascript:void(0)" class="btn btn-primary" onclick="tambahPerlombaan()"> <i
                                        class="fas fa-plus"></i>&nbsp;
                                    Tambah Perlombaan</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="tb_perlombaan" class="table table-hover scroll-horizontal-vertical w-100">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Perlombaan</th>
                                            <th>Tanggal Pelaksanaan</th>
                                            <th>Pendaftaran Ditutup</th>
                                            <th>Kategori Perlombaan</th>
                                            <th>Aksi</th>
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
    </section>
    @include('pages.admin.perlombaan.modal-perlombaan')
    @include('pages.admin.perlombaan.modal-show-perlombaan')
@endsection

@push('after-scripts')
    <script>
        // tambah perlombaan
        function tambahPerlombaan() {
            $('#tambahPerlombaanModal').modal('show');
            $('#form-tambah-perlombaan').trigger('reset');
            $('.modal-title').text('Tambah Perlombaan');
            $('#btnSimpanPerlombaan').html('Simpan');
            $('#id_perlombaan').val('');
        }

        function btnUpdatePerlombaan(id) {
            $('#tambahPerlombaanModal').modal('show');
            $('.modal-title').text('Update Perlombaan');
            $('#id_perlombaan').val(id);

            $.ajax({
                type: 'POST',
                url: "{{ url('/pages/admin/update/perlombaan') }}",
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                dataType: 'json',
                success: (res) => {
                    $('#nama_perlombaan').val(res.nama_perlombaan);
                    $('#tanggal_pendaftaran_dibuka').val(moment(res.tanggal_pendaftaran_dibuka).format(
                        'YYYY-MM-DD'));
                    $('#tanggal_pendaftaran_ditutup').val(moment(res.tanggal_pendaftaran_ditutup).format(
                        'YYYY-MM-DD'));
                    $('#tempat_pelaksanaan').val(res.tempat_pelaksanaan);
                    $('#kategori_perlombaan').val(res.kategori_perlombaan);
                    $('#deskripsi_perlombaan').val(res.deskripsi_perlombaan);
                },
            });
        }

        // function btnShowPerlombaan(id) {
        //     $('#showPerlombaanModal').modal('show');
        //     $('.modal-title').text('Detail Perlombaan');
        //     $('#id_perlombaan').val(id);

        //     $.ajax({
        //         type: 'POST',
        //         url: "{{ url('/pages/admin/show/perlombaan') }}",
        //         data: {
        //             id: id,
        //             _token: "{{ csrf_token() }}"
        //         },
        //         dataType: 'json',
        //         success: (res) => {
        //             $('#show_nama_perlombaan').val(res.nama_perlombaan);
        //             $('#show_tanggal_pendaftaran_dibuka').val(moment(res.tanggal_pendaftaran_dibuka).format(
        //                 'YYYY-MM-DD'));
        //             $('#show_tanggal_pendaftaran_ditutup').val(moment(res.tanggal_pendaftaran_ditutup).format(
        //                 'YYYY-MM-DD'));
        //             $('#show_tanggal_pelaksanaan').val(moment(res.tanggal_pelaksanaan).format('YYYY-MM-DD'));
        //             $('#show_tempat_pelaksanaan').val(res.tempat_pelaksanaan);
        //             $('#show_kategori_perlombaan').val(res.kategori_perlombaan);
        //             $('#show_deskripsi_perlombaan').val(res.deskripsi_perlombaan);
        //             $('#show_tanggal').val(moment(res.tanggal).format('YYYY-MM-DD'));
        //         },
        //     });
        // }

        function btnDeletePerlombaan(id) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: "{{ url('/pages/admin/hapus/perlombaan') }}",
                        data: {
                            id: id,
                            _token: "{{ csrf_token() }}"
                        },
                        dataType: 'json',
                        success: (res) => {
                            Swal.fire(
                                'Berhasil!',
                                'Data berhasil dihapus.',
                                'success'
                            )
                            $('#tb_perlombaan').DataTable().ajax.reload();
                        },
                        error: (err) => {
                            Swal.fire(
                                'Gagal!',
                                'Data gagal dihapus.',
                                'error'
                            )
                        }
                    });
                }
            })
        }

        $('#form-tambah-perlombaan').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: "{{ url('/pages/admin/tambah/perlombaan') }}",
                data: formData,
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $(".preloader").fadeIn();
                    $('#btnSimpanPerlombaan').html('<i class="fa fa-spin fa-spinner"></i> Processing');
                    $('#btnSimpanPerlombaan').attr('disabled', true);
                },
                success: function(res) {
                    if (res.status == true) {
                        $('#btnSimpanPerlombaan').attr('disabled', false);
                        $("#tb_perlombaan").DataTable().ajax.reload();
                        $('#tambahPerlombaanModal').modal('hide');
                        Swal.fire(
                            'Berhasil!',
                            res.message,
                            'success'
                        );
                    } else {
                        $('#btnSimpanPerlombaan').attr('disabled', false);
                        $('#btnSimpanPerlombaan').html('Simpan');
                        
                        failedNotifikasi(res.message);
                    }
                },
                error: function(res) {
                    $('#btnSimpanPerlombaan').attr('disabled', false);
                    $('#btnSimpanPerlombaan').html('Simpan');

                    failedNotifikasi(res.responseJSON.message)
                },
                complete: function() {
                    $(".preloader").fadeOut();
                    $('#btnSimpanPerlombaan').attr('disabled', false);
                    $('#btnSimpanPerlombaan').html('Simpan');
                }
            })
        });

        $('#tb_perlombaan').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            dom: 'lBfrtip',
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            buttons: [{
                    extend: 'copy',
                    text: 'Copy',
                    className: 'btn btn-primary',
                    exportOptions: {
                        columns: [1, 2, 3, 4]
                    }
                },
                {
                    extend: 'csv',
                    text: 'CSV',
                    className: 'btn btn-primary',
                    exportOptions: {
                        columns: [1, 2, 3, 4]
                    }
                },
                {
                    extend: 'excel',
                    text: 'Excel',
                    className: 'btn btn-primary',
                    exportOptions: {
                        columns: [1, 2, 3, 4]
                    }
                },
                {
                    extend: 'pdf',
                    text: 'PDF',
                    className: 'btn btn-primary',
                    exportOptions: {
                        columns: [1, 2, 3, 4]
                    }
                },
                {
                    extend: 'print',
                    text: 'Print',
                    className: 'btn btn-primary',
                    exportOptions: {
                        columns: [1, 2, 3, 4]
                    }
                }
            ],
            ordering: [
                [1, 'asc']
            ],
            ajax: {
                url: "{{ route('perlombaan-admin.index') }}",
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'id'
                },
                {
                    data: 'nama_perlombaan',
                    name: 'nama_perlombaan'
                },
                {
                    data: 'tanggal_pendaftaran_dibuka',
                    name: 'tanggal_pendaftaran_dibuka'
                },
                {
                    data: 'tanggal_pendaftaran_ditutup',
                    name: 'tanggal_pendaftaran_ditutup'
                },
                {
                    data: 'kategori_perlombaan',
                    name: 'kategori_perlombaan'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
        });
    </script>
@endpush
