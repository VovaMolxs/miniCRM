@extends('layouts.app')
@section('title', 'Create User')
@section('content')
    <h1>Update User</h1>
    <form action="../update" method="POST">
        <div class="form-group">
            <label for="login">Login</label>
            <input type="text" class="form-control" id="login" name="login" required value="{{$user['login']}}">
        </div>
        <div class="form-group">
            <label for="admin">Admin</label>
            <input type="hidden" name="id" value="{{$user['id']}}">
            <select class="form-control" name="admin" id="admin">
                <option value="0">NO</option>
                <option value="1" @if($user['is_admin'] == 1)
                    selected
                        @endif>YES</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
@endsection