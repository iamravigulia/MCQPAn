<?php
use Illuminate\Support\Facades\Route;

// Route::get('greeting', function () {
//     return 'Hi, this is your awesome package! Mcqa';
// });

// Route::get('picmatch/test', 'EdgeWizz\Picmatch\Controllers\PicmatchController@test')->name('test');

Route::post('fmt/mcqpan/store', 'EdgeWizz\Mcqpan\Controllers\McqpanController@store')->name('fmt.mcqpan.store');

Route::post('fmt/mcqpan/update/{id}', 'EdgeWizz\Mcqpan\Controllers\McqpanController@update')->name('fmt.mcqpan.update');

Route::any('fmt/mcqpan/delete/{id}', 'EdgeWizz\Mcqpan\Controllers\McqpanController@delete')->name('fmt.mcqpan.delete');

Route::post('fmt/mcqpan/csv', 'EdgeWizz\Mcqpan\Controllers\McqpanController@csv')->name('fmt.mcqpan.csv');

Route::any('fmt/mcqpan/active/{id}',  'EdgeWizz\Mcqpan\Controllers\McqpanController@active')->name('fmt.mcqpan.active');