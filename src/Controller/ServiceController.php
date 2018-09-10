<?php
/**
 * Created by PhpStorm.
 * User: Emre
 * Date: 5.09.2018
 * Time: 10:07
 */

namespace App\Controller;


use App\Service\CommonService;
use Symfony\Component\Translation\TranslatorInterface;

class ServiceController
{
    public $translator;
    public $commonService;

    function __construct(TranslatorInterface $translator , CommonService $commonService){
        $this->translator = $translator;
        $this->commonService = $commonService;

    }

}