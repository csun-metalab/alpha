<?php

namespace Alpha\Http\Controllers;

use CSUNMetaLab\Guzzle\Factories\HandlerGuzzleFactory;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postLogin(Request $request)
    {
        $credentials = $request->all('username', 'password');
        if (auth()->attempt($credentials)) {
            $guzzle = HandlerGuzzleFactory::fromDefaults();
            $directoryUrl = config('webservices.directory_url').
                'members/email/'. auth()->user()->email;
            if (auth()->user()->affiliation === 'student') {
                $directoryUrl .= '?secret='.urlencode(config('webservices.directory_secret_key'));
            }
            $directoryResponse = $guzzle->get($directoryUrl);
            $directoryResponse = $guzzle->resolveResponseBody($directoryResponse, 'json');
            if (!empty($directoryResponse->people)) {
                auth()->user()->directory_data = $directoryResponse->people;
                auth()->user()->avatar_image = $directoryResponse->people->profile_image;
            }
            if (auth()->user()->affiliation === 'student') {
                $emailUri = strtok(auth()->user()->email, '@');
                auth()->user()->avatar_image = config('webservices.media_url').
                    auth()->user()->affiliation.'/media/'.$emailUri.'/avatar?secret='.
                    config('webservices.media_secret_key').'&source=true';
            }
            auth()->user()->name_coach = config('webservices.media_url').
                auth()->user()->affiliation.'/media/'.strtok(auth()->user()->email, '@').
                '/audio?secret='. config('webservices.media_secret_key').
                '&source=true';
            session()->put('user', auth()->user());
            return redirect()->route('profile.edit.info', auth()->user()->email_uri);
        }
        session()->flash('message', 'Your username or password is invalid.');
        return redirect()->route('home');
    }
}
