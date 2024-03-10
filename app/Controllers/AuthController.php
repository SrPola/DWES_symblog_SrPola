<?php
    namespace App\Controllers;
    use App\Models\Users;
    use \Respect\Validation\Validator as v;

    class AuthController extends BaseController{
        public function loginAction($request) {
            if ($request->getMethod() == "POST"){
                $validador = v::key('email', v::stringType()->notEmpty())
                    ->key('password', v::stringType()->notEmpty());
                try {
                    $validador->assert($request->getParsedBody());
                    $user = Users::where("email", $request->getParsedBody()['email'])->first();
                    if($user && password_verify($request->getParsedBody()['password'], $user->password)){ 
                            $_SESSION['user'] = $user;
                            $_SESSION['profile'] = $user->profile;
                            header("Location: /admin");
                    } else {
                        $response = "Invalid email or password";
                    }
                }
                catch(\Exception $e) {
                    $response = "Error: ".$e->getMessage();
                }
            }
            $data = [
                "response" => $response ?? "",
            ];
            return $this->renderHTML("login_view.twig", $data);
        }

        public function logoutAction() {
            session_destroy();
            header("Location: /");
        }
    }
