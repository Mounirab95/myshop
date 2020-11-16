<?php

namespace App\Http\Controllers;

use App\Category;
use App\Photo;
use App\Product;
use App\User;
use App\Userinformation;
use App\Website;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize("admins.admin",true);
        $users = DB::table('users')->select(\DB::raw("count(id) as count"))
                    ->whereMonth('created_at', '=', date('m'))
                    ->where('created_at','>=', Carbon::today()->subDays(5))
                    ->groupBy(\DB::raw("DAY(created_at)"))
                    ->pluck('count'); 
        $orders = DB::table('commands')->select(\DB::raw("SUM(price) as count"))
                    ->whereMonth('created_at', '=', date('m'))
                    ->where('created_at','>=', Carbon::today()->subDays(5))
                    ->groupBy(\DB::raw("DAY(created_at)"))
                    ->pluck('count');               
        $date = User::select(\DB::raw('DATE(created_at) as date'))
                    ->where('created_at','>=', Carbon::today()->subDays(5))
                    ->orderBy('created_at')
                    ->pluck('date'); 
        // return dd($users,$date,$orders);
        return view('admins.dashboard',array('date'=>$date,'users'=>$users),compact('orders'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addProduct()
    {
        $this->authorize("admins.admin",true);

        $categories = Category::all();
        return view('admins.addProduct',['categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $this->authorize("admins.admin",true);

        $product = new Product();
        $product->categorie_id = $request->get('categorie');
        $product->title = $request->get('title');
        $product->description = $request->get('description');
        $product->information = $request->get('description');
        $product->livraison = $request->get('livraison');
        $product->price = $request->get('price');
        $product->reduction = $request->get('reduction');
            if($request->hasFile('miniature')){
                    $product->name= $request->get('title');
                    $product->url= $request->file('miniature')->store('miniature');
                }
        $product->save();

        if($request->hasFile('photos')){
                foreach ($request->file('photos') as $photo){
                    $image = new Photo();
                    $image->product_id = $product->id;
                    $image->categorie_id =$request->get('categorie');
                    $image->name = $product->title;
                    $image->url= $photo->store('image');
                    $image->save();
                }
            }
        return back()->with('successProduct','Le produit est bien ajouter a la base de donner');

    }
            

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $this->authorize("admins.admin",true);

        $idInfo = Website::findorfail($id);
        return view('admins.updateEditwebsite',['idInfo'=>$idInfo]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $this->authorize("admins.admin",true);

        $StoreEditWebsite = Website::findorfail($id);
        $StoreEditWebsite->proposition = $request->get('proposition') ;
        $StoreEditWebsite->facebook = $request->get('facebook') ;
        $StoreEditWebsite->youtube = $request->get('youtube') ;
        $StoreEditWebsite->instagram = $request->get('instagram')  ;
        $StoreEditWebsite->twitter = $request->get('twitter') ;
        $StoreEditWebsite->email = $request->get('email') ;
        $StoreEditWebsite->phone = $request->get('phone') ;
        $StoreEditWebsite->address = $request->get('address') ;
        $StoreEditWebsite->brefinfo = $request->get('bref') ;
        $StoreEditWebsite->about = $request->get('description')  ;
        $StoreEditWebsite->update();
        return redirect('/EditWebsite')->with('EditWebsite','Vous avez bien ajouter les informations de votre site');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function addCategorie(Request $request){
        $this->authorize("admins.admin",true);

        $newCategorie = new Category();
        $newCategorie->categorie = $request->input('newCategorie');
        $newCategorie->save();
        return back()->with('addCatgorie','Votre Categorie a ete bien ajouter dans la base de donner');
    }
    public function categorie(){
        $this->authorize("admins.admin",true);

        return view('admins.addCategorie');
    }
    public function DeleteCategorie(Request $request){
        $this->authorize("admins.admin",true);

        $idCategorie = $request->get('categorie');
        $dataCategorie = DB::table('categories')->where('id','=',$idCategorie)->value("id");
        $product_id = DB::table('products')->where('categorie_id','=',$dataCategorie)->value('id');
        if($product_id){
                DB::table('wishlistes')
                     ->where('categorie_id','=',$dataCategorie)
                     ->delete();
                DB::table('carts')
                    ->where('categorie_id','=',$dataCategorie)
                    ->delete();
                DB::table('photos')
                    ->where('categorie_id','=',$dataCategorie)
                    ->delete();  
                DB::table('commands')
                    ->where('product_id','=',$product_id) 
                    ->delete();
                DB::table('products')
                    ->where('categorie_id','=',$dataCategorie) 
                    ->delete();     
                DB::table('categories')
                    ->where('id','=',$idCategorie)  
                    ->delete();     
        }
        
        return back()->with("deletecategorie","cette categorie a ete bien supprimé");
    }
    public function MyProducts(){
        $this->authorize("admins.admin",true);

        return view('admins.MyProducts');
    }
    public function DeleteProducts(Request $request){
        $this->authorize("admins.admin",true);

        $idProduct = $request->get('product_id');
        $myProduct = DB::table('products')->where('id','=',$idProduct);
        if($myProduct){
                DB::table('wishlistes')
                     ->where('product_id','=',$idProduct)
                     ->delete();
                DB::table('commands')
                     ->where('product_id','=',$idProduct)
                     ->delete();     
                DB::table('carts')
                    ->where('product_id','=',$idProduct)
                    ->delete();
                DB::table('photos')
                    ->where('product_id','=',$idProduct)
                    ->delete();  
                DB::table('products')
                    ->where('id','=',$idProduct) 
                    ->delete();    
        }
        return back()->with('productDeleted','Le produit a ete bien supprimée');
    }
    public function editProduct($id){
        $this->authorize("admins.admin",true);

        $ProductId = Product::findorfail($id);
        return view('admins.EditeProduct',['ProductId'=>$ProductId]);
    }
    public function updateproduct(Request $request,$id){
        $this->authorize("admins.admin",true);

        $ProductId = Product::findorfail($id);
        $ProductId->title = $request->get('title');
        $ProductId->description = $request->get('description');
        $ProductId->information = $request->get('description');
        $ProductId->price = $request->get('price');
        $ProductId->reduction = $request->get('reduction');
        $ProductId->update();

        return  redirect('/MyProducts')->with('updatemessage','Le produit a ete bien mise a jour');


    }
    public function Allcart(){
        $this->authorize("admins.admin",true);

        return view('admins.Allcart');
    }
    public function EditWebsite(){
        $this->authorize("admins.admin",true);

        $AllEditWebsite = Website::all();
        return view('admins.EditWebsite',['AllEditWebsite'=>$AllEditWebsite]);
    }
    public function StoreEditWebsite(Request $request){
        $this->authorize("admins.admin",true);

        $StoreEditWebsite = new Website();
        $StoreEditWebsite->proposition = $request->get('proposition') ;
        $StoreEditWebsite->facebook = $request->get('facebook') ;
        $StoreEditWebsite->youtube = $request->get('youtube') ;
        $StoreEditWebsite->instagram = $request->get('instagram')  ;
        $StoreEditWebsite->twitter = $request->get('twitter') ;
        $StoreEditWebsite->email = $request->get('email') ;
        $StoreEditWebsite->phone = $request->get('phone') ;
        $StoreEditWebsite->address = $request->get('address') ;
        $StoreEditWebsite->brefinfo = $request->get('bref') ;
        $StoreEditWebsite->about = $request->get('description')  ;
        $StoreEditWebsite->save();
        return back()->with('EditWebsite','Vous avez bien ajouter les informations de votre site');
    }
    public function allusers(){
        $this->authorize("admins.admin",true);
        
        $allUsers = DB::table('users')->where('is_admin','=',0)->paginate(10);
        return view('admins.users',['allUsers'=>$allUsers]);
    }
    public function alladmins(){
        $this->authorize("admins.admin",true);
        
        $allAdmins = DB::table('users')->where('is_admin','=',1)->paginate(10);
        return view('admins.admins',['allAdmins'=>$allAdmins]);
    }
    public function deleteUser(Request $request){
        $this->authorize("admins.admin",true);

        $user_id = $request->get('user_id');
        $userById = DB::table('users')->where('id','=',$user_id);
        if($userById){
                DB::table('wishlistes')
                     ->where('user_id','=',$user_id)
                     ->delete();
                DB::table('carts')
                    ->where('user_id','=',$user_id)
                    ->delete();
                DB::table('userinformations')
                    ->where('user_id','=',$user_id)
                    ->delete(); 
                DB::table('commands')
                    ->where('user_id','=',$user_id)
                    ->delete();  
                DB::table('payements')
                    ->where('user_id','=',$user_id)
                    ->delete();
                DB::table('users')
                    ->where('id','=',$user_id)
                    ->delete();    
        }
        return back()->with('userDeleted','Le client a ete bien supprimée');
    }
    public function updateUser(Request $request){
        $this->authorize("admins.admin",true);

        $user_id = $request->get('user_id');
        $updateToAdmin= true;
        DB::table('users')->where('id','=',$user_id)->update(['is_admin'=>$updateToAdmin]);
        return back()->with('updateToAdmin','votre utilisateur est bien ajouter au liste des admins');
    }
    public function updateAdmin(Request $request){
        $this->authorize("admins.admin",true);

        $admin_id = $request->get('admin_id');
        $updateToUser = false;
        DB::table('users')->where('id','=',$admin_id)->update(['is_admin'=>$updateToUser]);
        return back()->with('updateToUser','votre utilisateur est bien ajour');
    }
    public function ClientCommand(){
        $this->authorize("admins.admin",true);

        $ClientCommand = DB::table("commands")
                        ->join('users','users.id','=','commands.user_id')
                        ->join('products','products.id','=','commands.product_id')
                        ->orderBy('commands.created_at','DESC')
                        ->select('commands.id','commands.user_id','users.name','products.title','commands.quantity','commands.livraison','commands.reception')
                        ->paginate(10);
         return view('admins.command',['ClientCommand'=>$ClientCommand]);
    }
    public function infoClient($id)
    {
        $this->authorize("admins.admin",true);
        $idUserInfo = DB::table('userinformations')->where('user_id','=',$id)->get();
        return view('admins.AddressClient',['idUserInfo'=>$idUserInfo]); 
    }
    public function delivery(Request $request){
        $id_command = $request->get('id_command');
        DB::table('commands')->where('id','=',$id_command)->update(['livraison'=>1]);
        return back();
    }
    public function reception(Request $request){
        $id_command = $request->get('id_command');
        DB::table('commands')->where('id','=',$id_command)->update(['reception'=>1]);
        return back();
    }
}
