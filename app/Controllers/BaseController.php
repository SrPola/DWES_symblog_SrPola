<?php
    namespace App\Controllers;
    use Twig\Loader\FilesystemLoader;
    
    use Laminas\Diactoros\Response\HtmlResponse;

    class BaseController {
        protected $templateEngine;
        public function __construct() {
            $loader = new FilesystemLoader('../app/Views');
            $this->templateEngine = new \Twig\Environment($loader, [
                'debug' => true,
                'cache' => false
            ]);

        }
        public function renderHTML($fileName, $data = []) {
            return new HtmlResponse($this->templateEngine->render($fileName, $data));
        }
    }
