<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function (){

Route::resource('Usuarios','UserController')->middleware('role:admin');

Route::resource('Proyectos', 'ProjectController');

Route::resource('Archivos','FilesController',['except'=>['edit','update']]);

Route::resource('Investigadores','ResearchesController');

});

Route::get('/pruebaAESC',function (){

    $process = new Process("python C:\laragon\www\Guardian\AES_Scripts/AES.py -c -f C:\laragon\www\Guardian\AES_Scripts\MLP2.rar");
    $process->run();

    // executes after the command finishes
    if (!$process->isSuccessful()) {
        throw new ProcessFailedException($process);
    }

    echo $process->getOutput();
});
Route::get('/pruebaAESD',function (){

    $process = new Process("python C:\laragon\www\Guardian\AES_Scripts/AES.py -d -f C:\laragon\www\Guardian\AES_Scripts\MLP2.rar -k EdT1TuYIlsZnaquSOSVuHA==");
    $process->run();

    // executes after the command finishes
    if (!$process->isSuccessful()) {
        throw new ProcessFailedException($process);
    }

    echo $process->getOutput();
});

Route::get('/pruebaShamirD',function (){

    $process = new Process("python C:\laragon\www\Guardian\AES_Scripts/Secret_Sharing.py -k EdT1TuYIlsZnaquSOSVuHA==");
    $process->run();

    // executes after the command finishes
    if (!$process->isSuccessful()) {
        throw new ProcessFailedException($process);
    }


    echo $process->getOutput();
});

Route::get('/prueba',function (){

});