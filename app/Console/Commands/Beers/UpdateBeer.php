<?php

namespace App\Console\Commands\Beers;

use Illuminate\Console\Command;
use Illuminate\Http\Client\Factory;
use Illuminate\Support\Facades\Http;

class UpdateBeer extends Command
{
    private Factory $httpClient;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Beer:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Factory $httpClient)
    {
        parent::__construct();
        $this->httpClient = $httpClient;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(Factory $httpClient)
    {
        $response = $this->httpClient->get('https://example.p.rapidapi.com/?rapidapi-key=');
        $response=  $response->json();
        dump($response);



        return 0;
    }
}
