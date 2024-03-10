<?php
    namespace App\Controllers;

    class AdminController extends BaseController{
        public function indexAction($request) {
            $data = [
                "user" => $_SESSION['user']->name,
                'email'=> $_SESSION['user']->email,
            ];
            return $this->renderHTML("admin_view.twig", $data);
        }
    }
