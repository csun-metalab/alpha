<?php

namespace Alpha\Http\Controllers;

use CSUNMetaLab\Guzzle\Factories\HandlerGuzzleFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function postLogin(Request $request)
    {
        $credentials = $request->all('username', 'password');
        if (Auth::attempt($credentials)) {
            if (auth()->user()->affiliation) {
                $guzzle = HandlerGuzzleFactory::fromDefaults();
                $response = $guzzle->get(env('DIRECTORY_URL').
                    'members/email/'. str_replace('nr_', '', auth()->user()->email));
                $response = $guzzle->resolveResponseBody($response, 'json');
                auth()->user()->directory_data = $response->people;
                session()->put('user', auth()->user());
                return redirect()->route('profile.edit.info', auth()->user()->email_uri);
            }
        }
        return redirect()->route('home');
    }
}
