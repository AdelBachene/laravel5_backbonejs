<?php

Route::group(['middleware' => ['web']], function () {
  Route::resource('book', 'BookController', ['except' => ['show']]);
  Route::get('/', function() {
    return redirect('book');
  });
});
