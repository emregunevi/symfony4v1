<?php
/**
 * Created by PhpStorm.
 * User: Emre
 * Date: 6.09.2018
 * Time: 15:06
 */

namespace App\Service;


use Psr\Log\LoggerInterface;

class MessageGenerator
{

    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;

    }


    public function getHappyMessage() {

        $this->logger->info('Emre Günevi');

        $messages = [
            'Selam Emre',
            'Nasılsın?',
            'İyi günler'
        ];

        $index = array_rand($messages);

        return $messages[$index];
    }

}