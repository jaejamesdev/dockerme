<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use InvalidArgumentException;

class DockerMeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'docker:me';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sets your project up for local development with Docker!';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        echo "DockerMe | A Simple Package To Get You Up & Running With Docker!\r\n";
        echo "Downloading docker-compose.yml..\r\n";
        $this->findAndStore('docker-compose.yml');
        echo "Downloaded docker-compose.yml.";
        echo "Downloading web.dockerfile...\r\n";
        $this->findAndStore('web.dockerfile');
        echo "Downloaded web.dockerfile.\r\n";
        echo "Downloading vhost.conf...\r\n";
        $this->findAndStore('vhost.conf');
        echo "Downloaded vhost.conf.\r\n";
        echo "Downloading php.dockerfile...\r\n";
        $this->findAndStore('php.dockerfile');
        echo "That's Everything Downloaded!\r\n";
        echo "You Can Get Started By Using The Laravel Default MySQL Values In Your .env File!\r\n";
        echo "Don't Forget To Run docker-compose up!";
    }

    public function findAndStore($fileName)
    {
        try {
            $fileToStore = file_get_contents('https://raw.githubusercontent.com/jaejamesdev/local-laravel-docker/master/' . $fileName);
            file_put_contents($fileName, $fileToStore);
        } catch (Exception $e) {
            try {
                echo "Hmmmm... Something Went Wrong! Attempting To Save Log...\r\n";
                file_put_contents('docker-me-log.txt', $e->getMessage());
                echo "Saved Error To docker-me-log.txt, Please Report Error On: https://github.com/jaejamesdev/dockerme/issues";
            } catch (Exception $e) {
                echo "Sorry, We Couldn't Save To The Log File :( Please Paste The Below Exception On: https://github.com/jaejamesdev/dockerme/issues";
                echo $e->getMessage();
            }
        }


    }
}
