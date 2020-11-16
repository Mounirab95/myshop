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
                        <h2>Votre Liste de Favorable</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Details Section Begin -->

    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Votre list de favorable</h2>
                        @if(Session::has('deleteFavorie'))
                       <p class="alert {{ Session::get('alert-class', 'alert-warning') }}"><i class="fas fa-check-circle"> </i> {{ Session::get('deleteFavorie') }}</p>
                         @endif
                    </div>
                    
                </div>
            </div>
            <div class="row featured__filter">
             @if(Auth::check())
                 @forelse(wishlist() as $product)
                 <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                            <div class="featured__item">
                                <div class="featured__item__pic set-bg" alt="" data-setbg="{{asset('storage/'.$product->url)}}">
                                <ul class="featured__item__pic__hover">
                                         <li>
                                            <form action="{{route('deletefav',$product->id)}}" method="POST"> 
                                                @method('DELETE')
                                                @csrf
                                                <button  class="btn btn-warning rounded-circle"><i class="fa fa-trash"></i></button>
                                             </form>                                                
                                         </li>
                                    </ul>
                                </div>
                                <div class="featured__item__text">
                                    
                                    <h6><a href="{{url ('detail',$product->id)}}">{{$product->title}}</a></h6>
                                    <h5>€{{$product->price}}</h5>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                            <div class="featured__item">
                                <div class="featured__item__pic set-bg" alt="image" data-setbg="">
                                </div>
                                <div class="featured__item__text">
                                    
                                    <h6>vide</h6>
                                    <h5>€0</h5>
                                </div>
                            </div>
                        </div>
                    @endforelse
                @else
                <p>vide</p>
            @endif
            </div>
        </div>
    </section>
    <!-- Related Product Section End -->
@include('layouts.footer')