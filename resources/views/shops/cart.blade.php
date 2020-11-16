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
                        <h2>Votre Charette</h2>
                        <div class="breadcrumb__option">
                            <a href="{{route('shop')}}">Bouttique</a>
                            <span>Charette</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    
    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
        @if(Session::has('deleter'))
            <p class="alert {{ Session::get('alert-class', 'alert-danger') }}"><i class="fas fa-check-circle"> </i> {{ Session::get('deleter') }}</p>
        @endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(Auth::check())
                                @forelse($detailOfProduct as $item)
                                    <tr>
                                        <td class="shoping__cart__item">
                                            <img style="width: 130px;height: 100px;" src="{{asset('storage/'.$item->url)}}" alt="">
                                            <h5>{{$item->name}}</h5>
                                        </td>
                                        <td class="shoping__cart__price">
                                            {{$item->price}}€
                                        </td>
                                        <td class="shoping__cart__price">
                                            {{$item->quantity}}
                                        </td>
                                        <td class="shoping__cart__total">
                                        {{$item->myprice}}€ 
                                        </td>
                                        <td class="shoping__cart__item__close">
                                            <form action="{{route('deleter',$item->id)}}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                            <button class="btn btn-default icon_close"></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                <tr>
                                    <td class="shoping__cart__item">
                                        <img style="width: 130px;height: 100px;" src="" alt="">
                                        <h5>Pas de Produit</h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        -
                                    </td>
                                    <td class="shoping__cart__price">
                                       -
                                    </td>
                                    <td class="shoping__cart__total">
                                       -
                                    </td>
                                    <td class="shoping__cart__item__close">
                                    </td>
                                </tr>    
                                @endforelse   
                             @else
                             <tr>
                                    <td class="shoping__cart__item">
                                        <img style="width: 130px;height: 100px;" src="" alt="">
                                        <h5>Pas de Produit</h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        -
                                    </td>
                                    <td class="shoping__cart__price">
                                        -
                                    </td>
                                    <td class="shoping__cart__total">
                                        -
                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <a href="" class="icon_close"></a>
                                    </td>
                                </tr> 
                             @endif   
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="{{route('shop')}}" class="primary-btn cart-btn">CONTUNIER LE SHOPPING</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Total de Charette</h5>
                        <ul>
                            @if(Auth::check())
                            <li>Total <span>{{$price}}€</span></li>
                            @else
                            <li>Total <span>0€</span></li>
                            @endif
                        </ul>
                        <a href="{{route('PaymentCart')}}" class="primary-btn">Valider la methode de paiement</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->

  @include('layouts.footer')