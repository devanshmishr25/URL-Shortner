@extends('layouts.app')

@section('title', 'Member Dashboard')

@section('content')
<div class="card">
    <h2>Welcome, {{ $user->name }} (Member)</h2>
    <p>Company: {{ $user->company->name }}</p>
</div>

<div class="card">
    <h3>Your Short URLs</h3>
    @if ($shortUrls->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Short Code</th>
                    <th>Original URL</th>
                    <th>Clicks</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($shortUrls as $url)
                    <tr>
                        <td>
                            <a href="{{ route('redirect', $url->short_code) }}" target="_blank">
                                {{ $url->short_code }}
                            </a>
                        </td>
                        <td>{{ substr($url->original_url, 0, 50) }}...</td>
                        <td>{{ $url->clicks }}</td>
                        <td>{{ $url->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            <form action="{{ route('short-url.destroy', $url) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $shortUrls->links() }}
    @else
        <p>You haven't created any short URLs yet.</p>
    @endif
</div>
@endsection
