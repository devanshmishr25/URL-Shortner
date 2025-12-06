@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="card">
    <h2>Welcome, {{ $user->name }}</h2>
    <p>Role: {{ $user->role }}</p>
    <p>Company: {{ $user->company->name ?? 'N/A' }}</p>
</div>
@endsection
