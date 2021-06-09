<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GoogleTranslate\GoogleTranslateService;

class GoogelTranslateController extends Controller
{
    public $googleTranslateService;

    /**
     * Instantiate a new GoogleTranslateService instance.
     */
    public function __construct(GoogleTranslateService $googleTranslateService)
    {
        $this->googleTranslateService = $googleTranslateService;
    }

    /**
     * Display a result of the translated text.
     *
     * @return \App\Services\GoogleTranslate\GoogleTranslateService
     */
    public function googleFormData(Request $request)
    {
        $response  = $this->googleTranslateService->translateText($request);
        return response()->json($response);
    }
}
    
