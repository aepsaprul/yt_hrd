@extends('layouts.app')

@section('style')

<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('themes/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('themes/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('themes/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pengajuan Cuti</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Pengajuan Cuti</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <button type="button" id="btn-create" class="btn bg-gradient-primary btn-sm pl-3 pr-3">
                                    <i class="fas fa-plus"></i> Tambah
                                </button>
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped" style="font-size: 13px;">
                                <thead>
                                    <tr>
                                        <th class="text-center text-indigo">No</th>
                                        <th class="text-center text-indigo">Alasan Cuti</th>
                                        <th class="text-center text-indigo">Tanggal Mulai</th>
                                        <th class="text-center text-indigo">Tanggal Selesai</th>
                                        <th class="text-center text-indigo">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cutis as $key => $item)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td>{{ $item->alasan }}</td>
                                            <td class="text-center">{{ $item->tanggal_mulai }}</td>
                                            <td class="text-center">{{ $item->tanggal_selesai }}</td>
                                            <td>
                                                @if ($item->approved_percentage > 100)
                                                    @php
                                                        $percent = 100;
                                                    @endphp
                                                @else
                                                    @php
                                                        $percent = $item->approved_percentage
                                                    @endphp
                                                @endif
                                                <div class="progress">
                                                    <div
                                                        class="progress-bar bg-{{ $item->approved_background }}"
                                                        role="progressbar"
                                                        aria-valuenow="40"
                                                        aria-valuemin="0"
                                                        aria-valuemax="100"
                                                        style="width: {{ $percent }}%;">
                                                            <span class="">{{ $percent }}%</span>
                                                    </div>
                                                </div>
                                                <span style="font-size: 14px;">
                                                    {{ $item->approved_text }} {{ $item->approvedLeader ? $item->approvedLeader->nama_panggilan : "" }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade modal-form" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title">Form Pengajuan Cuti</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="hidden" name="karyawan_id" id="karyawan_id">
                        <input type="text" class="form-control" id="nama" name="nama" maxlength="30" required readonly>
                        <small id="error_nama" class="form-text text-danger"></small>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" required>
                        <small id="error_tanggal_mulai" class="form-text text-danger"></small>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                        <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" required>
                        <small id="error_tanggal_selesai" class="form-text text-danger"></small>
                    </div>
                    <div class="mb-3">
                        <label for="alasan" class="form-label">Alasan</label>
                        <textarea name="alasan" id="alasan" class="form-control" cols="30" rows="3"></textarea>
                        <small id="error_alasan" class="form-text text-danger"></small>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button class="btn btn-primary btn-spinner d-none" disabled style="width: 130px;">
                        <span class="spinner-grow spinner-grow-sm"></span>
                        Loading...
                    </button>
                    <button type="submit" class="btn btn-primary btn-save" style="width: 130px;">
                        <i class="fas fa-paper-plane"></i> Kirim
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('script')

<!-- DataTables  & Plugins -->
<script src="{{ asset('themes/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('themes/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('themes/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('themes/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('themes/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('themes/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('themes/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('themes/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('themes/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('themes/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('themes/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('themes/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<script>
    $(function () {
        $("#example1").DataTable();
    });
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        $('#btn-create').on('click', function() {
            $.ajax({
                url: "{{ URL::route('pengajuan_cuti.create') }}",
                type: 'GET',
                success: function(response) {
                    $('#nama').val(response.karyawan.nama_lengkap);
                    $('#karyawan_id').val(response.karyawan.id);

                    $('.modal-form').modal('show');
                }
            });
        });

        $(document).on('shown.bs.modal', '.modal-form', function() {
            $('#nama').focus();
        });

        $(document).on('submit', '#form', function (e) {
            e.preventDefault();

            $('#error_nama').empty();
            $('#error_tanggal_mulai').empty();
            $('#error_tanggal_selesai').empty();
            $('#error_alasan').empty();

            var formData = new FormData($('#form')[0]);

            $.ajax({
                url: "{{ URL::route('pengajuan_cuti.store') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('.btn-spinner').removeClass('d-none');
                    $('.btn-save').addClass('d-none');
                },
                success: function (response) {
                    if (response.status == 400) {
                        $('#error_nama').append(response.errors.nama);
                        $('#error_tanggal_mulai').append(response.errors.tanggal_mulai);
                        $('#error_tanggal_selesai').append(response.errors.tanggal_selesai);
                        $('#error_alasan').append(response.errors.alasan);

                        $('.btn-spinner').addClass('d-none');
                        $('.btn-save').removeClass('d-none');
                    } else {
                        Toast.fire({
                            icon: 'success',
                            title: 'Data behasil ditambah'
                        });

                        setTimeout(() => {
                            window.location.reload(1);
                        }, 1000);
                    }
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.status + ': ' + error

                    Toast.fire({
                        icon: 'error',
                        title: 'Error - ' + errorMessage
                    });
                    setTimeout(() => {
                        $('.btn-spinner').addClass('d-none');
                        $('.btn-save').removeClass('d-none');
                    }, 1000);
                }
            });
        });
    });
</script>

@endsection
