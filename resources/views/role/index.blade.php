@extends('layouts.master')

@section('title', 'Role')
{{-- @section('header', 'Pengeluaran') --}}
@section('breadcrumb', 'Role')
@section('container-fluid')
    <div class="container">

        <!-- Button trigger modal -->
        <button type="button" class="tombol-tambah btn btn-primary">
            Tambah Data
        </button>

        <div class="card mt-3">
            <div class="card-body">
                <div id="example_wrapper">
                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <th>Role</th>
                            <th>Deskripsi</th>
                            <th>Action</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Insert Role</h5>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger d-none"></div>
                    <div class="alert alert-success d-none"></div>

                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="nama_role">Nama Role</label>
                            <input type="text" class="form-control" id="nama_role" name="nama_role">
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <input type="text" class="form-control" id="deskripsi" name="deskripsi">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary tombol-simpan">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                processing: true,
                serverside: true,
                ajax: "{{ url('role') }}",
                columns: [{
                    data: 'nama_role',
                    name: 'nama_role'
                }, {
                    data: 'deskripsi',
                    name: 'deskripsi'
                }, {
                    data: 'action',
                    name: 'Action'
                }]
            });
        });

        $('body').on('click', '.tombol-tambah', function(e) {
            e.preventDefault();
            $('#exampleModal').modal('show');
            $('.tombol-simpan').click(function(e) {
                $.ajax({
                    url: 'role',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'nama_role': $('#nama_role').val(),
                        'deskripsi': $('#deskripsi').val(),
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.errors) {
                            $('.alert-danger').removeClass('d-none');
                            $('.alert-danger').append("<ul>");
                            $.each(response.errors, function(key, value) {
                                $('.alert-danger').append("<li>" + value + ("</li>"))
                            });
                        } else {
                            $('.alert-success').removeClass('d-none');
                            $('.alert-success').html(response.success);
                            setTimeout(function() {
                                $('#exampleModal').modal('hide');
                                $('.alert-success').addClass(
                                    'd-none');
                            }, 500);
                            $('#myTable').DataTable().ajax.reload();
                        }
                    }
                });
                e.stopImmediatePropagation();
            });

            // Menambahkan event handler untuk menutup modal
            $('#exampleModal').on('hidden.bs.modal', function(e) {
                // Menghilangkan alert ketika modal ditutup
                $('.alert').addClass('d-none');

                $('#nama_role').val('');
                $('#deskripsi').val('');
            });
        });

        $('body').on('click', '.tombol-edit', function(e) {
            e.preventDefault();

            var id = $(this).data('id');
            // Pertama, ambil data menggunakan permintaan AJAX GET

            $.ajax({
                url: 'role/' + id + '/edit',
                type: 'GET',
                success: function(response) {
                    // Data disimpan dalam response
                    console.log("hasil : " + response);
                    $('#exampleModal').modal('show');
                    $('#nama_role').val(response.result.nama_role);
                    $('#deskripsi').val(response.result.deskripsi);

                    // Next, proses Simpan data
                    $('.tombol-simpan').off('click').on('click', function(e) {
                        var nama_role = $('#nama_role').val();
                        var deskripsi = $('#deskripsi').val();
                        // Buat objek data yang akan dikirim
                        var data = {
                            nama_role: nama_role,
                            deskripsi: deskripsi,
                        };
                        $.ajax({
                            url: 'role/' + id,
                            type: 'PUT',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content')
                            },
                            data: data,
                            success: function(response) {
                                if (response.errors) {
                                    $('.alert-danger').removeClass('d-none');
                                    $('.alert-danger').html(response.errors
                                        .kategori); // Menampilkan pesan kesalahan
                                } else {
                                    $('.alert-success').removeClass('d-none');
                                    $('.alert-success').html(response.success);
                                    setTimeout(function() {
                                        $('#exampleModal').modal('hide');
                                        $('.alert-success').addClass(
                                            'd-none');
                                    }, 500);
                                    $('#myTable').DataTable().ajax.reload();
                                }
                            }
                        });
                    });
                }
            });

            // Menambahkan event handler untuk menutup modal
            $('#exampleModal').on('hidden.bs.modal', function(e) {
                // Menghilangkan alert ketika modal ditutup
                $('.alert').addClass('d-none');

                $('#nama_role').val('');
                $('#deskripsi').val('');
            });
        });

        $('body').on('click', '.tombol-delete', function(e) {
            if (confirm('Hapus Data ?') == true) {
                var id = $(this).data('id');
                $.ajax({
                    url: 'role/' + id,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content'),
                    }
                });
                $('#myTable').DataTable().ajax.reload();
            }
        });

        document.querySelector("#exampleModal .modal-footer button[data-dismiss='modal']").addEventListener("click",
            function() {
                // Sembunyikan modal dengan menghilangkan kelas "show" dari elemen modal
                document.querySelector("#exampleModal").classList.remove("show");
                // Sembunyikan modal dengan menghilangkan kelas "show" dari elemen backdrop
                document.querySelector(".modal-backdrop").classList.remove("show");

                $('#nama_role').val('');
                $('#deskripsi').val('');
                $('.alert-danger').addClass('d-none');
                $('.alert-danger').html('')

                $('.alert-success').addClass('d-none');
                $('.alert-success').html('')

            });
    </script>
@endsection
