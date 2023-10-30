@extends('layouts.master')

@section('title', 'Post')
{{-- @section('header', 'Pengeluaran') --}}
@section('breadcrumb', 'Post')
@section('container-fluid')
    <div class="container">

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" id="tambahButton">
            Tambah Data
        </button>
        <div class="row mt-4" id="content" hidden>
            <div class="col-md-12">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">
                            Insert Artikel
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="user_id">User ID</label>
                                <input type="text" class="form-control" id="user_id" name="user_id">
                            </div>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title">
                            </div>
                            <div class="form-group">
                                <label for="kategori">Kategori</label>
                                <select name="kategori_id" id="kategori_id" class="form-control" required>
                                    <option value="" disabled selected>Pilih Kategori</option>
                                    @foreach ($kategoris as $item)
                                        <option value="{{ $item['id'] }}">{{ $item['kategori'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="title">Content</label>
                                <textarea id="summernote" name="content" class="content"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer p-3">
                        <button type="button" id="close" class="btn btn-danger mr-2">Close</button>
                        <button type="submit" class="btn btn-primary tombol-simpan">Save</button>
                    </div>
                </div>
            </div>
            <!-- /.col-->
        </div>


        <div class="card mt-3">
            <div class="card-body">
                <div id="example_wrapper">
                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Kategori</th>
                            <th>User</th>
                            <th>Action</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "post",
                columns: [{
                        data: 'title',
                        name: 'Title'
                    },
                    {
                        data: 'content',
                        name: 'content'
                    },
                    {
                        data: 'kategori',
                        name: 'kategori'
                    },
                    {
                        data: 'user_id',
                        name: 'user_id'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ]
            });
        });


        $('.tombol-simpan').click(function(e) {
            $.ajax({
                url: 'post',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'user_id': $('#user_id').val(),
                    'title': $('#title').val(),
                    'content': $('#summernote').val(),
                    'kategori_id': $('#kategori_id').val()
                },
                success: function(response) {
                    console.log(response);
                    $('#content').hide(); // Hide the form card
                    $('#myTable').DataTable().ajax.reload();

                }
            });
        });

        $(function() {
            // Summernote
            $('#summernote').summernote()
        })

        document.getElementById('tambahButton').addEventListener('click', function() {
            // Hilangkan properti hidden pada elemen dengan ID 'content'
            document.getElementById('content').removeAttribute('hidden');
        });

        // $(document).ready(function() {
        //     // Add a click event listener to the "Close" button
        //     $("#close").on("click", function() {
        //         $("#content").hide();
        //     });
        // });

        //delete data
        $('body').on('click', '.tombol-delete', function(e) {
            if (confirm('Hapus Data ?') == true) {
                var id = $(this).data('id');
                console.log(id);
                $.ajax({
                    url: 'post/' + id,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content'),
                    }
                });
                $('#myTable').DataTable().ajax.reload();
            }
        });
    </script>

@endsection
