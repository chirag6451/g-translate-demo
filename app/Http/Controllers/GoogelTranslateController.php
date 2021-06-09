<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GoogleTranslate\GoogleTranslateService;
use Illuminate\Support\Facades\Validator;

class GoogelTranslateController extends Controller
{
    /**
     * The google translate service implementation.
     *
     * @var GoogleTranslateService
     */
    protected $googleTranslateService;

    /**
     * Create a new GoogleTranslateService instance.
     *
     * @param  GoogleTranslateService  $googleTranslateService
     * @return void
     */
    public function __construct(GoogleTranslateService $googleTranslateService)
    {
        $this->googleTranslateService = $googleTranslateService;
    }

    /**
     * Validate request and display a result of the translated text.
     *
     * @param  string  $formdata
     * @return json Response
     */
    public function googleFormData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'text'     => 'required',
            'language' => 'required',
        ]);

        if ($validator->fails()) {
            $response['success']        = false;
            $response['error']          = $validator->errors()->first();
            $response['translation']    = $request->get('text');
            return response()->json($response);            
        }

        $response  = $this->googleTranslateService->translateText($request);
        return response()->json($response);
    }
}