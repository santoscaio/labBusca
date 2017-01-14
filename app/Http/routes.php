<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

/**
 * Welcome message
 *
 *
 * @return Response
 */
$app->get('/', function () use ($app) {
	echo 'Busca JSON' . '<br>';
	echo 'Autor: Caio Santos' . '<br>';
	echo 'Email: santoscaio@gmail.com' . '<br>';
});

// Define as rotas para retorno das requisições
$app->get('vaga/{keyword}/{order}/{city}', 'VagaController@select'); //
$app->get('vaga/{keyword}/{order}', 'VagaController@select'); //
$app->get('vaga/{keyword}', 'VagaController@select'); //
$app->get('vaga', 'VagaController@select'); //