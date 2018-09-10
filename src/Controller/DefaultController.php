<?php
/**
 * Created by PhpStorm.
 * User: Emre
 * Date: 5.09.2018
 * Time: 08:37
 */

namespace App\Controller;



use App\Service\MessageGenerator;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class DefaultController extends AbstractController
{
    private $translator;
    private $commonservice;
    private $logger;

    function __construct (ServiceController $serviceController, LoggerInterface $logger)
    {
        $this->translator = $serviceController->translator;
        $this->commonservice = $serviceController->commonService;
        $this->logger = $logger;

    }

    public function number (Request $request,$max){
        try{
            $number = random_int(0,$max);

            $this->logger->info($number);

            return $this->render('number.html.twig',['number' => $number]);
           /* return new Response(
                '<html><body>Lucky number: '.$number. '</body></html>'
            );*/

        }catch (\Exception $exception){
            return new JsonResponse(['hasError'=>true, 'data'=>'', 'msg'=>$exception->getMessage()]);
        }

    }

    public function makeList (Request $request) {
        try{
            $list = ['one'=>'Emre','two'=>'Gunevi','three'=>'Canakkale','four'=>'Deneme'];

            return $this->render('blog.html.twig',['lists'=>$list]);

        }catch (\Exception $exception){
            return new JsonResponse(['hasError'=>true, 'data'=>'', 'msg'=>$exception->getMessage()]);
        }
    }

    public function showList (Request $request) {
        try{
            $list = ['one'=>'Emre','two'=>'Gunevi','three'=>'Canakkale','four'=>'Deneme'];

            return $this->render('blog.html.twig',['lists'=>$list]);

        }catch (\Exception $exception){
            return new JsonResponse(['hasError'=>true, 'data'=>'', 'msg'=>$exception->getMessage()]);
        }
    }

    public function locationRoutes (Request $request){
        try{

            $translated = [];

            $translated['one'] = $this->translator->trans('one');
            $translated['two'] = $this->translator->trans('two');
            $translated['three'] = $this->translator->trans('three');
            $translated['four'] = $this->translator->trans('four');




            return $this->render('blog.html.twig',['translated'=>$translated]);

        }catch (\Exception $exception){
            return new JsonResponse(['hasError'=>true, 'data'=>'', 'msg'=>$exception->getMessage()]);
        }

    }

    public function index (Request $request){
        try{

            //return $this->redirectToRoute('homepage');

            //return $this->redirectToRoute('homepage',array(),301);

            //return $this->redirectToRoute('homepage',array('max'=> 10));

            //return $this->redirect('https://www.google.com');

            // Server işlemleri
           $request->server->get('HTTP_HOST');

            //uploadfile
            //$request->files->get('foo');

            // retrieves an HTTP request header, with normalized, lowercase keys
            //$this->commonservice->printR($request->headers->get('host'));
           // $this->commonservice->printR($request->headers);

/*
            $product= ['computer','printer'];

            if(!$product){
                throw $this->createNotFoundException('Product is not exist');
            }
             return new JsonResponse('Product is exists');
*/
            $name = 'Emre';
            // Response dönüşü yapma
            //return new Response('Hello '.$name,Response::HTTP_OK);

            //Json dönüşü yapma
            return $this->json(array('username'=> 'emre.gunevi'));



        }catch (\Exception $exception){
            return new JsonResponse(['hasError'=>true, 'data'=>'', 'msg'=>$exception->getMessage()]);
        }

    }

    public function download (Request $request) {
        try{
            $folder = $this->getParameter('kernel.project_dir') . '/public/files/Deneme.pdf';
            //$this->commonservice->printR($folder);
            $file = new File($folder);
            //isim değiştirerek download etme işlemi
            //return $this->file($file,'DenemeYeni.pdf');

            // Dosyayı ekranda gösterme işlemi
            return $this->file($folder, 'DenemeYeni.pdf', ResponseHeaderBag::DISPOSITION_INLINE);

        }catch (\Exception $exception){
            return new JsonResponse(['hasError'=>true, 'data'=>'', 'msg'=>$exception->getMessage()]);
        }
    }

    public function templateExample (Request $request) {
        try{

            $entries = ['title'=> 'Deneme','body' => 'body deneme'];


            return $this->render('example.html.twig',array('entries'=>$entries));


        }catch (\Exception $exception){
            return new JsonResponse(['hasError'=>true, 'data'=>'', 'msg'=>$exception->getMessage()]);
        }

    }

    public function showMessage (MessageGenerator $messageGenerator) {

        $message = $messageGenerator->getHappyMessage();
        $this->addFlash('info',$message);

        return $this->render('example.html.twig');
    }

    




}