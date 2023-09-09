@extends('layouts.app')
@section('title', 'Create User')
@section('content')
    <h1>Update User</h1>
    <form action="../update" method="POST">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" required value="{{$user['username']}}">
        </div>
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="text" class="form-control" id="email" name="email" required value="{{$user['email']}}">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="email-verification"
            @if($user['email_verification'] == 1)
                checked
                @endif>
            <label class="form-check-label" for="email-verification">Email verified</label>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-control" name="role" id="select">
                <option value="0"
                @if($user['role'] == 0)
                    selected
                @endif
                >User</option>
                <option value="1"
                @if($user['role'] == 1)
                    selected
                @endif
                >Content Creator</option>
                <option value="2"
                @if($user['role'] == 2)
                    selected
                @endif
                >Editor</option>
                <option value="3"
                @if($user['role'] == 3)
                    selected
                @endif
                >Admin</option>
            </select>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="is_active" name="is_active"
            @if($user['is_active'] == 1)
                checked
                    @endif
            >
            <label class="form-check-label" for="is_active">Active</label>
        </div>
        <input type="hidden" name="id" value="{{$user['id']}}">
        <button type="submit" class="btn btn-success">Update</button>
    </form>
@endsection