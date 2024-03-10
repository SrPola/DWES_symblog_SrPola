<?php
    namespace App\Controllers;
    use App\Models\Blog;

    class IndexController extends BaseController{
        public function indexAction(){
            $data = [
                "blogs" => Blog::all(),
                "profile"=> $_SESSION["profile"],
            ];
            return $this->renderHTML("index_view.twig", $data);
        }

        public function aboutAction() {
            return $this->renderHTML("about_view.twig");
        }
        
        public function contactAction() {
            return $this->renderHTML("contact_view.twig");
        }
    }
