@include('layouts.header')

                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{asset('frontend')}}/img/breadcrumbtest.png">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>TactilePos</h2>
                        <div class="breadcrumb__option">
                            <a href="{{url('/')}}">Accueil</a>
                            <span>Boutique</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>Cathegories</h4>
                            <ul>
							@foreach(myCategory() as $category)
                            <li><a href="{{url('filterCategory',$category->id)}}">{{$category->categorie}}</a></li>
							@endforeach
                            </ul>
                        </div>

                        <div class="sidebar__item">
                            <div class="latest-product__text">
                                <h4>Nouveau Produit</h4>
                                <div class="latest-product__slider owl-carousel">
                                    <div class="latest-prdouct__slider__item">
                                        @forelse($products->slice(0, 3) as $item)
                                        <a href="{{url ('detail',$item->id)}}" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img style="width:110px;height:110px;" src="{{asset('storage/'.$item->url)}}" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6 href="{{url ('detail',$item->id)}}">{{$item->title}}</h6>
                                                <span>€{{$item->price}}</span>
                                            </div>
                                        </a>
                                        @empty
                                        <p>Pas de produit dans la base de donner</p>
                                        @endforelse     
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    
                    <div class="filter__item">
                        <div class="container">
                            <div class="">
                            @if(Session::has('addwishlist'))
                             <p class="alert {{ Session::get('alert-class', 'alert-success') }}"><i class="fas fa-check-circle"> </i> {{ Session::get('addwishlist') }}</p>
                            @endif
                            @if(Session::has('errorwishlist'))
                             <p class="alert {{ Session::get('alert-class', 'alert-danger') }}"><i class="fas fa-check-circle"> </i> {{ Session::get('errorwishlist') }}</p>
                            @endif
                            @if(Session::has('SearchMessage'))
                             <p class="alert {{ Session::get('alert-class', 'alert-danger') }}"><i class="fas fa-check-circle"> </i> {{ Session::get('SearchMessage') }}</p>
                            @endif
                            <div class="filter__found">
                                    <h6><span>{{count($products)}}</span> Produits trouvez</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @forelse($products as $product)
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="{{asset('storage/'.$product->url)}}">
                                    <ul class="product__item__pic__hover">
                                    @if(Auth::check())
                                         <li>
                                            <form action="{{route('wishliste')}}" method="POST"> 
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ Auth::user()->id}}">
                                                <input type="hidden" value="{{$product->id}}" name="product_id"> 
                                                <input type="hidden" value="{{$product->categorie_id}}" name="categorie_id"> 
                                                <button  class="btn btn-danger rounded-circle"><i class="fa fa-heart"></i></button>
                                             </form>
                                            
                                                
                                         </li>
                                        @else
                                        <li><a href="{{ route('login') }}"><i class="fa fa-heart"></i></a></li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="{{url ('detail',$product->id)}}">{{$product->title}}</a></h6>
                                    <h5>€{{$product->price}}</h5>
                                </div>
                            </div>
                        </div>
                        @empty
                        <p>no data</p>
                        @endforelse
                    </div>
                    <div>
                        {{$products->links()}}
                    </div>
                </div>
			</div>
			<div class="product__discount">
                        <div class="section-title">
                            <h2>Promotion</h2>
                        </div> 
                        <div class="row">
                            <div class="product__discount__slider owl-carousel">
                                @forelse(productpromo() as $promo)
                                    @if($promo->reduction != 0)
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg"
                                            data-setbg="{{asset('storage/'.$promo->url)}}">
                                            <div class="product__discount__percent">-{{$promo->reduction}}%</div>
                                            <ul class="product__item__pic__hover">
                                            @if(Auth::check())
                                         <li>
                                            <form action="{{route('wishliste')}}" method="POST"> 
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ Auth::user()->id}}">
                                                <input type="hidden" value="{{$promo->id}}" name="product_id"> 
                                                <input type="hidden" value="{{$promo->categorie_id}}" name="categorie_id"> 
                                                <button  class="btn btn-danger rounded-circle"><i class="fa fa-heart"></i></button>
                                             </form>
                                             
                                         </li>
                                        @else
                                        <li><a href="{{ route('login') }}"><i class="fa fa-heart"></i></a></li>
                                        @endif
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span>{{$promo->categorie}}</span>
                                            <h5><a href="{{url ('detail',$promo->id)}}">{{$promo->title}}</a></h5>
                                            <div class="product__item__price">€{{$promo->price}}</div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @empty
                                <p>vide</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
		</div>
		
    </section>
    <!-- Product Section End -->

	

	@include('layouts.footer')