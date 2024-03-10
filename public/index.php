<?php
    require_once "../vendor/autoload.php";
    require_once "../bootstrap.php";
    
    use App\Controllers\AdminController;
    use Aura\Router\RouterContainer as Router;
    use App\Controllers\IndexController;
    use App\Controllers\BlogController;
    use App\Controllers\UsersController;
    use App\Controllers\AuthController;

    session_start();

    if (!isset($_SESSION['profile'])) {
        $_SESSION['profile'] = "invitado";
        $_SESSION['user'] = "Invitado";
    }

    $request = \Laminas\Diactoros\ServerRequestFactory::fromGlobals(
        $_SERVER,
        $_GET,
        $_POST,
        $_COOKIE,
        $_FILES
    );

    $router = new Router();
    $rutas = $router->getMap(); 
    $rutas->get('home', '/', [IndexController::class, 'indexAction']);

    $rutas->get('formBlogs', '/blogs', [BlogController::class, 'blogsAction', "auth"=>true]);
    $rutas->post('postBlogs', '/blogs', [BlogController::class, 'blogsAction']);

    $rutas->get('formRegister', '/register', [UsersController::class, 'userAction', "auth"=>true]);
    $rutas->post('addUsers', '/register', [UsersController::class, 'userAction', "auth"=>true]);

    $rutas->get('formLogin', '/login', [AuthController::class, 'loginAction']);
    $rutas->post('tryLogin', '/login', [AuthController::class, 'loginAction']);

    $rutas->get('logout', '/logout', [AuthController::class, 'logoutAction', "auth"=>true]);

    $rutas->get('about', '/about', [IndexController::class, 'aboutAction']);
    $rutas->get('contact', '/contact', [IndexController::class, 'contactAction']);

    $rutas->get("showBlog", "/show", [BlogController::Class, "showAction"]);
    $rutas->post("AddComment", "/show", [BlogController::Class, "showAction", "auth"=>true]);


    $rutas->get('admin', '/admin', [AdminController::class, 'indexAction', "auth"=>true]);



    $route = $router->getMatcher()->match($request);
    if (!$route) {
        exit("No encontramos la ruta buscada");
    }
       
    $handler = $route->handler;
    $needsAuth = $handler['auth'] ?? false;
    
    if ($needsAuth == true && $_SESSION['profile'] == "invitado") {
        header("Location: /login");
    }
    
    $action = $handler[1];
    $controller = new $handler[0];
    $response = $controller->$action($request);
    echo $response->getBody();

