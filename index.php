g<?php
require_once "vendor/autoload.php";

$app = new \Slim\Slim();
$app->get("/hola/:nombre",function($nombre) use ($app){
	echo "Hola ".$nombre;
	var_dump($app->request->params());
});

$app->get("/pruebas/:uno/:dos",function($uno,$dos){
	echo $uno."<br>";
	echo $dos."<br>";
})->conditions(array(
	"uno" => "[a-zA-Z]*",
	"dos" => "[0-9]*"
));

$app->group("/api", function() use ($app){
	$app->group("/ejemplo", function() use ($app){
		$app->get("/hola/:nombre", function($nombre){
			echo "Hola ".$nombre;
		})->name("hola");
		$app->get("/apellido/:apellido", function($apellido){
			echo "Tu apellido es ".$apellido;
		});
		$app->get("/mandame-a-hola", function() use (&$app){
			$app->redirect($app->urlFor("hola", array(
				"nombre" => "Alejandro Leiva"
			)));
		});
	});
});
	
$app->run();

?>