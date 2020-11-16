<?php

use App\Category;
use App\Product;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
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
    $products = DB::table('products')->orderBy('created_at','DESC')->take(8)->get();
    $categories = Category::all();
    return view('welcome',array('categories'=>$categories,'products'=>$products ));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/shop','ShopController@shop')->name('shop');
Route::get('/detail/{detail}','ShopController@detail')->name('detail');
Route::get('/filterCategory/{filterCategory}','ShopController@filterCategory')->name('filterCategory');
Route::post('/wishliste','ShopController@wishliste')->name('wishliste');
Route::post('/addToCart','ShopController@addToCart')->name('addToCart');
Route::post('/storer','ShopController@storer')->name('storer');
Route::get('infoedit/{infoedit}','ShopController@infoedit')->name('infoedit');
Route::PATCH('updater/{updater}','ShopController@updater')->name('updater');
Route::get('/cart','ShopController@cart')->name('cart');
Route::delete('delete/{delete}','ShopController@deleter')->name('deleter');
Route::delete('deletefav/{deletefav}','ShopController@deletefav')->name('deletefav');
Route::get('/About','ShopController@about')->name('about');
Route::get('/Favorite','ShopController@favorite')->name('favorite');
Route::get('/Contact','ShopController@contact')->name('contact');
Route::any('/search',function(){
    $q = Request::get('q');
    $products = DB::table('products')->where('title','LIKE','%'.$q.'%')->orWhere('description','LIKE','%'.$q.'%')->get();
    if(count($products) > 0)
                 return view('shops.shopsearch',['products'=>$products]);
    else 
                return redirect('/shop')->with('SearchMessage','Le produit Que vous cherchez ne se trouve pas dans notre list de produit !');
});
Route::get('/TrackProduct','ShopController@tracking')->name('tracking');
Route::get('/PaymentStep','ShopController@PaymentCart')->name('PaymentCart');
Route::get('/MesCommands','ShopController@mycommand')->name('mycommand');








Route::get('/admin','AdminController@index')->name('admin');
Route::get('/addProduct','AdminController@addProduct')->name('addProduct');
Route::post('store','AdminController@store')->name('store');
Route::get('/Categorie','AdminController@categorie')->name('Categorie');
Route::Post('/addCategorie','AdminController@addCategorie')->name('addCategorie');
Route::post('DeleteCategorie','AdminController@DeleteCategorie')->name('DeleteCategorie');
Route::get('/MyProducts','AdminController@MyProducts')->name('MyProducts');
Route::POST('DeleteProducts','AdminController@DeleteProducts')->name('DeleteProducts');
Route::get('editProduct/{editProduct}','AdminController@editProduct')->name('editProduct');
Route::PATCH('updateproduct/{updateproduct}','AdminController@updateproduct')->name('updateproduct');
Route::get('/Allcart','AdminController@Allcart')->name('Allcart');
Route::get('/EditWebsite','AdminController@EditWebsite')->name('EditWebsite');
Route::POST('/StoreEditWebsite','AdminController@StoreEditWebsite')->name('StoreEditWebsite');
Route::get('edit/{edit}','AdminController@edit')->name('edit');
Route::PATCH('update/{update}','AdminController@update')->name('update');
Route::get('/lesClients','AdminController@allusers')->name('allusers');
Route::get('/lesAdministrateurs','AdminController@alladmins')->name('alladmins');
Route::POST('deleteUser','AdminController@deleteUser')->name('deleteUser');
Route::POST('updateUser','AdminController@updateUser')->name('updateUser');
Route::POST('updateAdmin','AdminController@updateAdmin')->name('updateAdmin');
Route::get('/lesCommandes-De-Client','AdminController@ClientCommand')->name('ClientCommand');
Route::get('infoClient/{infoClient}','AdminController@infoClient')->name('infoClient');
Route::POST('/delivery','AdminController@delivery')->name('delivery');
Route::POST('/reception','AdminController@reception')->name('reception');







Route::get('payment', 'PaymentController@index');
Route::post('charge', 'PaymentController@charge');
Route::get('paymentsuccess', 'PaymentController@payment_success');
Route::get('paymenterror', 'PaymentController@payment_error');




 















