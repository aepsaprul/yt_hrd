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
                    <h1>Karyawan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Karyawan</li>
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
                                <button id="btn-create" type="button" class="btn bg-gradient-primary btn-sm pl-3 pr-3">
                                    <i class="fas fa-plus"></i> Tambah
                                </button>
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center text-indigo">No</th>
                                        <th class="text-center text-indigo">Nama</th>
                                        <th class="text-center text-indigo">Foto</th>
                                        <th class="text-center text-indigo">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($karyawans as $key => $item)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td>{{ $item->nama_lengkap }}</td>
                                            <td>{{ $item->foto }}</td>
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
                                                            class="dropdown-item border-bottom btn-edit"
                                                            data-id="{{ $item->id }}">
                                                                <i class="fas fa-pencil-alt pr-1"></i> Ubah
                                                        </a>
                                                        <a
                                                            href="#"
                                                            class="dropdown-item btn-delete"
                                                            data-id="{{ $item->id }}">
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
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Modal -->
<div class="modal fade" id="modalKaryawan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form id="formKaryawan" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile pb-3">
                                    <div class="text-center profile_img">
                                        <img
                                            class="profile-user-img img-fluid img-circle"
                                            src="{{ asset('assets/user.jpg') }}"
                                            alt="User profile picture">
                                    </div>
                                    <div class="form-group">
                                        <label for="foto">Foto</label>
                                        <input type="file" id="foto" name="foto" class="form-control form-control-sm" >
                                        <small id="errorFoto" class="form-text text-danger"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="nik">NIK</label>
                                        <input type="text" id="nik" name="nik" class="form-control form-control-sm" value="{{ date('ymdhis') }}" maxlength="12" >
                                        <small id="errorNik" class="form-text text-danger"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="telepon">Telepon</label>
                                        <input type="text" id="telepon" name="telepon" class="form-control form-control-sm" maxlength="15" >
                                        <small id="errorTelepon" class="form-text text-danger"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" name="email" class="form-control form-control-sm" maxlength="50" >
                                        <small id="errorEmail" class="form-text text-danger"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="card card-primary card-outline pb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="nama_lengkap">Nama Lengkap</label>
                                                <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control form-control-sm" maxlength="30" >
                                                <small id="errorNamaLengkap" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="nama_panggilan">Nama Panggilan</label>
                                                <input type="text" id="nama_panggilan" name="nama_panggilan" class="form-control form-control-sm" maxlength="15" >
                                                <small id="errorNamaPanggilan" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="nomor_ktp">Nomor KTP</label>
                                                <input type="number" id="nomor_ktp" name="nomor_ktp" class="form-control form-control-sm" maxlength="16" >
                                                <small id="errorNomorKtp" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="status_ktp">Status KTP</label>
                                                <input type="text" id="status_ktp" name="status_ktp" class="form-control form-control-sm" maxlength="30" >
                                                <small id="errorStatusKtp" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="tempat_lahir">Tempat Lahir</label>
                                                <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control form-control-sm" maxlength="30" >
                                                <small id="errorTempatLahir" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                                <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control form-control-sm" >
                                                <small id="errorTanggalLahir" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="agama">Agama</label>
                                                <select name="agama" id="agama" class="form-control form-control-sm">
                                                    <option value="islam">Islam</option>
                                                    <option value="kristen_protestan">Kristen Protestan</option>
                                                    <option value="katholik">Katholik</option>
                                                    <option value="hindu">Hindu</option>
                                                    <option value="budha">Budha</option>
                                                    <option value="kong_hu_cu">Kong Hu Cu</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="gender">Gender</label>
                                                <select name="gender" id="gender" class="form-control form-control-sm">
                                                    <option value="l">L (Laki - laki)</option>
                                                    <option value="p">P (Perempuan)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="alamat_asal">Alamat Asal</label>
                                                <input type="text" id="alamat_asal" name="alamat_asal" class="form-control form-control-sm" >
                                                <small id="errorAlamatAsal" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="alamat_domisili">Alamat Domisili</label>
                                                <input type="text" id="alamat_domisili" name="alamat_domisili" class="form-control form-control-sm" >
                                                <small id="errorAlamatDomisili" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="sim">Jenis & Nomor SIM</label>
                                                <div class="row">
                                                    <div class="col-md-4 col-sm-4 col-4">
                                                        <input type="text" id="jenis_sim" name="jenis_sim" class="form-control form-control-sm" maxlength="10" >
                                                        <small id="errorJenisSim" class="form-text text-danger"></small>
                                                    </div>
                                                    <div class="col-md-8 col-sm-8 col-8">
                                                        <input type="text" id="nomor_sim" name="nomor_sim" class="form-control form-control-sm" maxlength="15" >
                                                        <small id="errorNomorSim" class="form-text text-danger"></small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="cabang_id">Cabang</label>
                                                <select name="cabang_id" id="cabang_id" class="form-control form-control-sm">

                                                </select>
                                                <small id="errorCabangId" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="jabatan_id">Jabatan</label>
                                                <select name="jabatan_id" id="jabatan_id" class="form-control form-control-sm">

                                                </select>
                                                <small id="errorJabatanId" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="tanggal_masuk">Tanggal Masuk</label>
                                                <input type="date" id="tanggal_masuk" name="tanggal_masuk" class="form-control form-control-sm" >
                                                <small id="errorTanggalMasuk" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" style="width: 130px;">
                        <i class="fas fa-times"></i> Tutup
                    </button>
                    <button class="btn btn-primary btn-spinner d-none" disabled style="width: 130px;">
                        <span class="spinner-grow spinner-grow-sm"></span>
                        Loading...
                    </button>
                    <button type="submit" class="btn btn-primary btn-save" style="width: 130px;">
                        <i class="fas fa-save"></i> Simpan
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
        $('input[type="file"][name="foto"]').on('change', function() {
            var img_path = $(this)[0].value;
            var img_holder = $('.profile_img');
            var currentImagePath = $(this).data('value');
            var extension = img_path.substring(img_path.lastIndexOf('.')+1).toLowerCase();
            if (extension == 'jpg' || extension == 'jpeg' || extension == 'png') {
                if (typeof(FileReader) != 'undefind') {
                    img_holder.empty();
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('<img/>', {'src':e.target.result, 'class':'profile-user-img img-fluid img-circle'}).appendTo(img_holder);
                    }
                    img_holder.show();
                    reader.readAsDataURL($(this)[0].files[0]);
                } else {
                    $(img_holder).html('Browser tidak support FileReader');
                }
            } else {
                $(img_holder).html(currentImagePath);
            }
        });

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
                url: '{{ URL::route('karyawan.create') }}',
                type: "GET",
                success: function (response) {
                    var value_jabatan = "<option value=\"\">--Pilih Jabatan--</option>";
                    $.each(response.jabatans, function (index, value) {
                         value_jabatan += "<option value=\"" + value.id + "\">" + value.nama + "</option>";
                    });
                    $('#jabatan_id').append(value_jabatan);

                    var value_cabang = "<option value=\"\">--Pilih Cabang--</option>";
                    $.each(response.cabangs, function (index, value) {
                         value_cabang += "<option value=\"" + value.id + "\">" + value.nama + "</option>";
                    });
                    $('#cabang_id').append(value_cabang);

                    $('#modalKaryawan').modal('show');
                }
            });
        });

        $(document).on('shown.bs.modal', '#modalKaryawan', function() {
            $('#nama_lengkap').focus();
        });

        $(document).on('submit', '#formKaryawan', function (e) {
            e.preventDefault();

            $('#errorNik').empty();
            $('#errorTelepon').empty();
            $('#errorEmail').empty();
            $('#errorNamaLengkap').empty();
            $('#errorNamaPanggilan').empty();
            $('#errorNomorKtp').empty();
            $('#errorStatusKtp').empty();
            $('#errorTempatLahir').empty();
            $('#errorTanggalLahir').empty();
            $('#errorAgama').empty();
            $('#errorGender').empty();
            $('#errorAlamatAsal').empty();
            $('#errorAlamatDomisili').empty();
            $('#errorJenisSim').empty();
            $('#errorNomorSim').empty();
            $('#errorCabangId').empty();
            $('#errorJabatanId').empty();
            $('#errorTanggalMasuk').empty();
            $('#errorFoto').empty();

            let formData = new FormData($('#formKaryawan')[0]);

            $.ajax({
                type: "POST",
                url: "{{ URL::route('karyawan.store') }}",
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('.btn-spinner').removeClass('d-none');
                    $('.btn-save').addClass('d-none');
                },
                success: function (response) {
                    if (response.status == 400) {
                        $('#errorNik').append(response.errors.nik);
                        $('#errorTelepon').append(response.errors.telepon);
                        $('#errorEmail').append(response.errors.email);
                        $('#errorNamaLengkap').append(response.errors.nama_lengkap);
                        $('#errorNamaPanggilan').append(response.errors.nama_panggilan);
                        $('#errorNomorKtp').append(response.errors.nomor_ktp);
                        $('#errorStatusKtp').append(response.errors.status_ktp);
                        $('#errorTempatLahir').append(response.errors.tempat_lahir);
                        $('#errorTanggalLahir').append(response.errors.tanggal_lahir);
                        $('#errorAgama').append(response.errors.agama);
                        $('#errorGender').append(response.errors.gender);
                        $('#errorAlamatAsal').append(response.errors.alamat_asal);
                        $('#errorAlamatDomisili').append(response.errors.alamat_domisili);
                        $('#errorJenisSim').append(response.errors.jenis_sim);
                        $('#errorNomorSim').append(response.errors.nomor_sim);
                        $('#errorCabangId').append(response.errors.cabang_id);
                        $('#errorJabatanId').append(response.errors.jabatan_id);
                        $('#errorTanggalMasuk').append(response.errors.tanggal_masuk);
                        $('#errorFoto').append(response.errors.foto);
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
                    var errorMessage = xhr.status + ': ' + statusText

                    Toast.fire({
                        icon: 'danger',
                        title: 'Error - ' + errorMessage
                    });
                }
            });
        });
    });
</script>

@endsection
