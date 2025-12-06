@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="card">
    <h2>Create New Account</h2>

    <form action="{{ route('register') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" required value="{{ old('name') }}">
        </div>

        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" required value="{{ old('email') }}">
        </div>

        <div class="form-group">
            <label for="company_name">Company Name</label>
            <input type="text" id="company_name" name="company_name" required value="{{ old('company_name') }}">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>

        <button type="submit" class="btn btn-primary">Register</button>
    </form>

    <p style="margin-top: 1rem;">Already have an account? <a href="{{ route('login') }}">Login here</a></p>
</div>
@endsection
