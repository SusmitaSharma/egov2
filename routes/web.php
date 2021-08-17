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

Auth::routes(['register' => false]);

Route::get('/', 'HomeController@index')->name('home');
Route::get('notice-download/{file}', 'HomeController@noticeDownload')->name('notice.download');
Route::get('news-download/{file}', 'HomeController@newsDownload')->name('news.download');
Route::get('publication-download/{file}', 'HomeController@publicationDownload')->name('publication.download');
Route::get('file-download/{file}', 'HomeController@fileDownload')->name('file.download');
Route::get('default-file-download/{file}', 'HomeController@defaultFileDownload')->name('defaultFile.download');
Route::get('news/details/{id}', 'HomeController@newsDetail')->name('news.detail');
Route::get('gallery/images/{gallery}', 'HomeController@galleryImages')->name('gallery.images');
//Route::get('gallery/images/{gallery}', 'PageController@galleryImages')->name('gallery');

//Route::get('about', 'HomeController@about')->name('about');
//Route::get('कर्मचारी-विवरण', 'HomeController@employeeDetail')->name('employee_detail');
//Route::get('notice', 'HomeController@notice')->name('notice');
//Route::get('publication', 'HomeController@publication')->name('publication');
//Route::get('contact', 'HomeController@contact')->name('contact');
//Route::get('download', 'HomeController@download')->name('download');
//Route::get('news', 'HomeController@news')->name('news');
/* Admin Routes */

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'authorized_users']], function () {
    Route::get('/', ['as' => 'admin_home', 'uses' => 'AdminController@index']);
    Route::group(['middleware' => 'role', 'roles' => ['admin']], function () {
        Route::resource('company', 'CompanyController')->only(['index', 'update']);
        Route::get('feedback', 'FeedbackController@index')->name('feedback.index');
        Route::delete('feedback/delete/{id}', 'FeedbackController@delete')->name('feedback.destroy');
        Route::post('load-solution-data', 'FeedbackController@loadData')->name('feedback.load');
        Route::get('get-data/{id}', 'FeedbackController@getData')->name('feedback.getData');
        Route::resource('user', 'UserController');
        Route::post('designation-load', 'DesignationController@loadData')->name('designation.load');
        Route::resource('designation', 'DesignationController');
        Route::resource('gallery', 'GalleryController');
        Route::resource('photo', 'PhotoController');
        Route::resource('slider', 'SliderController');
        Route::resource('news', 'NewsController');
        Route::resource('pageType', 'PageTypeController');
        Route::resource('notice', 'NoticeController');
        Route::resource('notification', 'NotifyController');
        Route::resource('update', 'UpdateController');
        Route::get('/modal/status/{modalId}', 'NotifyController@changeStatus')->name('modal.status');
        Route::get('notice/download/{file}', 'NoticeController@download')->name('notice.download');
        Route::get('publication/download/{file}', 'PublicationController@download')->name('publication.download');
        Route::resource('publication', 'PublicationController');
        Route::get('download/file/{file}', 'DownloadController@download')->name('download.download');
        Route::resource('download', 'DownloadController');
        Route::resource('menu', 'MenuController');
        Route::resource('page', 'PageController');

    });

});

Auth::routes();
Route::get('{page}', 'PageController@show');

