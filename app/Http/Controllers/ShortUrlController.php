<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShortUrlController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        // Only Manager and Sales can create short URLs
        if (!in_array($user->role, ['Manager', 'Sales'])) {
            return back()->withErrors(['error' => 'Only Managers and Sales users can create short URLs.']);
        }

        $validated = $request->validate([
            'original_url' => 'required|url',
        ]);

        ShortUrl::create([
            'original_url' => $validated['original_url'],
            'user_id' => $user->id,
            'company_id' => $user->company_id,
            'clicks' => 0,
        ]);

        return back()->with('success', 'Short URL created successfully.');
    }

    public function destroy(ShortUrl $shortUrl)
    {
        $user = Auth::user();

        if ($shortUrl->user_id !== $user->id && !$user->isAdmin()) {
            return back()->withErrors(['error' => 'Unauthorized.']);
        }

        $shortUrl->delete();
        return back()->with('success', 'Short URL deleted successfully.');
    }

    public function redirect($shortCode)
    {
        $shortUrl = ShortUrl::where('short_code', $shortCode)->firstOrFail();
        $shortUrl->incrementClicks();
        return redirect($shortUrl->original_url);
    }
}
