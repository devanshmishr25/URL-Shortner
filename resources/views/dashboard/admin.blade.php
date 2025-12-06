@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="card">
    <h2>Welcome, {{ $user->name }} (Admin)</h2>
    <p>Company: {{ $user->company->name }}</p>
</div>

<div class="card">
    <h3>Invite Team Member</h3>
    <form action="{{ route('invitation.send') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="role">Role</label>
            <select id="role" name="role" required>
                <option value="Member">Member</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Send Invitation</button>
    </form>
</div>

<div class="card">
    <h3>Short URLs in Your Company</h3>
    @if ($shortUrls->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Short Code</th>
                    <th>Original URL</th>
                    <th>Created By</th>
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
                        <td>{{ $url->user->name }}</td>
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
        <p>No short URLs found.</p>
    @endif
</div>
@endsection
