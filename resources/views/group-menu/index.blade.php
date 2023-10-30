@extends('layouts.master')

@section('title', 'Kategori')
{{-- @section('header', 'Pengeluaran') --}}
@section('breadcrumb', 'Kategori')
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
                            <th>Group Menu</th>
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
                    <h5 class="modal-title" id="exampleModalLabel">Form Insert Kategori</h5>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger d-none"></div>
                    <div class="alert alert-success d-none"></div>

                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="nama_group_menu">Group Menu</label>
                            <input type="text" class="form-control" id="nama_group_menu" name="nama_group_menu">
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
                ajax: "{{ url('group-menu') }}",
                columns: [{
                    data: 'nama_group_menu',
                    name: 'Nama Group Menu'
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
                    url: 'group-menu',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'nama_group_menu': $('#nama_group_menu').val()
                    },
                    success: function(response) {
                        if (response.errors) {
                            $('.alert-danger').removeClass('d-none');
                            $('.alert-danger').append("<ul>");
                            $.each(response.errors, function(key, value) {
                                $('.alert-danger').append("<li>" + value + ("</li>"))
                            });
                        } else {
                            $('.alert-success').removeClass('d-none');
                            $('.alert-success').html(response.success);
                        }
                        // Sembunyikan modal setelah berhasil
                        // $('#exampleModal').modal('hide');
                        $('#myTable').DataTable().ajax.reload();
                    }
                });
                e.stopImmediatePropagation();
            });
        });

        //edit data
        $('body').on('click', '.tombol-edit', function(e) {
            e.preventDefault();

            var id = $(this).data('id');
            // Pertama, ambil data kategori menggunakan permintaan AJAX GET
            $.ajax({
                url: 'group-menu/' + id + '/edit',
                type: 'GET',
                success: function(response) {
                    //data disimpan di response
                    $('#exampleModal').modal('show');
                    $('#nama_group_menu').val(response.result.nama_group_menu);

                    // Sekarang, tindakan simpan data saat tombol "Simpan" diklik
                    $('.tombol-simpan').off('click').on('click', function(e) {
                        e.preventDefault();

                        // Kirim data group menu yang telah diubah melalui permintaan AJAX PUT
                        $.ajax({
                            url: 'group-menu/' + id,
                            type: 'PUT',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content')
                            },
                            data: {
                                'nama_group_menu': $('#nama_group_menu').val()
                            },
                            success: function(response) {
                                if (response.errors) {
                                    $('.alert-danger').removeClass('d-none');
                                    $('.alert-danger').html(response.errors
                                        .nama_group_menu);
                                } else {
                                    $('.alert-success').removeClass('d-none');
                                    $('.alert-success').html(response.success);
                                    // Jeda 2 detik
                                    setTimeout(function() {
                                        $('#exampleModal').modal('hide');
                                        $('.alert-success').addClass(
                                            'd-none');
                                    }, 500);

                                    $('#myTable').DataTable().ajax.reload();
                                }
                            }
                        })
                    });
                }
            });

        });

        //button hapus
        $('body').on('click', '.tombol-delete', function(e) {
            if (confirm('Hapus Data ?') == true) {
                var id = $(this).data('id');

                $.ajax({
                    url: 'group-menu/' + id,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content'),
                    }
                });
                $('#myTable').DataTable().ajax.reload();
            }
        });



        // Menambahkan event handler untuk menutup modal
        $('#exampleModal').on('hidden.bs.modal', function(e) {
            // Menghilangkan alert ketika modal ditutup
            $('.alert').addClass('d-none');

            $('#nama_group_menu').val('');
        });

        document.querySelector("#exampleModal .modal-footer button[data-dismiss='modal']").addEventListener("click",
            function() {
                // Sembunyikan modal dengan menghilangkan kelas "show" dari elemen modal
                document.querySelector("#exampleModal").classList.remove("show");
                // Sembunyikan modal dengan menghilangkan kelas "show" dari elemen backdrop
                document.querySelector(".modal-backdrop").classList.remove("show");
                $('#nama_group_menu').val('');
                $('.alert-danger').addClass('d-none');
                $('.alert-danger').html('')
                $('.alert-success').addClass('d-none');
                $('.alert-success').html('')
            });
    </script>
@endsection
