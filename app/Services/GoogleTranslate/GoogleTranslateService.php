<?php
namespace App\Services\GoogleTranslate;
use Google\Cloud\Translate\V2\TranslateClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GoogleTranslateService {

	public $translate;
    public function __construct(TranslateClient $translateClient)
    {
        $this->translate = $translateClient;
    }

	public function translateText($request)
    {

        $result = $this->translate->translate($request->get('text'), [
            'target' => $request->get('language')
        ]);

        $response = [
        	'success' => ($result['text']) ? true : false,
        	'error' => !empty($result['text']) ? '' : 'No result found!',
        	'translation' => $result['text'] ?? null
        ];

        return $response;    
    }
}