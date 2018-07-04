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


   /************* Levels ***********************/

    Route::get('/', 'PagesController@admin')->name('HomeAdmin');

    Route::group(['prefix' => 'levels'], function() {

      //index
      Route::get('/', 'LevelsController@index')->name('Levels');

      //create
      Route::get('/create', 'LevelsController@create')->name('LevelsCreate');
      Route::post('/store', 'LevelsController@store')->name('LevelsStore');

      //edit
      Route::get('/{level}/edit', 'LevelsController@edit')
        ->where(['id' => '[0-9]+'])
        ->name('LevelsEdit');


      Route::patch('/{level}/edit', 'LevelsController@update')
        ->where(['id' => '[0-9]+'])
        ->name('LevelsUpdate');

      //delete
      Route::delete('/{level}/destroy', 'LevelsController@destroy')
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
    //   Route::get('/{realisation}', 'RealisationsController@show')
    //     ->where(['id' => '[0-9]+'])
    //     ->name('Realisations_show');

      //create
      Route::get('/create', 'RealisationsController@create')->name('RealisationsCreate');
      Route::post('/store', 'RealisationsController@store')->name('RealisationsStore');

      //edit
      Route::get('/{realisation}/edit', 'RealisationsController@edit')
        ->where(['id' => '[0-9]+'])
        ->name('RealisationsEdit');


      Route::patch('/{realisation}/edit', 'RealisationsController@update')
        ->where(['id' => '[0-9]+'])
        ->name('RealisationsUpdate');

      //delete
      Route::delete('/{realisation}/destroy', 'RealisationsController@destroy')
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
      Route::get('/{school}/edit', 'SchoolsController@edit')
        ->where(['id' => '[0-9]+'])
        ->name('SchoolsEdit');


      Route::patch('/{school}/edit', 'SchoolsController@update')
        ->where(['id' => '[0-9]+'])
        ->name('SchoolsUpdate');

      //delete
      Route::delete('/{school}/destroy', 'SchoolsController@destroy')
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
      Route::get('/{hobby}/edit', 'HobbiesController@edit')
        ->where(['id' => '[0-9]+'])
        ->name('HobbiesEdit');


      Route::patch('/{hobby}/edit', 'HobbiesController@update')
        ->where(['id' => '[0-9]+'])
        ->name('HobbiesUpdate');

      //delete
      Route::delete('/{hobby}/destroy', 'HobbiesController@destroy')
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
      Route::get('/{media}/edit', 'MediasController@edit')
        ->where(['id' => '[0-9]+'])
        ->name('MediasEdit');

      //update
      Route::patch('/{media}/edit', 'MediasController@update')
        ->where(['id' => '[0-9]+'])
        ->name('MediasUpdate');

      //delete
      Route::delete('/{media}/destroy', 'MediasController@destroy')
        ->where(['id' => '[0-9]+'])
        ->name('MediasDestroy');

      Route::patch('/{media}/updateCover', 'UpdateCoversController@update')
        ->where(['id' => '[0-9]+'])
        ->name('CoversUpdate');

    });

    Route::group(['prefix' => 'contacts'], function() {

      Route::get('/', 'ContactsController@index')->name('Contacts');

      Route::get('/{contact}', 'ContactsController@show')->name('ContactsShow');
      //
      //
    //   //update
    //   Route::patch('/{media}/edit', 'MediasController@update')
    //     ->where(['id' => '[0-9]+'])
    //     ->name('MediasUpdate');

      //delete
      Route::delete('/{contact}/destroy', 'ContactsController@destroy')->name('ContactsDestroy');

    });

});
