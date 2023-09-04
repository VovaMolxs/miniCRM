@extends('layouts.app')
@section('title', 'Create User')
@section('content')
    <h1>Create User</h1>
    <form action="store" method="POST">
        <div class="form-group">
            <label for="login">Login</label>
            <input type="text" class="form-control" id="login" name="login" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="confirm password">Confirm Password</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
        </div>
        <div class="form-group">
            <label for="admin">Admin</label>
            <select class="form-control" name="admin" id="admin">
                <option value="0">NO</option>
                <option value="1">YES</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Create</button>
    </form>
@endsection