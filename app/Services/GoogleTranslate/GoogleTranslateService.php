<?php
namespace App\Services\GoogleTranslate;
use Google\Cloud\Translate\V2\TranslateClient;
use Illuminate\Http\Request;

class GoogleTranslateService {

    /**
     * The google translateclient service implementation.
     *
     * @var TranslateClient
     */
	protected $translate;

    /**
     * Create a new translateclient instance.
     *
     * @param  TranslateClient  $translateClient
     * @return void
     */
    public function __construct(TranslateClient $translateClient)
    {
        $this->translate = $translateClient;
    }

    /**
     * Return result of the translated text.
     *
     * @param  string  $formdata
     * @return json Response
     */
	public function translateText($request)
    {
        $result = $this->translate->translate($request->text, [
            'target' => $request->language
        ]);
        $response = [
        	'success' => ($result['text']) ? true : false,
        	'error' => !empty($result['text']) ? '' : $validator->errors()->first(),
        	'translation' => $result['text'] ?? null
        ];

        return $response;    
    }
}