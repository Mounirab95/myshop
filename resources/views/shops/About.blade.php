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
                        <h2>A Propos du TactilePos</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    
    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
     <div class="container">
         @forelse(infowebsite() as $about)
             <p>{!!html_entity_decode($about->about)!!}</p>
            @empty
             <p>vide</p>
         @endforelse    
        </div>
    </section>
    <!-- Shoping Cart Section End -->

  @include('layouts.footer')