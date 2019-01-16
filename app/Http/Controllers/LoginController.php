<?php

namespace Alpha\Http\Controllers;

use Carbon\Carbon;
use CSUNMetaLab\Guzzle\Factories\HandlerGuzzleFactory;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * @var
     */
    private $mTimestamp;

    /**
     * LoginController constructor.
     */
    public function __construct()
    {
        $this->mTimestamp = Carbon::now();
    }

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
            $directoryResponse = $guzzle->resolveResponseBody($directoryResponse, 'json');
            if (!empty($directoryResponse->people)) {
                auth()->user()->directory_data = $directoryResponse->people;
                auth()->user()->avatar_image = $directoryResponse->people->profile_image.
                    '?version='.$this->getFormattedTime();
            }
            if (auth()->user()->affiliation === 'student') {
                $emailUri = strtok(auth()->user()->email, '@');
                auth()->user()->avatar_image = config('webservices.media_url').
                    auth()->user()->affiliation.'/media/'.$emailUri.'/avatar?version='.
                    $this->getFormattedTime().'&?secret='.config('webservices.media_secret_key').'&?source=true';
            }
            session()->put('user', auth()->user());
            return redirect()->route('profile.edit.info', auth()->user()->email_uri);
        }
        session()->flash('message', 'Your username or password is invalid.');
        return redirect()->route('home');
    }

    /**
     * @return string
     */
    private function getFormattedTime()
    {
        return $this->mTimestamp->year.$this->mTimestamp->hour.$this->mTimestamp->minute.$this->mTimestamp->second;
    }
}
