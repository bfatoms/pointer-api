<?php



Route::get('api/pointer/customers/{id}', 'Wemade\Pointer\PointerCustomer@read');
Route::get('api/pointer/customers', 'Wemade\Pointer\PointerCustomer@browse');
Route::post('api/pointer/customers', 'Wemade\Pointer\PointerCustomer@add');
Route::put('api/pointer/customers/{id}', 'Wemade\Pointer\PointerCustomer@edit');
Route::delete('api/pointer/customers/{id}', 'Wemade\Pointer\PointerCustomer@delete');


