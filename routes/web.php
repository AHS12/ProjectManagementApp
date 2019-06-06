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

 /* #region Checking route */
// Route::get('/', function () {

//     return view('welcome')->with([

//         'tasks' => [
//             'task1',
//             'task2',
//             'task 3',
//         ],
//         'foo' => request('title')

//     ]);
// });

//Route::get('/contact', function () {
//     return view('contact');
// });

// Route::get('/about', function () {
//     return view('about');
// });

// Route::get('/', 'PagesController@home');
// Route::get('/contact', 'PagesController@contact');
// Route::get('/about', 'PagesController@about');

/*
GET /projects (index)
GET /projects/create (create)
GET /projects/1 (show)
POST /projects (store)
PUT /projects/1 (update)
GET /projects/1/edit (edit)
PATCH /projects/1 (update)
DELETE /projects/1 (destroy)

 */

/* ---Original ---
Route::get('/projects', 'ProjectsController@index');
Route::get('/projects/create', 'ProjectsController@create');
Route::get('/projects/{project}','ProjectsController@show');
Route::get('/projects/{project}/edit','ProjectsController@edit');
Route::post('/projects', 'ProjectsController@store');
Route::patch('/projects/{project}','ProjectsController@update');
Route::delete('/projects/{project}','ProjectsController@destroy');
 */
/*   --ShoruCut--

Route::resource('projects', 'ProjectsController');
// Route::patch('/tasks/{task}','ProjectTaskController@update');

 */

/* #endregion */


Route::get('/', function () {
    return view('welcome');
});

Route::resource('projects', 'ProjectsController');


Route::post('/projects/{project}/tasks','ProjectTaskController@store');



Route::post('/completed-tasks/{task}','CompletedTaskController@store');
Route::delete('/completed-tasks/{task}','CompletedTaskController@destroy');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

