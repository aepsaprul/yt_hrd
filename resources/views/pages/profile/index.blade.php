@extends('layouts.app')

@section('style')

@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Biodata</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Biodata</li>
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
                        <div class="card-body">
                            <form id="form" method="post" enctype="multipart/form-data" class="form-create">
                                {{-- id --}}
                                <input type="hidden" id="id" name="id" value="{{ $karyawan->id }}">

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="card card-primary card-outline">
                                            <div class="card-body box-profile pb-3">
                                                <div class="text-center profile_img">
                                                    <img
                                                        class="profile-user-img img-fluid img-circle"
                                                        src="{{ asset('image/' . $karyawan->foto) }}"
                                                        alt="User profile picture">
                                                </div>
                                                <div class="form-group">
                                                    <label for="foto">Ubah Foto</label>
                                                    <input type="file" id="foto" name="foto" class="form-control form-control-sm" >
                                                    <small id="errorFoto" class="form-text text-danger"></small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nik">NIK</label>
                                                    <input type="text" id="nik" name="nik" class="form-control form-control-sm" value="{{ $karyawan->nik }}" maxlength="12" readonly>
                                                    <small id="errorNik" class="form-text text-danger"></small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="telepon">Telepon</label>
                                                    <input type="text" id="telepon" name="telepon" class="form-control form-control-sm" value="{{ $karyawan->telepon }}" maxlength="15" >
                                                    <small id="errorTelepon" class="form-text text-danger"></small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" id="email" name="email" class="form-control form-control-sm" value="{{ $karyawan->email }}" maxlength="50" >
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
                                                            <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control form-control-sm" value="{{ $karyawan->nama_lengkap }}" maxlength="30" >
                                                            <small id="errorNamaLengkap" class="form-text text-danger"></small>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="nama_panggilan">Nama Panggilan</label>
                                                            <input type="text" id="nama_panggilan" name="nama_panggilan" class="form-control form-control-sm" value="{{ $karyawan->nama_panggilan }}" maxlength="15" >
                                                            <small id="errorNamaPanggilan" class="form-text text-danger"></small>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="gender">Gender</label>
                                                            <select name="gender" id="gender" class="form-control form-control-sm">
                                                                <option value="l" @if ($karyawan->gender == "l") selected @endif>L (Laki - laki)</option>
                                                                <option value="p" @if ($karyawan->gender == "p") selected @endif>P (Perempuan)</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="nomor_ktp">Nomor KTP</label>
                                                            <input type="number" id="nomor_ktp" name="nomor_ktp" class="form-control form-control-sm" value="{{ $karyawan->nomor_ktp }}" maxlength="16">
                                                            <small id="errorNomorKtp" class="form-text text-danger"></small>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="status_ktp">Status KTP</label>
                                                            <input type="text" id="status_ktp" name="status_ktp" class="form-control form-control-sm" value="{{ $karyawan->status_ktp }}" maxlength="30" >
                                                            <small id="errorStatusKtp" class="form-text text-danger"></small>
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
                                                            <label for="tempat_lahir">Tempat Lahir</label>
                                                            <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control form-control-sm" value="{{ $karyawan->tempat_lahir }}" maxlength="30" >
                                                            <small id="errorTempatLahir" class="form-text text-danger"></small>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="tanggal_lahir">Tanggal Lahir</label>
                                                            <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control form-control-sm" value="{{ $karyawan->tanggal_lahir }}">
                                                            <small id="errorTanggalLahir" class="form-text text-danger"></small>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="sim">Jenis & Nomor SIM</label>
                                                            <div class="row">
                                                                <div class="col-md-4 col-sm-4 col-4">
                                                                    <input type="text" id="jenis_sim" name="jenis_sim" class="form-control form-control-sm" value="{{ $karyawan->jenis_sim }}" maxlength="10">
                                                                    <small id="errorJenisSim" class="form-text text-danger"></small>
                                                                </div>
                                                                <div class="col-md-8 col-sm-8 col-8">
                                                                    <input type="text" id="nomor_sim" name="nomor_sim" class="form-control form-control-sm" value="{{ $karyawan->nomor_sim }}" maxlength="15">
                                                                    <small id="errorNomorSim" class="form-text text-danger"></small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="alamat_asal">Alamat Asal</label>
                                                            <input type="text" id="alamat_asal" name="alamat_asal" class="form-control form-control-sm" value="{{ $karyawan->alamat_asal }}">
                                                            <small id="errorAlamatAsal" class="form-text text-danger"></small>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="alamat_domisili">Alamat Domisili</label>
                                                            <input type="text" id="alamat_domisili" name="alamat_domisili" class="form-control form-control-sm" value="{{ $karyawan->alamat_domisili }}" readonly>
                                                            <small id="errorAlamatDomisili" class="form-text text-danger"></small>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="tanggal_masuk">Tanggal Masuk</label>
                                                            <input type="date" id="tanggal_masuk" name="tanggal_masuk" class="form-control form-control-sm" value="{{ $karyawan->tanggal_masuk }}" readonly>
                                                            <small id="errorTanggalMasuk" class="form-text text-danger"></small>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="cabang_id">Cabang</label>
                                                            <input type="text" name="cabang_id" id="cabang_id" class="form-control form-control-sm" value="{{ $karyawan->cabang->nama }}" readonly>
                                                            <small id="errorCabangId" class="form-text text-danger"></small>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="jabatan_id">Jabatan</label>
                                                            <input type="text" name="jabatan_id" id="jabatan_id" class="form-control form-control-sm" value="{{ $karyawan->jabatan->nama }}" readonly>
                                                            <small id="errorJabatanId" class="form-text text-danger"></small>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="divisi_id">Divisi</label>
                                                            <input type="text" name="divisi_id" id="divisi_id" class="form-control form-control-sm" value="{{ $karyawan->divisi->nama }}" readonly>
                                                            <small id="errorDivisiId" class="form-text text-danger"></small>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="role_id">Role</label>
                                                            <input type="text" name="role_id" id="role_id" class="form-control form-control-sm" value="{{ $karyawan->role->nama }}" readonly>
                                                            <small id="errorRoleId" class="form-text text-danger"></small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-primary btn-spinner d-none" disabled style="width: 130px;">
                                        <span class="spinner-grow spinner-grow-sm"></span>
                                        Loading...
                                    </button>
                                    <button type="submit" class="btn btn-primary btn-save" style="width: 130px;">
                                        <i class="fas fa-save"></i> <span class="modal-btn">Perbaharui</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@section('script')

<script>
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

        $(document).on('submit', '.form-create', function (e) {
            e.preventDefault();

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
            $('#errorJenisSim').empty();
            $('#errorNomorSim').empty();
            $('#errorFoto').empty();

            let formData = new FormData($('#form')[0]);

            $.ajax({
                type: "POST",
                url: "{{ URL::route('profile.store') }}",
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('.btn-spinner').removeClass('d-none');
                    $('.btn-save').addClass('d-none');
                },
                success: function (response) {
                    if (response.status == 400) {
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
                        $('#errorJenisSim').append(response.errors.jenis_sim);
                        $('#errorNomorSim').append(response.errors.nomor_sim);
                        $('#errorFoto').append(response.errors.foto);

                        setTimeout(() => {
                            $('.btn-spinner').addClass('d-none');
                            $('.btn-save').removeClass('d-none');
                        }, 1000);
                    } else {
                        Toast.fire({
                            icon: 'success',
                            title: 'Data behasil diperbaharui'
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
    });
</script>

@endsection
