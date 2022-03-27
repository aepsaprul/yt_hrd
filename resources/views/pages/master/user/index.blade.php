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
                    <h1>Data User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data User</li>
                    </ol>
                </div>
            </div>
        </div>
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
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center text-indigo">No</th>
                                        <th class="text-center text-indigo">Nama</th>
                                        <th class="text-center text-indigo">Email</th>
                                        <th class="text-center text-indigo">Jabatan</th>
                                        <th class="text-center text-indigo">Role</th>
                                        <th class="text-center text-indigo">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $key => $item)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td>{{ $item->karyawan->nama_lengkap }}</td>
                                            <td>{{ $item->karyawan->email }}</td>
                                            <td>{{ $item->karyawan->jabatan->nama }}</td>
                                            <td>{{ $item->karyawan->role->nama }}</td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a
                                                        href="#"
                                                        class="dropdown-toggle btn bg-gradient-primary btn-sm"
                                                        data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false">
                                                            <i class="fas fa-cog"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a
                                                            href="#"
                                                            class="dropdown-item border-bottom btn-access"
                                                            data-id="{{ $item->karyawan->id }}">
                                                                <i class="fas fa-pencil-alt pr-1"></i> Access
                                                        </a>
                                                        <a
                                                            href="#"
                                                            class="dropdown-item btn-delete"
                                                            data-id="{{ $item->karyawan->id }}">
                                                                <i class="fas fa-minus-circle pr-1"></i> Hapus
                                                        </a>
                                                    </div>
                                                </div>
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

{{-- create --}}
<div class="modal fade modal-form" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form" class="form-create">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="karyawan_id" class="form-label">Nama Karyawan</label>
                        <select name="karyawan_id" id="karyawan_id" class="form-control" required>

                        </select>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button class="btn btn-primary btn-spinner d-none" disabled style="width: 130px;">
                        <span class="spinner-grow spinner-grow-sm"></span>
                        Loading...
                    </button>
                    <button type="submit" class="btn btn-primary btn-save" style="width: 130px;">
                        <i class="fas fa-save"></i> <span class="modal-btn"> Simpan </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- access --}}
<div class="modal fade modal-access" id="modal-default">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <table id="datatable" class="table table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center text-indigo">Main</th>
                                <th class="text-center text-indigo">Sub</th>
                                <th class="text-center text-indigo">Index</th>
                            </tr>
                        </thead>
                        <tbody id="data-access">
                            {{-- @foreach ($subs as $key => $item)
                                <tr>
                                    <td rowspan="{{ $item->total }}">{{ $item->navMain->title }}</td>
                                    @foreach ($menus as $item_menu)
                                        @if ($item_menu->main_id == $item->main_id)
                                                <td>
                                                    @if ($item_menu->navSub->link != '#')
                                                        {{ $item_menu->navSub->title }}
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="index[]" id="index_{{ $item_menu->id }}" data-id="{{ $item_menu->id }}" value="{{ $item_menu->tampil }}" {{ $item_menu->tampil == "y" ? 'checked' : '' }}>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button class="btn btn-primary btn-spinner d-none" disabled style="width: 130px;">
                    <span class="spinner-grow spinner-grow-sm"></span>
                    Loading...
                </button>
                <button type="submit" class="btn btn-primary btn-save" style="width: 130px;">
                    <i class="fas fa-save"></i> <span class="modal-btn"> Simpan </span>
                </button>
            </div>
        </div>
    </div>
</div>

{{-- modal delete --}}
<div class="modal fade modal-delete" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form-delete">
                <input type="hidden" id="delete_id" name="delete_id">
                <div class="modal-header">
                    <h5 class="modal-title">Yakin akan dihapus?</h5>
                </div>
                <div class="modal-footer justify-content-between">
                    <button class="btn btn-danger" type="button" data-dismiss="modal" style="width: 130px;"><span aria-hidden="true">Tidak</span></button>
                    <button class="btn btn-primary btn-delete-spinner" disabled style="width: 130px; display: none;">
                        <span class="spinner-grow spinner-grow-sm"></span>
                        Loading...
                    </button>
                    <button type="submit" class="btn btn-primary btn-delete-yes text-center" style="width: 130px;">
                        Ya
                    </button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
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
                url: "{{ URL::route('user.create') }}",
                type: 'GET',
                success: function (response) {
                    console.log(response);
                    let val_karyawan = "<option value=\"\">--Pilih Karyawan--</option>";
                    $.each(response.karyawans, function (index, value) {
                        val_karyawan += "<option value=\"" + value.id + "\">" + value.nama_lengkap + "</option>"
                    });
                    $('#karyawan_id').append(val_karyawan);

                    $('.modal-form').modal('show');
                }
            });
        });

        $(document).on('shown.bs.modal', '.modal-form', function() {
            $('#nama').focus();
        });

        $(document).on('submit', '.form-create', function (e) {
            e.preventDefault();

            var formData = new FormData($('#form')[0]);

            $.ajax({
                url: '{{ URL::route('user.store') }}',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('.btn-spinner').removeClass('d-none');
                    $('.btn-save').addClass('d-none');
                },
                success: function (response) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Data behasil ditambah'
                    });

                    setTimeout(() => {
                        window.location.reload(1);
                    }, 1000);
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.status + ': ' + error

                    Toast.fire({
                        icon: 'danger',
                        title: 'Error - ' + errorMessage
                    });
                }
            });
        });

        // access
        $(document).on('click', '.btn-access', function (e) {
            e.preventDefault();
            $('.modal-title').empty();
            $('#data-access').empty();

            var id = $(this).attr('data-id');
            var url = '{{ route("user.access", ":id") }}';
            url = url.replace(':id', id);

            var formData = {
                id: id
            }

            $.ajax({
                url: url,
                type: 'GET',
                data: formData,
                success: function (response) {
                    let val_title = "";
                    if (response.syncs.length != 0) {
                        val_title += response.karyawan.nama_lengkap +
                            " <button class=\"btn btn-success btn-sm btn-sync-spinner\" disabled style=\"width: 120px; display: none;\">" +
                                "<span class=\"spinner-grow spinner-grow-sm\"></span>" +
                                "Loading.." +
                            "</button>" +
                            "<button class=\"btn btn-success btn-sm btn-sync\" data-id=\"" + response.karyawan.id + "\" style=\"width: 120px\"><i class=\"fas fa-sync-alt\"></i> Sync</button>";

                    } else {
                        val_title += response.karyawan.nama_lengkap;
                    }
                    $('.modal-title').append(val_title);

                    let val_subs = "";
                    $.each(response.subs, function (index, value) {
                        val_subs += "" +
                            "<tr>" +
                                "<td rowspan=\"" + value.total + "\">" + value.nav_main.title + "</td>";
                                $.each(response.menus, function (index_menu, value_menu) {
                                    if (value_menu.main_id == value.main_id) {
                                        val_subs += "<td>";
                                            if (value_menu.nav_sub.link != '#') {
                                                val_subs += value_menu.nav_sub.title
                                            }
                                        val_subs += "</td>" +
                                            "<td class=\"text-center\">" +
                                                "<input type=\"checkbox\" name=\"index[]\" id=\"index_" + value_menu.id + "\" data-id=\"" + value_menu.id + "\" value=\"" + value_menu.tampil + "\" " + (value_menu.tampil == 'y' ? 'checked' : '') + ">" +
                                            "</td>" +
                                        "</tr>";
                                    }
                                });
                    });
                    $('#data-access').append(val_subs);

                    $('.modal-access').modal('show');
                }
            });
        });

        // change access
        $(document).on('change', 'input[name="index[]"]', function() {
            var id = $(this).attr('data-id');
            var formData;

            var id = $(this).attr('data-id');
            var url = '{{ route("user.access_save", ":id") }}';
            url = url.replace(':id', id );

            if($('#index_' + id).is(":checked")) {
                formData = {
                    id: id,
                    show: "y"
                }
            } else {
                formData = {
                    id: id,
                    show: "n"
                }
            }

            $.ajax({
                url: url,
                type: 'PUT',
                data: formData,
                success: function(response) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Data berhasil disimpan.'
                    });
                }
            });
        });

        // sync
        $(document).on('click', '.btn-sync', function() {
            var formData = {
                id: $(this).attr('data-id')
            }

            $.ajax({
                url: "{{ URL::route('user.sync') }}",
                type: 'POST',
                data: formData,
                beforeSend: function() {
                    $('.btn-sync-spinner').css("display", "inline-block");
                    $('.btn-sync').css("display", "none");
                },
                success: function(response) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Data berhasil sinkron.'
                    });

                    setTimeout(() => {
                        window.location.reload(1);
                    }, 1000);
                },
                error: function(xhr, status, error){
                    var errorMessage = xhr.status + ': ' + xhr.statusText
                    Toast.fire({
                        icon: 'danger',
                        title: 'Error - ' + errorMessage
                    });
                }
            });
        });

        // delete
        $('body').on('click', '.btn-delete', function (e) {
            e.preventDefault();

            let id = $(this).attr('data-id');
            $('#delete_id').val(id);
            $('.modal-delete').modal('show');
        });

        $('#form-delete').submit(function (e) {
            e.preventDefault();

            var formData = {
                id: $('#delete_id').val()
            }

            $.ajax({
                url: '{{ URL::route('user.delete') }}',
                type: 'POST',
                data: formData,
                beforeSend: function () {
                    $('.btn-delete-spinner').css('display', 'block');
                    $('.btn-delete-yes').css('display', 'none');
                },
                success: function (response) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Data berhasil dihapus'
                    });

                    setTimeout( () => {
                        window.location.reload(1);
                    }, 1000);
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.status + ': ' + error

                    Toast.fire({
                        icon: 'error',
                        title: 'Error - ' + errorMessage
                    });
                }
            });
        });
    });
</script>

@endsection
