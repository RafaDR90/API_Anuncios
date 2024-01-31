<?php
namespace routes;

use lib\ResponseHttp,
    lib\Security,
    controllers\AnuncioController,
    controllers\UsuarioController,
    lib\Pages;

use FontLib\Table\Type\post;
use lib\Router;
class Routes{
    const PATH="/API_Anuncios";


    /**
     * Obtiene las rutas de la aplicacion
     * @return void
     */
    public static function getRoutes(){
    $router=new Router();

    // CREO CONTROLADORES
    $usuarioController=new UsuarioController();
    $anuncioController=new AnuncioController();

    // PAGINA PRINCIPAL
    $router->get(self::PATH, function () {
        $pages=new Pages();
        $pages->render('landingPage/LandingPageView');
        });

    //USUARIO
        $router->get(self::PATH."/registro", function () use ($usuarioController){
            $usuarioController->showRegister();
        });
        $router->post(self::PATH."/registro", function () use ($usuarioController){
            $usuarioController->showRegister();
        });
        $router->get(self::PATH.'/confirmar-cuenta/$token/$email', function (string $token) use ($usuarioController){
            $usuarioController->autentificarToken($token);
        });
        $router->get(self::PATH.'/login', function () use ($usuarioController){
            $usuarioController->showLogin();
        });
        $router->post(self::PATH.'/login', function () use ($usuarioController){
            $usuarioController->showLogin();
        });
        $router->get(self::PATH.'/cierra-sesion', function () use ($usuarioController){
            $usuarioController->logout();
        });
    //CREA TOKEN
        $router->get(self::PATH.'/actualiza-token', function () use ($usuarioController){
            $usuarioController->creaToken();
        });
        $router->get(self::PATH.'/vista-token',function(){
            $pages=new Pages();
            $pages->render('usuario/TokenView');
        });

    //ANUNCIOS CRUD
        //CREAR
        $router->post(self::PATH.'/crea-anuncio', function () use ($anuncioController){
            $anuncioController->creaAnuncio();
        });
        $router->delete(self::PATH.'/borra-anuncio', function () use ($anuncioController){
            $anuncioController->borraAnuncio();
        });



    // LA PAGINA NO SE ENCUENTRA
        $router->any('/404', function (){
            die("rutanoexiste");
            header('Location: ' . self::PATH . '/error');
            });
        $router->get(self::PATH.'/error', function (){
            ResponseHttp::statusMessage(404, "La pagina no se encuentra");
            });

        // PRUEBAS
        $router->get(self::PATH.'/pruebaauth', function (){
            echo Security::encryptPassword("Rafa");
            });
        $router->get(self::PATH.'/pruebavalidacion', function (){
            echo Security::validatePassword("Rafa", '$2y$10$As1arMFfOxIqsNk/edHNKOw/YD4DhrGYjKd834O1DJhGEBTjOS7P2');
        });
        $router->get(self::PATH.'/pruebakey', function (){
            echo Security::claveSecreta();
        });

        $router->get(self::PATH.'/pruebatoken', function (){
            echo Security::createToken(Security::claveSecreta(), ["nombre"=>"Rafa", "apellido"=>"Garcia","email"=>"rafa@rafa.com"]);
        });

        $router->resolve();
        }

}

?>