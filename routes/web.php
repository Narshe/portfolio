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


//Route::get('/', 'PagesController@underConstruction')->name('underContruct');
Route::get('/', 'PagesController@home')->name('home');
Route::post('/contact/store', 'ContactsController@store')->name('ContactStore');


Route::group(['prefix' => 'adminBlablaNomATrouver', 'middleware' => 'auth.basic.once'], function() {
//************* Levels ***********************/

    Route::get('/', 'PagesController@admin')->name('HomeAdmin');

    Route::group(['prefix' => 'levels'], function() {

      //index
      Route::get('/', 'LevelsController@index')->name('Levels');

      //show
      Route::get('/{id}', 'LevelsController@show')
        ->where(['id' => '[0-9]+'])
        ->name('Skill_show');

      //create
      Route::get('/create', 'LevelsController@create')->name('LevelsCreate');
      Route::post('/store', 'LevelsController@store')->name('LevelsStore');

      //edit
      Route::get('/{id}/edit', 'LevelsController@edit')
        ->where(['id' => '[0-9]+'])
        ->name('LevelsEdit');


      Route::patch('/{id}/edit', 'LevelsController@update')
        ->where(['id' => '[0-9]+'])
        ->name('LevelsUpdate');

      //delete
      Route::delete('/{id}/destroy', 'LevelsController@destroy')
        ->where(['id' => '[0-9]+'])
        ->name('LevelsDestroy');

    });

//Route::resource('SkillCategories', 'SkillCategoriesController');
//************* Categories ***********************/
    Route::group(['prefix' => 'Categories'], function() {

      //index
      Route::get('/', 'CategoriesController@index')->name('Categories');

      //create
      Route::get('/create', 'CategoriesController@create')->name('CategoriesCreate');
      Route::post('/store', 'CategoriesController@store')->name('CategoriesStore');

      //edit
      Route::get('/{category}/edit', 'CategoriesController@edit')
        ->name('CategoriesEdit');


      Route::patch('/{category}/edit', 'CategoriesController@update')
        ->where(['id' => '[0-9]+'])
        ->name('CategoriesUpdate');

      //delete
      Route::delete('/{category}/destroy', 'CategoriesController@destroy')
        ->name('CategoriesDestroy')
        ->where(['id' => '[0-9]+']);

    });

    Route::group(['prefix' => 'skills'], function() {

      //index
      Route::get('/', 'SkillsController@index')->name('Skills');


      //create
      Route::get('/create', 'SkillsController@create')->name('SkillsCreate');
      Route::post('/store', 'SkillsController@store')->name('SkillsStore');

      //edit
      Route::get('/{skill}/edit', 'SkillsController@edit')
        ->where(['id' => '[0-9]+'])
        ->name('SkillsEdit');


      Route::patch('/{skill}/edit', 'SkillsController@update')
        ->where(['id' => '[0-9]+'])
        ->name('SkillsUpdate');

      //delete
      Route::delete('/{skill}/destroy', 'SkillsController@destroy')
        ->where(['id' => '[0-9]+'])
        ->name('SkillsDestroy');

    });



    Route::group(['prefix' => 'realisations'], function() {

      //index
      Route::get('/', 'RealisationsController@index')->name('Realisations');

      //show
      Route::get('/{id}', 'RealisationsController@show')
        ->where(['id' => '[0-9]+'])
        ->name('Realisations_show');

      //create
      Route::get('/create', 'RealisationsController@create')->name('RealisationsCreate');
      Route::post('/store', 'RealisationsController@store')->name('RealisationsStore');

      //edit
      Route::get('/{id}/edit', 'RealisationsController@edit')
        ->where(['id' => '[0-9]+'])
        ->name('RealisationsEdit');


      Route::patch('/{id}/edit', 'RealisationsController@update')
        ->where(['id' => '[0-9]+'])
        ->name('RealisationsUpdate');

      //delete
      Route::delete('/{id}/destroy', 'RealisationsController@destroy')
        ->where(['id' => '[0-9]+'])
        ->name('RealisationsDestroy');

    });

    Route::group(['prefix' => 'schools'], function() {

      //index
      Route::get('/', 'SchoolsController@index')->name('Schools');

      //create
      Route::get('/create', 'SchoolsController@create')->name('SchoolsCreate');
      Route::post('/store', 'SchoolsController@store')->name('SchoolsStore');

      //edit
      Route::get('/{id}/edit', 'SchoolsController@edit')
        ->where(['id' => '[0-9]+'])
        ->name('SchoolsEdit');


      Route::patch('/{id}/edit', 'SchoolsController@update')
        ->where(['id' => '[0-9]+'])
        ->name('SchoolsUpdate');

      //delete
      Route::delete('/{id}/destroy', 'SchoolsController@destroy')
        ->where(['id' => '[0-9]+'])
        ->name('SchoolsDestroy');

    });

    Route::group(['prefix' => 'hobbies'], function() {

      //index
      Route::get('/', 'HobbiesController@index')->name('Hobbies');

      //create
      Route::get('/create', 'HobbiesController@create')->name('HobbiesCreate');
      Route::post('/store', 'HobbiesController@store')->name('HobbiesStore');

      //edit
      Route::get('/{id}/edit', 'HobbiesController@edit')
        ->where(['id' => '[0-9]+'])
        ->name('HobbiesEdit');


      Route::patch('/{id}/edit', 'HobbiesController@update')
        ->where(['id' => '[0-9]+'])
        ->name('HobbiesUpdate');

      //delete
      Route::delete('/{id}/destroy', 'HobbiesController@destroy')
        ->where(['id' => '[0-9]+'])
        ->name('HobbiesDestroy');

    });

    Route::group(['prefix' => 'medias'], function() {

      //index
      Route::get('/', 'MediasController@index')->name('Medias');

      //create
      Route::get('/create', 'MediasController@create')->name('MediasCreate');
      Route::post('/store', 'MediasController@store')->name('MediasStore');

      //edit
      Route::get('/{id}/edit', 'MediasController@edit')
        ->where(['id' => '[0-9]+'])
        ->name('MediasEdit');

      //update
      Route::patch('/{id}/edit', 'MediasController@update')
        ->where(['id' => '[0-9]+'])
        ->name('MediasUpdate');

      //delete
      Route::delete('/{id}/destroy', 'MediasController@destroy')
        ->where(['id' => '[0-9]+'])
        ->name('MediasDestroy');

      Route::get('/{id}/updateCover', 'MediasController@updateCover')
        ->where(['id' => '[0-9]+'])
        ->name('MediasUpdateCover');

    });

});
