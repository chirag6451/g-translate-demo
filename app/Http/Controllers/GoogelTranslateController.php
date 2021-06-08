<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\GoogelTranslate;
use App\Services\GoogleTranslate\GoogleTranslateService;

class GoogelTranslateController extends Controller
{
    public $googleTranslateService;

    public function __construct(GoogleTranslateService $googleTranslateService)
    {
        $this->googleTranslateService = $googleTranslateService;
    }

    public function googleFormData(Request $request)
    {
        $response  = $this->googleTranslateService->translateText($request);
        return response()->json($response);
    }
}
    