<?php

namespace App\Services\GoogleTranslate\Providers;

use App\Services\GoogleTranslate\GoogleTranslateService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use Google\Cloud\Translate\V2\TranslateClient;

/**
 * Class GoogleTranslateServiceProvider
 *
 * @package App\Services\GoogleTranslate\Providers
 */
class GoogleTranslateServiceProvider extends ServiceProvider implements DeferrableProvider
{
		/**
	     * Register services.
	     *
	     * @return void
	     */
	    public function register()
	    {

	    	$this->mergeConfigFrom(
	            __DIR__ . '/../Config/google_translate.php', 'google_translate'
	        );

	        $this->registerGoogleTranslateFacade();
	    }

	    /**
	     * Bootstrap services.
	     *
	     * @return void
	     */
	    public function boot()
	    {
	        //
	    }

	    /**
	     * Register facade.
	     *
	     * @return void
	     */
	    private function registerGoogleTranslateFacade()
	    {
	        $this->app->bind(GoogleTranslateService::class, function ($app) {
	            return new GoogleTranslateService(
	                new TranslateClient($this->googleTranslateClientConfig())
	            );
	        });
	        $this->app->bind('GoogleTranslateService', GoogleTranslateService::class);
	    }

	    /**
	     * Get the services provided.
	     *
	     * @return array
	     */
	    public function provides()
	    {
	        return [GoogleTranslateService::class, 'GoogleTranslateService'];
	    }

	    /**
	     * Return the Config for using the GoogleTranslate Service
	     *
	     * @return array
	     */
	    private function googleTranslateClientConfig()
	    {
	        return [
	            'key' => config('google_translate.cloud_transalion_api')
	        ];
	    }
}