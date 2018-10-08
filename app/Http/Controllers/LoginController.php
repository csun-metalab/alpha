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
                $directoryResponse = $guzzle->get(config('webservices.directory_url').
                    'members/email/'. auth()->user()->email);
                $mediaResponse = $guzzle->get(config('webservices.media_url').'faculty/media/'.auth()->user()->email_uri);
                $mediaResponse = $guzzle->resolveResponseBody($mediaResponse, 'json');
                $directoryResponse = $guzzle->resolveResponseBody($directoryResponse, 'json');
                auth()->user()->directory_data = $directoryResponse->people;
                auth()->user()->avatar_image = $mediaResponse->media[0]->avatar_image;
                session()->put('user', auth()->user());
                return redirect()->route('profile.edit.info', auth()->user()->email_uri);
            }
        }
        session()->flash('message', 'Your username or password is invalid.');
        return redirect()->route('home');
    }
}
