<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;


class LinkedinController extends Controller
{

    public function redirectToLinkedIn()
    {
        $query = http_build_query([
            'response_type' => 'code',
            'client_id' => '8605jv9vbl0rrl',
            'redirect_uri' => 'http://localhost/sainslogistik/auth/linkedin/callback',
            'scope' => 'profile',
            'state' => bin2hex(random_bytes(5)),
        ]);

        return redirect('https://www.linkedin.com/oauth/v2/authorization?' . $query);
    }

    public function handleLinkedInCallback(Request $request)
    {
        // dd($request);
        $code = $request->get('code');
        $response = Http::asForm()->post('https://www.linkedin.com/oauth/v2/accessToken', [
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => 'http://localhost/sainslogistik/auth/linkedin/callback',
            'client_id' => '8605jv9vbl0rrl',
            'client_secret' => 'TXNBPiPYbULgMEFB',
        ]);
        // dd($response);
        $access_token = $response['access_token'] ?? '';

        $response = Http::withToken($access_token)->get('https://api.linkedin.com/v2/me');

        $posts = $response->json();

        // Lakukan sesuatu dengan posting yang diterima dari API LinkedIn
        return $posts;
    }


}
