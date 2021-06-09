<?php
namespace App\Services\GoogleTranslate;
use Google\Cloud\Translate\V2\TranslateClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GoogleTranslateService {

	public $translate;
    /**
     * Instantiate a new TranslateClient instance.
     */
    public function __construct(TranslateClient $translateClient)
    {
        $this->translate = $translateClient;
    }

    /**
     * Return result of the translated text.
     *
     * @return \App\Services\GoogleTranslate\GoogleTranslateService
     */
	public function translateText($request)
    {
        $result = $this->translate->translate($request->text, [
            'target' => $request->language
        ]);
        $response = [
        	'success' => ($result['text']) ? true : false,
        	'error' => !empty($result['text']) ? '' : 'No result found!',
        	'translation' => $result['text'] ?? null
        ];

        return $response;    
    }
}