<?php

Route::resource('notes', 'NoteController', [
    'parameters' => [
        'notes' => 'note'
    ]
]);

Route::get('lists-notes-and-categories', 'NoteController@listNotesAndCategories');