@extends('layouts.app')

@section('title', 'Super Admin Dashboard')

@section('content')
<div class="card">
    <h2>Welcome, {{ $user->name }} (SuperAdmin)</h2>
    <p>You have access to all system features.</p>
</div>

<div class="card">
    <h3>Available Actions:</h3>
    <ul style="list-style-position: inside;">
        <li>View all companies and their data</li>
        <li>Manage all users across the system</li>
        <li>Monitor URL shortener usage</li>
    </ul>
</div>

<div class="card">
    <h3>System Information:</h3>
    <table>
        <tr>
            <th>Metric</th>
            <th>Value</th>
        </tr>
        <tr>
            <td>Total Users</td>
            <td>{{ App\Models\User::count() }}</td>
        </tr>
        <tr>
            <td>Total Companies</td>
            <td>{{ App\Models\Company::count() }}</td>
        </tr>
        <tr>
            <td>Total Short URLs</td>
            <td>{{ App\Models\ShortUrl::count() }}</td>
        </tr>
        <tr>
            <td>Total Clicks</td>
            <td>{{ App\Models\ShortUrl::sum('clicks') }}</td>
        </tr>
    </table>
</div>
@endsection
