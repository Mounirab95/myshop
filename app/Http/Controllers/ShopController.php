<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Category;
use App\Product;
use App\Userinformation;
use App\Wishliste;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    function __construct()
    {
        $this->middleware(['auth', 'verified'])->except(['filterCategory','detail','shop','wishliste','about','favorite','contact',]);
    }
    public function shop(){
        $products = DB::table('products')
                        ->orderBy('created_at','DESC')
                        ->paginate(16);
         return view('shops.shop',array('products'=>$products));
    }
    public function filterCategory($id){
        $filterCategory = Category::findorfail($id);
        $filterProduct = DB::table('products')
                            ->where('categorie_id','=',$id)
                            ->paginate(16);
        $products = DB::table('products')
                            ->orderBy('created_at','DESC')
                            ->get();
        return view('shops.shop-category',array('filterProduct'=>$filterProduct,'filterCategory'=>$filterCategory,'products'=>$products));


    }
    public function detail($id){

        $product =Product::findorfail($id);
        $photo =DB::table('photos')
                           ->select('url')
                           ->where('product_id','=',$id)
                           ->get();
        $lastones = DB::table('products')
                           ->orderBy('created_at','DESC')
                           ->take(8)
                           ->get();
        $categories = Category::all();
        return view('shops.product-detail',array('categories'=>$categories,'product'=>$product,'photo'=>$photo,'lastones'=>$lastones));
    }
    public function wishliste(Request $request){
        $productId = $request->product_id;
        $user_Id=$request->user_id;
        $checkUserIdExists = DB::table('wishlistes')
                                ->where("product_id","=",$productId)
                                ->where("user_id","=",$user_Id)
                                ->first();
        if($checkUserIdExists === null){
            $wishliste = new Wishliste();
            $wishliste->product_id = $productId;
            $wishliste->categorie_id=$request->categorie_id;
            $wishliste->user_id = $user_Id;
            $wishliste->save();
            return back()
                    ->with('addwishlist','Le produit a ete bien ajouter a la liste de favorable');
        }else{
            return back()
                    ->with('errorwishlist','existe deja dans votre liste de favorable');
        }

    }
    public function addToCart(Request $request){

        $productId = $request->product_id;
        $user_Id=$request->user_id;
        $checkUserIdExists = DB::table('carts')
                                ->where("product_id","=",$productId)
                                ->where("user_id","=",$user_Id)
                                ->first();
        if($checkUserIdExists === null){
            $Cart = new Cart();
            $Cart->categorie_id = $request->categorie_id;
            $Cart->product_id = $productId;
            $Cart->user_id = $user_Id;
            $Cart->quantity = $request->quantity;
            $Cart->save();
            return back()
                    ->with('addcart','Le produit a ete bien ajouter dans votre charette');
        }else{
            return back()
                    ->with('errorcart','existe deja dans votre charette');
        }

    }

    public function infoedit($id)
    {
        $idUserInfo = Userinformation::findorfail($id);
        return view('shops.infoedit',['idUserInfo'=>$idUserInfo]); 
    }
    public function updater(Request $request,$id){

        $updateInfoUser = Userinformation::findorfail($id);
        $updateInfoUser->name = $request->name;
        $updateInfoUser->familyname = $request->familyname;
        $updateInfoUser->telephone = $request->tele;
        $updateInfoUser->address = $request->address;
        $updateInfoUser->city = $request->city;
        $updateInfoUser->country = $request->country;
        $updateInfoUser->postale = $request->post;
        $updateInfoUser->update();
        return redirect('home');
    }
    public function storer(Request $request){
        $updateInfoUser = new Userinformation();
        $updateInfoUser->user_id = $request->user_id;
        $updateInfoUser->name = $request->name;
        $updateInfoUser->familyname = $request->familyname;
        $updateInfoUser->telephone = $request->tele;
        $updateInfoUser->address = $request->address;
        $updateInfoUser->city = $request->city;
        $updateInfoUser->country = $request->country;
        $updateInfoUser->postale = $request->post;
        $updateInfoUser->save();
        return back();
    }

    public function cart(){

        $userId = (Auth::user()->id);
        $detailOfProduct = DB::table("carts")
                        ->where("user_id","=",$userId)
                        ->join("products","products.id","=","carts.product_id")
                        ->select("SUM(products.price * carts.quantity) as total")
                        ->select("products.name","products.url","products.price","carts.quantity","carts.id")
                        ->selectRaw("(products.price * carts.quantity) as myprice")
                        ->get();

        $price =DB::table("carts")
                        ->where("user_id","=",$userId)
                        ->join("products","products.id","=","carts.product_id")  
                        ->selectRaw("SUM(products.price * carts.quantity) as total") 
                        ->value("total");   
        //  $totalPricePerProduct =   $quantity*$price ;           
         return view("shops.cart",array('detailOfProduct'=>$detailOfProduct,'price'=>$price));
    }
    public function deleter($id){
        $productCart = Cart::findorfail($id);
        $productCart->delete();
        return back()->with('deleter','Votre produit a été bien supprimer');
    }
    public function deletefav($id){
        $user_id = (Auth::user()->id);
        if ($user_id) {
            DB::table('wishlistes')->where('product_id','=',$id)->where('user_id','=',$user_id)->delete();
        }
        return back()->with('deleteFavorie','Votre produit a été bien supprimer du favorable');
    }
    public function about(){
        return view('shops.About');
    }
    public function favorite(){
        return view('shops.favorite');
    }
    public function contact(){
        return view('shops.contact');
    }
    public function tracking(){
        return view('shops.tracking');
    } 
    public function PaymentCart(){
        $userId = (Auth::user()->id);
        $detailOfProduct = DB::table("carts")
                        ->where("user_id","=",$userId)
                        ->join("products","products.id","=","carts.product_id")
                        ->select("SUM(products.price * carts.quantity) as total")
                        ->select("products.name","products.url","products.price","carts.quantity","carts.id","carts.product_id")
                        ->selectRaw("(products.price * carts.quantity) as myprice")
                        ->get();

        $price =DB::table("carts")
                        ->where("user_id","=",$userId)
                        ->join("products","products.id","=","carts.product_id")  
                        ->selectRaw("SUM(products.price * carts.quantity) as total") 
                        ->value("total");
        return view('shops.PaymentCart',array('detailOfProduct'=>$detailOfProduct,'price'=>$price));
    }
    public function mycommand(){
        $userId = (Auth::user()->id);

        return view('shops.commande');
    }
    
}
