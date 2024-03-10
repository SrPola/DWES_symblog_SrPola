<?php
    namespace App\Controllers;
    use App\Models\Blog;
    use App\Models\Comment;
    use \Respect\Validation\Validator as v;

    class BlogController extends BaseController{
        public function blogsAction($request){
            if ($request->getMethod() == "POST"){
                $validador = v::key('title', v::stringType()->notEmpty())
                    ->key('author', v::stringType()->notEmpty())
                    ->key('blog', v::stringType()->notEmpty())
                    ->key('tags', v::stringType()->notEmpty());
                try {
                    $validador->assert($request->getParsedBody());
                    $blog = new Blog();
                    $blog->title = $request->getParsedBody()['title'];
                    $blog->author = $request->getParsedBody()['author'];
                    $blog->blog = $request->getParsedBody()['blog'];
                    $blog->tags = $request->getParsedBody()['tags'];
                    
                    $files = $request->getUploadedFiles();
                    $image = $files['image'];
                    if ($image->getError() == UPLOAD_ERR_OK) {
                        $fileName = $image->getClientFilename();
                        $fileName = uniqid().$fileName;
                        $image->moveTo("img/$fileName");
                        $blog->image = $fileName;
                    }
                    $blog->save();
                    header("Location: /");
                }
                catch(\Exception $e) {
                    $response = "Error: ".$e->getMessage();
                }
            }
            $data = [
                "response" => $response ?? "",
            ];
            return $this->renderHTML("addBlog_view.twig", $data);
        }

        public function showAction($request) {
            if ($request->getMethod() == "POST"){
                $validador = v::key('comment', v::stringType()->notEmpty());
                try {
                    $validador->assert($request->getParsedBody());
                    $comment = Comment::create([
                        'blog_id' => $_GET["id"],
                        'user' => $_SESSION['user']->user,
                        'comment' => $request->getParsedBody()['comment'],
                        'approved' => 1
                    ]);
                    $comment->save();
                }
                catch(\Exception $e) {}
            }

            $data["blog"] = Blog::find($_GET["id"]);
            $data["allComments"] = array_reverse(array_slice(Blog::getAllComments(Blog::all()), -5));
            $data["tags"] = Blog::printTags();

            $user = ($_SESSION["user"] !== "Invitado") ? $_SESSION["user"]->user : "Invitado";
            $email = ($_SESSION["user"] !== "Invitado") ? $_SESSION["user"]->email : "Invitado";
            $profile = ($_SESSION["profile"] !== "Invitado") ? $_SESSION["user"]->profile : "Invitado";

            return $this->renderHTML("show_view.twig", [
                "blog" => $data["blog"],
                "allComments" => $data["allComments"],
                "tags" => $data["tags"],
                "comments" => array_reverse($data["blog"]->getComments()),
                "numComments" => count($data["blog"]->getComments()),
                "profile" => $profile,
                "user" => $user,
                "email" => $email
            ]);
        }
    }
