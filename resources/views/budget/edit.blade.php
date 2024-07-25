@extends('layouts/app')
@section('content')
<div class="container">
    <h1>User Settings</h1>
    <form action="{{ route('settings.update') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="budget_limit">Budget Limit</label>
            <input type="number" name="budget_limit" id="budget_limit" class="form-control" value="{{ $settings->budget_limit }}">
        </div>
        <button type="submit" class="btn btn-primary mt-3">Update Settings</button>
    </form>
</div>
@endsection
