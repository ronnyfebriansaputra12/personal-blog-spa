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

@endsection