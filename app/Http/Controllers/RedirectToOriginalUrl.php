<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;

class RedirectToOriginalUrl extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Url $url)
    {
        return redirect()->away($url->url);
    }
}
