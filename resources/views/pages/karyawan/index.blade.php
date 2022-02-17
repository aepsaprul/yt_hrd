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
                                <button id="btn-create" type="button" class="btn bg-gradient-primary btn-sm pl-3 pr-3">
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
                                        <th class="text-center text-indigo">Telepon</th>
                                        <th class="text-center text-indigo">Email</th>
                                        <th class="text-center text-indigo">Status</th>
                                        <th class="text-center text-indigo">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($karyawans as $key => $item)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td>{{ $item->nama_lengkap }}</td>
                                            <td>{{ $item->telepon }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td class="text-center">
                                                <input
                                                    class="custom-control"
                                                    type="checkbox"
                                                    name="status_karyawan"
                                                    id="status_karyawan_{{ $item->id }}"
                                                    data-id="{{ $item->id }}"
                                                    {{ $item->status_karyawan == "aktif" ? "checked" : "" }}
                                                    data-bootstrap-switch>
                                            </td>
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
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- /.content-wrapper -->

<!-- Modal create -->
<div class="modal fade modal-create" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form id="form-create" method="post" enctype="multipart/form-data">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile pb-3">
                                    <div class="text-center profile_img create_profile_img">
                                        <img
                                            class="profile-user-img img-fluid img-circle"
                                            src="{{ asset('assets/user.jpg') }}"
                                            alt="User profile picture">
                                    </div>
                                    <div class="form-group">
                                        <label for="create_foto">Foto</label>
                                        <input type="file" id="create_foto" name="foto" class="form-control form-control-sm" >
                                        <small id="errorFoto" class="form-text text-danger"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="create_nik">NIK</label>
                                        <input type="text" id="create_nik" name="nik" class="form-control form-control-sm" value="{{ date('ymdhis') }}" maxlength="12" >
                                        <small id="errorNik" class="form-text text-danger"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="create_telepon">Telepon</label>
                                        <input type="text" id="create_telepon" name="telepon" class="form-control form-control-sm" maxlength="15" >
                                        <small id="errorTelepon" class="form-text text-danger"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="create_email">Email</label>
                                        <input type="email" id="create_email" name="email" class="form-control form-control-sm" maxlength="50" >
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
                                                <label for="create_nama_lengkap">Nama Lengkap</label>
                                                <input type="text" id="create_nama_lengkap" name="nama_lengkap" class="form-control form-control-sm" maxlength="30" >
                                                <small id="errorNamaLengkap" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="create_nama_panggilan">Nama Panggilan</label>
                                                <input type="text" id="create_nama_panggilan" name="nama_panggilan" class="form-control form-control-sm" maxlength="15" >
                                                <small id="errorNamaPanggilan" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="create_nomor_ktp">Nomor KTP</label>
                                                <input type="number" id="create_nomor_ktp" name="nomor_ktp" class="form-control form-control-sm" maxlength="16" >
                                                <small id="errorNomorKtp" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="create_status_ktp">Status KTP</label>
                                                <input type="text" id="create_status_ktp" name="status_ktp" class="form-control form-control-sm" maxlength="30" >
                                                <small id="errorStatusKtp" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="create_tempat_lahir">Tempat Lahir</label>
                                                <input type="text" id="create_tempat_lahir" name="tempat_lahir" class="form-control form-control-sm" maxlength="30" >
                                                <small id="errorTempatLahir" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="create_tanggal_lahir">Tanggal Lahir</label>
                                                <input type="date" id="create_tanggal_lahir" name="tanggal_lahir" class="form-control form-control-sm" >
                                                <small id="errorTanggalLahir" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="create_agama">Agama</label>
                                                <select name="agama" id="create_agama" class="form-control form-control-sm">
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
                                                <label for="create_gender">Gender</label>
                                                <select name="gender" id="create_gender" class="form-control form-control-sm">
                                                    <option value="l">L (Laki - laki)</option>
                                                    <option value="p">P (Perempuan)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="create_alamat_asal">Alamat Asal</label>
                                                <input type="text" id="create_alamat_asal" name="alamat_asal" class="form-control form-control-sm" >
                                                <small id="errorAlamatAsal" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="create_alamat_domisili">Alamat Domisili</label>
                                                <input type="text" id="create_alamat_domisili" name="alamat_domisili" class="form-control form-control-sm" >
                                                <small id="errorAlamatDomisili" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="sim">Jenis & Nomor SIM</label>
                                                <div class="row">
                                                    <div class="col-md-4 col-sm-4 col-4">
                                                        <input type="text" id="create_jenis_sim" name="jenis_sim" class="form-control form-control-sm" maxlength="10">
                                                        <small id="errorJenisSim" class="form-text text-danger"></small>
                                                    </div>
                                                    <div class="col-md-8 col-sm-8 col-8">
                                                        <input type="text" id="create_nomor_sim" name="nomor_sim" class="form-control form-control-sm" maxlength="15">
                                                        <small id="errorNomorSim" class="form-text text-danger"></small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="create_cabang_id">Cabang</label>
                                                <select name="cabang_id" id="create_cabang_id" class="form-control form-control-sm" >

                                                </select>
                                                <small id="errorCabangId" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="create_jabatan_id">Jabatan</label>
                                                <select name="jabatan_id" id="create_jabatan_id" class="form-control form-control-sm" >

                                                </select>
                                                <small id="errorJabatanId" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="create_tanggal_masuk">Tanggal Masuk</label>
                                                <input type="date" id="create_tanggal_masuk" name="tanggal_masuk" class="form-control form-control-sm" >
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
                    <button class="btn btn-primary btn-create-spinner d-none" disabled style="width: 130px;">
                        <span class="spinner-grow spinner-grow-sm"></span>
                        Loading...
                    </button>
                    <button type="submit" class="btn btn-primary btn-create-save" style="width: 130px;">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- modal edit --}}
<div class="modal fade modal-edit" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form id="form-edit" method="post" enctype="multipart/form-data">

                <!-- id -->
                <input type="hidden" name="id" id="edit_id">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile pb-3">
                                    <div class="text-center profile_img edit_profile_img">
                                        <img
                                            class="profile-user-img img-fluid img-circle"
                                            src="{{ asset('assets/user.jpg') }}"
                                            alt="User profile picture">
                                    </div>
                                    <div class="form-group">
                                        <label for="edit_foto">Foto</label>
                                        <input type="file" id="edit_foto" name="foto" class="form-control form-control-sm" >
                                        <small id="errorFoto" class="form-text text-danger"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="edit_nik">NIK</label>
                                        <input type="text" id="edit_nik" name="nik" class="form-control form-control-sm" value="{{ date('ymdhis') }}" maxlength="12" >
                                        <small id="errorNik" class="form-text text-danger"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="edit_telepon">Telepon</label>
                                        <input type="text" id="edit_telepon" name="telepon" class="form-control form-control-sm" maxlength="15" >
                                        <small id="errorTelepon" class="form-text text-danger"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="edit_email">Email</label>
                                        <input type="email" id="edit_email" name="email" class="form-control form-control-sm" maxlength="50" >
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
                                                <label for="edit_nama_lengkap">Nama Lengkap</label>
                                                <input type="text" id="edit_nama_lengkap" name="nama_lengkap" class="form-control form-control-sm" maxlength="30" >
                                                <small id="errorNamaLengkap" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="edit_nama_panggilan">Nama Panggilan</label>
                                                <input type="text" id="edit_nama_panggilan" name="nama_panggilan" class="form-control form-control-sm" maxlength="15" >
                                                <small id="errorNamaPanggilan" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="edit_nomor_ktp">Nomor KTP</label>
                                                <input type="number" id="edit_nomor_ktp" name="nomor_ktp" class="form-control form-control-sm" maxlength="16" >
                                                <small id="errorNomorKtp" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="edit_status_ktp">Status KTP</label>
                                                <input type="text" id="edit_status_ktp" name="status_ktp" class="form-control form-control-sm" maxlength="30" >
                                                <small id="errorStatusKtp" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="edit_tempat_lahir">Tempat Lahir</label>
                                                <input type="text" id="edit_tempat_lahir" name="tempat_lahir" class="form-control form-control-sm" maxlength="30" >
                                                <small id="errorTempatLahir" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="edit_tanggal_lahir">Tanggal Lahir</label>
                                                <input type="date" id="edit_tanggal_lahir" name="tanggal_lahir" class="form-control form-control-sm" >
                                                <small id="errorTanggalLahir" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="edit_agama">Agama</label>
                                                <select name="agama" id="edit_agama" class="form-control form-control-sm">

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="edit_gender">Gender</label>
                                                <select name="gender" id="edit_gender" class="form-control form-control-sm">

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="edit_alamat_asal">Alamat Asal</label>
                                                <input type="text" id="edit_alamat_asal" name="alamat_asal" class="form-control form-control-sm" >
                                                <small id="errorAlamatAsal" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="edit_alamat_domisili">Alamat Domisili</label>
                                                <input type="text" id="edit_alamat_domisili" name="alamat_domisili" class="form-control form-control-sm" >
                                                <small id="errorAlamatDomisili" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="sim">Jenis & Nomor SIM</label>
                                                <div class="row">
                                                    <div class="col-md-4 col-sm-4 col-4">
                                                        <input type="text" id="edit_jenis_sim" name="jenis_sim" class="form-control form-control-sm" maxlength="10" >
                                                        <small id="errorJenisSim" class="form-text text-danger"></small>
                                                    </div>
                                                    <div class="col-md-8 col-sm-8 col-8">
                                                        <input type="text" id="edit_nomor_sim" name="nomor_sim" class="form-control form-control-sm" maxlength="15" >
                                                        <small id="errorNomorSim" class="form-text text-danger"></small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="edit_cabang_id">Cabang</label>
                                                <select name="cabang_id" id="edit_cabang_id" class="form-control form-control-sm" >

                                                </select>
                                                <small id="errorCabangId" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="edit_jabatan_id">Jabatan</label>
                                                <select name="jabatan_id" id="edit_jabatan_id" class="form-control form-control-sm" >

                                                </select>
                                                <small id="errorJabatanId" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="edit_tanggal_masuk">Tanggal Masuk</label>
                                                <input type="date" id="edit_tanggal_masuk" name="tanggal_masuk" class="form-control form-control-sm" >
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
                    <button class="btn btn-primary btn-edit-spinner d-none" disabled style="width: 130px;">
                        <span class="spinner-grow spinner-grow-sm"></span>
                        Loading...
                    </button>
                    <button type="submit" class="btn btn-primary btn-edit-save" style="width: 130px;">
                        <i class="fas fa-save"></i> Perbaharui
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- modal delete --}}
<div class="modal fade modal-delete" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form-delete">
                <input type="hidden" id="delete_id" name="id">
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
<!-- Bootstrap Switch -->
<script src="{{ asset('themes/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>

<script>
    $(function () {
        $("#example1").DataTable();

        $("input[data-bootstrap-switch]").each(function(){
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });
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

        // create foto
        $('input[type="file"][name="foto"]').on('change', function() {
            var img_path = $(this)[0].value;
            var img_holder = $('.create_profile_img');
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

        // edit foto
        $('input[type="file"][name="foto"]').on('change', function() {
            var img_path = $(this)[0].value;
            var img_holder = $('.edit_profile_img');
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

        $('input[data-bootstrap-switch]').on('switchChange.bootstrapSwitch', function (e, state) {
            let val_state;
            if (state == true) {
                val_state = "aktif";
            } else {
                val_state = "nonaktif";
            }
            var formData = {
                id: $(this).attr('data-id'),
                status: val_state
            }

            $.ajax({
                type: "post",
                url: "{{ URL::route('karyawan.status') }}",
                data: formData,
                success: function (response) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Status Karyawan berhasil diubah'
                    });
                }
            });
        });

        // create
        $('#btn-create').on('click', function() {
            $.ajax({
                url: "{{ URL::route('karyawan.create') }}",
                type: "GET",
                success: function (response) {
                    var value_jabatan = "<option value=\"\">--Pilih Jabatan--</option>";
                    $.each(response.jabatans, function (index, value) {
                         value_jabatan += "<option value=\"" + value.id + "\">" + value.nama + "</option>";
                    });
                    $('#create_jabatan_id').append(value_jabatan);

                    var value_cabang = "<option value=\"\">--Pilih Cabang--</option>";
                    $.each(response.cabangs, function (index, value) {
                         value_cabang += "<option value=\"" + value.id + "\">" + value.nama + "</option>";
                    });
                    $('#create_cabang_id').append(value_cabang);

                    $('.modal-create').modal('show');
                }
            });
        });

        $(document).on('shown.bs.modal', '#modal-create', function() {
            $('#nama_lengkap').focus();
        });

        $(document).on('submit', '#form-create', function (e) {
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

            let formData = new FormData($('#form-create')[0]);

            $.ajax({
                type: "POST",
                url: "{{ URL::route('karyawan.store') }}",
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('.btn-create-spinner').removeClass('d-none');
                    $('.btn-create-save').addClass('d-none');
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

                        setTimeout(() => {
                            $('.btn-create-spinner').addClass('d-none');
                            $('.btn-create-save').removeClass('d-none');
                        }, 1000);
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
                }
            });
        });

        // edit
        $(document).on('click', '.btn-edit', function () {
            var id = $(this).attr('data-id');
            var url = "{{ route('karyawan.edit', ':id') }}";
            url = url.replace(':id', id);

            var formData = {
                id: id
            }

            $.ajax({
                type: "get",
                url: url,
                success: function (response) {
                    $('#edit_id').val(response.id);
                    $('#edit_nik').val(response.nik);
                    $('#edit_nama_lengkap').val(response.nama_lengkap);
                    $('#edit_nama_panggilan').val(response.nama_panggilan);
                    $('#edit_telepon').val(response.telepon);
                    $('#edit_email').val(response.email);
                    $('#edit_nomor_ktp').val(response.nomor_ktp);
                    $('#edit_status_ktp').val(response.status_ktp);
                    $('#edit_tempat_lahir').val(response.tempat_lahir);
                    $('#edit_tanggal_lahir').val(response.tanggal_lahir);
                    $('#edit_alamat_asal').val(response.alamat_asal);
                    $('#edit_alamat_domisili').val(response.alamat_domisili);
                    $('#edit_jenis_sim').val(response.jenis_sim);
                    $('#edit_nomor_sim').val(response.nomor_sim);
                    $('#edit_tanggal_masuk').val(response.tanggal_masuk);

                    let value_agama = "" +
                        "<option value=\"islam\""; if (response.agama == "islam") { value_agama += " selected"; } value_agama += ">Islam</option>" +
                        "<option value=\"kristen_protestan\""; if (response.agama == "kristen_protestan") { value_agama += " selected"; } value_agama += ">Kristen Protestan</option>" +
                        "<option value=\"katholik\""; if (response.agama == "katholik") { value_agama += " selected"; } value_agama += ">Katholik</option>" +
                        "<option value=\"hindu\""; if (response.agama == "hindu") { value_agama += " selected"; } value_agama += ">Hindu</option>" +
                        "<option value=\"budha\""; if (response.agama == "budha") { value_agama += " selected"; } value_agama += ">Budha</option>" +
                        "<option value=\"kong_hu_cu\""; if (response.agama == "kong_hu_cu") { value_agama += " selected"; } value_agama += ">Kong Hu Cu</option>";
                    $('#edit_agama').append(value_agama);

                    let value_gender = "" +
                        "<option value=\"l\""; if (response.gender == "l") { value_gender += " selected"; } value_gender += ">L (Laki - laki)</option>" +
                        "<option value=\"p\""; if (response.gender == "p") { value_gender += " selected"; } value_gender += ">P (Perempuan)</option>";
                    $('#edit_gender').append(value_gender);

                    let value_cabang = "";
                    $.each(response.cabangs, function (index, value) {
                         value_cabang += "<option value=\"" + value.id + "\""; if (response.cabang == "islam") { value_cabang += " selected"; } value_cabang += ">" + value.nama + "</option>";
                    });
                    $('#edit_cabang_id').append(value_cabang);

                    let value_jabatan = "";
                    $.each(response.jabatans, function (index, value) {
                         value_jabatan += "<option value=\"" + value.id + "\""; if (response.jabatan == "islam") { value_jabatan += " selected"; } value_jabatan += ">" + value.nama + "</option>";
                    });
                    $('#edit_jabatan_id').append(value_jabatan);

                    // $('.edit_profile_img img').prop('src', 'http://localhost/yt_master/yt_hrd/public/image/' + response.foto);
                    $('.edit_profile_img img').prop('src', '{{ URL::to('') }}' + '/image/' + response.foto);

                    // modal
                    $('.modal-edit').modal('show');
                }
            });
        });

        $(document).on('submit', '#form-edit', function (e) {
            e.preventDefault();

            let formData = new FormData($('#form-edit')[0]);

            $.ajax({
                type: "POST",
                url: "{{ URL::route('karyawan.update') }}",
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('.btn-edit-spinner').removeClass('d-none');
                    $('.btn-edit-save').addClass('d-none');
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
                    var errorMessage = xhr.status + ': ' + statusText

                    Toast.fire({
                        icon: 'danger',
                        title: 'Error - ' + errorMessage
                    });
                }
            });
        });

        // delete
        $(document).on('click', '.btn-delete', function () {
            var id = $(this).attr('data-id');
            var url = "{{ route('karyawan.delete_btn', ':id') }}";
            url = url.replace(':id', id);

            var formData = {
                id: id
            }

            $.ajax({
                url: url,
                type: 'GET',
                data: formData,
                success: function (response) {
                    $('#delete_id').val(response.id);
                    $('.modal-delete').modal('show');
                }
            });
        });

        $(document).on('submit', '#form-delete', function () {
            let formData = new FormData($('#form-delete')[0]);

            $.ajax({
                url: "{{ URL::route('karyawan.delete') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
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
                    var errorMessage = xhr.status + ': ' + xhar.error

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
