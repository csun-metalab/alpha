<?php

namespace Alpha\Http\Controllers;

use CSUNMetaLab\Guzzle\Factories\HandlerGuzzleFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEditInfo()
    {
        return view('pages.profile.edit-info');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEditImage()
    {
        return view('pages.profile.edit-image');
    }

    /**
     * @param Request $request
     * @param $emailUri
     * @return array
     */
    public function postStoreImage(Request $request, $emailUri)
    {
        $validator = Validator::make($request->all(),
            [
                'profile_image' => [
                    'required',
                    function ($attribute, $value, $fail) {
                        if (!base64_decode($value)) {
                            return $fail('Please include '.$attribute. ' it is required.');
                        }
                    }],
                'entity_type' => 'required|string',
                'image_type' => 'required|string'
            ]);
        if ($validator->fails()) {
            return [
                'status' => '422',
                'success' => 'false',
                'message' => $validator->messages()->all()
            ];
        }
        if ($request->profile_image) {
            $guzzle = HandlerGuzzleFactory::fromDefaults();
            $guzzle->setFormBody([
                'profile_image' => $request->profile_image,
                'image_type' => $request->image_type,
                'entity_type' => $request->entity_type,
                'secret_key' => config('webservices.media_secret_key')
            ]);
            $response = $guzzle->post(config('webservices.media_url').$emailUri.'/photo');
            $guzzleResponse = $guzzle->resolveResponseBody($response, 'json');
            if ($guzzleResponse->status === '200') {
                return [
                    'status' => '200',
                    'success' => 'true',
                    'message' => 'The image for '.$emailUri.' was successfully uploaded.'
                ];
            } else {
                return [
                    'status' => '400',
                    'success' => 'false',
                    'message' => 'An error occurred, please try again.'
                ];
            }
        }
    }

    /**
     * @param Request $request
     * @param $emailUri
     * @return array
     */
    public function postStoreInfo(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'biography' => 'required|string',
                'confidential' => 'required|boolean',
                'display_name' => 'required|string',
                'nickname' => 'nullable|sometimes|string'
            ]);
        if ($validator->fails()) {
            return [
                'status' => '422',
                'success' => 'false',
                'message' => $validator->messages()->all()
            ];
        }
        $guzzle = HandlerGuzzleFactory::fromDefaults();
        $guzzle->setJsonBody([
            'email' => $request->email,
            'biography' => $request->biography,
            'confidential' => $request->confidential,
            'display_name' => $request->display_name,
            'nick_name' => $request->nickname,
        ]);
        $guzzle->setHeader('X-API-Key' , config('webservices.directory_secret_key'), false);
        $response = $guzzle->put(config('webservices.directory_url').'members/update-info');
        $guzzleResponse = $guzzle->resolveResponseBody($response, 'json');
        if ($guzzleResponse->status === '200') {
            return response()->json([
                'status' => '200',
                'success' => 'true',
                'message' => 'Your information was successfully updated.'
            ]);
        } else {
            return response()->json([
                'status' => '400',
                'success' => 'false',
                'message' => 'An error occurred, please try again.'
            ]);
        }
    }
}
