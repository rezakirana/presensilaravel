@extends('layouts/main-admin')

@section('title', 'Tambah User')

@section('container')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 text-dark">USERS</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Tambah User</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="container-fluid">
    <div class="card">
        @include ('includes.flash')
        <div class="card-body">
            <form role="form" method="post" action="{{ route('users.store') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Type User</label>
                        <select name="type" id="type" class="form-control" required>
                           <option value="">--Pilih Role--</option>
                           <option value="admin">Admin</option>
                           <option value="guru">Guru</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Username</label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="username" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="password" required>
                    </div>
                </div>
                <div class="card-body">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</section>
@include ('includes.scripts')
@endsection