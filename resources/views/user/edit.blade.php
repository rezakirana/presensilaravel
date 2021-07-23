@extends('layouts/main-admin')

@section('title', 'Dashboard Admin')

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
                <li class="breadcrumb-item active">Edit User</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="container-fluid">
    <div class="card">
        @include ('includes.flash')
        <div class="card-body">
            <form role="form" method="post" action="{{ route('users.update', $user->id) }}">
                @csrf
                @method('put')
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Role User</label>
                        <select name="role_id" id="role_id" class="form-control" required>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" @if ($role->id == $user->role_id)
                                    selected
                                @endif>{{ $role->role }}</option>
                            @endforeach                            
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Nama User</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="nama" required value="{{ $user->name }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="email" required value="{{ $user->email }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Status</label>
                        <select name="is_active" id="is_active" class="form-control" required>
                            <option value="1" @if ($user->is_active == 1)
                                selected
                            @endif>Active</option>
                            <option value="0" @if ($user->is_active == 0)
                                selected
                            @endif>Deactive</option>
                        </select>
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