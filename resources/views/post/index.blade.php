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
                                <label for="title">Content</label>
                                <textarea id="summernote" name="content">
                            </textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer p-3">
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
                serverside: true,
                ajax: "{{ url('post') }}",
                columns: [{
                    data: 'user_id',
                    name: 'User id'
                }, {
                    data: 'title',
                    name: 'Titel'
                }, {
                    data: 'content',
                    name: 'Content'
                }, {
                    data: 'action',
                    name: 'Action'
                }]
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
    </script>

@endsection
