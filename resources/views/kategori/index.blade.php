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
                            <th>Kategori</th>
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
                            <label for="kategori">Kategori</label>
                            <input type="text" class="form-control" id="kategori" name="kategori">
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
                ajax: "{{ url('kategori') }}",
                columns: [{
                    data: 'kategori',
                    name: 'Kategori'
                }, {
                    data: 'action',
                    name: 'Action'
                }]
            });
        });

        //tambah data
        $('body').on('click', '.tombol-tambah', function(e) {
            e.preventDefault();
            $('#exampleModal').modal('show');

            $('.tombol-simpan').click(function(e) {
                $.ajax({
                    url: 'kategori',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'kategori': $('#kategori').val(),

                    },
                    success: function(response) {
                        if (response.errors) {
                            $('.alert-danger').removeClass('d-none');
                            $('.alert-danger').append("<ul>");
                            $.each(response.errors, function(key, value) {
                                $('.alert-danger').find('ul').append("<li>" + value +
                                    "</li>");
                            });
                            $('.alert-danger').append("</ul>");

                        } else {
                            $('.alert-success').removeClass('d-none');
                            $('.alert-success').html(response.success);
                        }
                        $('#myTable').DataTable().ajax.reload();
                    }
                });
                e.stopImmediatePropagation();

            });
        });


        $('body').on('click', '.tombol-edit', function(e) {
            e.preventDefault(); // Hentikan tindakan default dari tautan

            var id = $(this).data('id');

            // Pertama, ambil data kategori menggunakan permintaan AJAX GET
            $.ajax({
                url: 'kategori/' + id + '/edit',
                type: 'GET',
                success: function(response) {
                    $('#exampleModal').modal('show');
                    $('#kategori').val(response.result.kategori);

                    // Sekarang, tindakan simpan data saat tombol "Simpan" diklik
                    $('.tombol-simpan').off('click').on('click', function(e) {
                        e.preventDefault();

                        // Kirim data kategori yang telah diubah melalui permintaan AJAX PUT
                        $.ajax({
                            url: 'kategori/' + id,
                            type: 'PUT',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content')
                            },
                            data: {
                                'kategori': $('#kategori').val(),
                            },
                            success: function(response) {
                                if (response.errors) {
                                    $('.alert-danger').removeClass('d-none');
                                    $('.alert-danger').html(response.errors
                                        .kategori); // Menampilkan pesan kesalahan
                                } else {
                                    $('.alert-success').removeClass('d-none');
                                    $('.alert-success').html(response.success);
                                    $('#exampleModal').modal(
                                        'hide'
                                    ); // Sembunyikan modal setelah berhasil
                                    $('#myTable').DataTable().ajax.reload();
                                }
                            }
                        });
                    });
                }
            });


            //delete data
            $('body').on('click', '.tombol-delete', function(e) {
                if (confirm('Hapus Data ?') == true) {
                    var id = $(this).data('id');
                    console.log(id);
                    $.ajax({
                        url: 'kategori/' + id,
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

                $('#kategori').val('');
            });
        });

        document.querySelector("#exampleModal .modal-footer button[data-dismiss='modal']").addEventListener("click",
            function() {
                // Sembunyikan modal dengan menghilangkan kelas "show" dari elemen modal
                document.querySelector("#exampleModal").classList.remove("show");
                // Sembunyikan modal dengan menghilangkan kelas "show" dari elemen backdrop
                document.querySelector(".modal-backdrop").classList.remove("show");

                $('#kategori').val('');
                $('.alert-danger').addClass('d-none');
                $('.alert-danger').html('')

                $('.alert-success').addClass('d-none');
                $('.alert-success').html('')

            });
    </script>
@endsection
