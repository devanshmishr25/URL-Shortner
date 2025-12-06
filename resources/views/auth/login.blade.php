@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="card">
    <h2>Login to Your Account</h2>

    <form action="{{ route('login') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" required value="{{ old('email') }}">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>

        <button type="submit" class="btn btn-primary">Login</button>
    </form>

    <p style="margin-top: 1rem;">Don't have an account? <a href="{{ route('register') }}">Register here</a></p>

    <hr style="margin: 2rem 0;">
    <h3>Test Credentials:</h3>
    <table>
        <tr>
            <th>Role</th>
            <th>Email</th>
            <th>Password</th>
        </tr>
        <tr>
            <td>SuperAdmin</td>
            <td>superadmin@example.com</td>
            <td>password123</td>
        </tr>
        <tr>
            <td>Admin</td>
            <td>admin@example.com</td>
            <td>password123</td>
        </tr>
        <tr>
            <td>Member</td>
            <td>member@example.com</td>
            <td>password123</td>
        </tr>
        <tr>
            <td>Manager</td>
            <td>manager@example.com</td>
            <td>password123</td>
        </tr>
    </table>
</div>
@endsection
