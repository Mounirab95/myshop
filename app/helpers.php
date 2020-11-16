


<?php

use App\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;




function myCategory(){
  
    return  DB::table('categories')->get();  
  }
  function Myproduct(){
    return  DB::table('products')
    ->join('categories','products.categorie_id','=','categories.id')
    ->select('categories.categorie','products.title','products.price','products.reduction','products.url','products.id','products.categorie_id')
    ->orderBy('products.created_at','DESC')
    ->paginate(10);
  }
function productpromo(){
   return  DB::table('products')
   ->join('categories','products.categorie_id','=','categories.id')
   ->select('categories.categorie','products.title','products.price','products.reduction','products.url','products.id','products.categorie_id')
   ->get();
}
function wishlist(){
if(Auth::check()){
  $userId = (Auth::user()->id);
  return DB::table("wishlistes")
            ->where('user_id','=',$userId)
            ->join('products','products.id','=','wishlistes.product_id')
            ->select('products.*')
            ->get();
    }         
}
function wishlistcount(){
    $userId = (Auth::user()->id);
    return DB::table("wishlistes")->where('user_id','=',$userId)->get();
}
function cartcount(){
  $userId = (Auth::user()->id);
  return DB::table("carts")->where('user_id','=',$userId)->get();
}    
function usersinformations(){
  $userId = (Auth::user()->id);
    return DB::table("userinformations")->where('user_id','=',$userId)->get();
} 
function totalPriceCart(){
  if(Auth::check()){
    $condition = DB::table("carts")
    ->where("user_id","=",(Auth::user()->id))
    ->sum("user_id");
      if($condition===0){
        return 0;
        }else{
        $userId = (Auth::user()->id);
        $price = DB::table("carts")
                ->where("user_id","=",$userId)
                ->join("products","products.id","=","carts.product_id")
                ->selectRaw("SUM(products.price * carts.quantity) as price")
                ->value('price');
        return $price;
        }
    }else{
      return 0;
    }
           
  }
  function clientCart(){
    return DB::table('carts')
            ->join('products','products.id','=','carts.product_id')
            ->join('users','users.id','=','carts.user_id')
            ->select('products.title','products.url','users.name')
            ->paginate(6);
  }
  function infowebsite(){
    return DB::table('websites')->select('websites.*')->get();
  }   

  function command(){
    $userId = (Auth::user()->id);
    return DB::table("commands")
              ->where('user_id','=',$userId)
              ->join('products','products.id','=','commands.product_id')
              ->select('products.url','products.title','commands.quantity','commands.id','commands.livraison','commands.reception')
              ->orderBy('commands.created_at','DESC')
              ->paginate(10);
  }
function countCommand(){
  return DB::table("commands")->get();
}
function countSuccessCommand(){
  return DB::table("commands")->where('livraison','=',1)->where('reception','=',1)->get();
}
function countUser(){
  return DB::table("users")->where('is_admin','=',0)->get();
}
function countCart(){
  return DB::table("carts")->get();
}