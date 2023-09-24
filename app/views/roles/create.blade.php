@extends('layouts.app')
@section('title', 'Create RoleModel')
@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-lg-6 col-md-8 col-sm-10">
            <h1 class="text-center mb-4">Create Role</h1>
            <form action="store" method="POST">
                <div class="mb-3">
                    <label for="role_name">Role name</label>
                    <input type="text" class="form-control" id="role_name" name="role_name" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="role_description" >Role description</label>
                    <textarea class="form-control" id="role_description" name="role_description" required></textarea>
                </div>

                <button type="submit" class=" btn btn-success">Create Role</button>
            </form>
        </div>
    </div>
@endsection