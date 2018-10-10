<?php

namespace Alpha\Http\Controllers;

use CSUNMetaLab\Guzzle\Factories\HandlerGuzzleFactory;
use GuzzleHttp\TransferStats;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postLogin(Request $request)
    {
        $credentials = $request->all('username', 'password');
        if (auth()->attempt($credentials) && auth()->user()->affiliation) {
            $guzzle = HandlerGuzzleFactory::fromDefaults();
            $directoryResponse = $guzzle->get(config('webservices.directory_url').
                'members/email/'. auth()->user()->email);
            $mediaResponse = $guzzle->get(config('webservices.media_url').'faculty/media/'.auth()->user()->email_uri);
            $mediaResponse = $guzzle->resolveResponseBody($mediaResponse, 'json');
            $avatar_url = '';
            $guzzle->setRequestOptionArray([
                'on_stats' => function (TransferStats $stats) use (&$avatar_url) {
                    $avatar_url = $stats->getEffectiveUri();
                    $avatar_url = $avatar_url->getScheme().'://'.$avatar_url->getHost().$avatar_url->getPath();
                }
            ]);
            $guzzle->get($mediaResponse->media[0]->avatar_image);
            $directoryResponse = $guzzle->resolveResponseBody($directoryResponse, 'json');
            auth()->user()->directory_data = $directoryResponse->people;
            auth()->user()->avatar_image = $avatar_url;
            session()->put('user', auth()->user());
            return redirect()->route('profile.edit.info', auth()->user()->email_uri);
        }
        session()->flash('message', 'Your username or password is invalid.');
        return redirect()->route('home');
    }
}
