<?php
    namespace App\Controllers;
    use App\Models\Users;
    use \Respect\Validation\Validator as v;

    class UsersController extends BaseController{
        public function userAction($request){
            if ($request->getMethod() == "POST"){
                $validador = v::key('user', v::stringType()->notEmpty())
                    ->key('password', v::stringType()->notEmpty())
                    ->key('email', v::stringType()->notEmpty())
                    ->key('profile', v::stringType()->notEmpty());
                try {
                    $validador->assert($request->getParsedBody());
                    $user = new Users();
                    $user->user = $request->getParsedBody()['user'];
                    $user->password = password_hash($request->getParsedBody()['password'], PASSWORD_BCRYPT);
                    $user->email = $request->getParsedBody()['email'];
                    $user->profile = $request->getParsedBody()['profile'];
                    $user->save();
                    header("Location: /");
                }
                catch(\Exception $e) {
                    $response = "Error: ".$e->getMessage();
                }
            }
            $data = [
                "response" => $response ?? "",
            ];
            return $this->renderHTML("register_view.twig", $data);
        }
    }
