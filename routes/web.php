<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
})->name('/');


//autenticação
Route::get('/cadastrar', 'Authenticate@register_form');
Route::post('/cadastro', 'Authenticate@register');
Route::post('/cursos', 'Authenticate@show');
Route::get('sair', 'Authenticate@logout');

Route::middleware(['login'])->group(function () {
    Route::get('/conteudo', 'Authenticate@main')->name('content');
    
    //Route::view('/sort', 'materiais.sort_material')->name('sorta');
    Route::view('/configuraçoes', 'confg')->name('confg');
    Route::post('/conta', 'Authenticate@edit');
    Route::get('/notas', 'Content@scoreShow')->name('scores');
   
    //cursos
    Route::get('/cursos', 'Course@show');
    Route::post('/cursos/criar', 'Course@create');
    Route::get('/cursos/editar/{id}', 'Course@edit_form');
    Route::post('/cursos/editado', 'Course@edit');
    Route::delete('/cursos/excluir/{id}', 'Course@delete');
    Route::get('/cursos/entrar/{id}', 'Course@enter');
    Route::get('/cursos/alunos/{id}', 'Course@showStudents');
    //Route::view('/cursos/lista_alunos', 'alunos_curso');
    Route::any('/cursos/conteudo/{id}', 'Course@showContent');
    Route::get('/cursos/sair/{id}', 'Course@leaveCourse');

    //professores
    Route::view('/professores', 'teacher.teacher_form')->name('teacher');
    Route::post('/professores/cadastrar', 'Teacher@register');

    //conteudo
    Route::get('/material/{id}', 'Content@show');
    Route::post('/material/criar', 'Content@create');
    Route::get('/material/deletar/{id}', 'Content@delete');
    Route::get('/material/editar/{id}', 'Content@formEdit');
    Route::post('/material/editar', 'Content@edit');
    Route::any('/material/conteudo/{id}', 'Content@specificContent');
    Route::get('/pdf/{id}', 'Content@pdfShow')->name('pdf');
    Route::get('/material/trabalhos/{id}/arquivo/{f_id}', 'Content@evaluate_form');
    Route::post('/material/trabalhos/avaliar', 'Content@evaluate');
    Route::get('/material/nota/{id}/editar', 'Content@scoreEdit');
    Route::post('/material/editando', 'Content@scoreUpdate');

    //comentario
    Route::any('/comentario', 'Comment@write');
    Route::any('/aluno/pdf', 'Content@studentPDF');
});
