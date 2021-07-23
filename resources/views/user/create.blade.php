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
                        <label for="exampleInputPassword1">Role User</label>
                        <select name="role_id" id="role_id" class="form-control" required>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->role }}</option>
                            @endforeach                            
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Nama User</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="email" required>
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