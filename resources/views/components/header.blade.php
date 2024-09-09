<!-- START HEADER -->
<header class="header_wrap fixed-top header_with_topbar">
	<div class="top-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                	<div class="d-flex align-items-center justify-content-center justify-content-md-start">
                        <div class="lng_dropdown me-2 from-group">
                            <select name="countries" class="custome_select form-control">
                                <option value='en' data-image="assets/images/eng.png" data-title="English">English</option>
                                <option value='fn' data-image="assets/images/fn.png" data-title="France">France</option>
                                <option value='us' data-image="assets/images/us.png" data-title="United States">United States</option>
                            </select>
                        </div>
                        <div class="me-3 form-gorup">
                            <select name="countries" class="custome_select form-control">
                                <option value='USD' data-title="USD">USD</option>
                                <option value='EUR' data-title="EUR">EUR</option>
                                <option value='GBR' data-title="GBR">GBR</option>
                            </select>
                        </div>
                        <ul class="contact_detail text-center text-lg-start">
                            <li><i class="ti-mobile"></i><span>123-456-7890</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                	<div class="text-center text-md-end">
                       	<ul class="header_list">
                            
                            @if(Cookie::get('token')!== null)
                            <li><a href="{{ route('logout') }}" class="btn btn-sm btn-danger">Logout</a></li>
                            <li><a href="{{ route('profilePage') }}"><i class="ti-user"></i><span>Account</span></a></li>
                            <li><a href="{{ route('wishlistPage') }}"><i class="ti-heart"></i><span>Wishlist</span></a></li>
                            @else 
                            <li><a href="{{ route('userLoginPage') }}"><i class="ti-user"></i><span>Login</span></a></li>
                            @endif
						</ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom_header dark_skin main_menu_uppercase">
    	<div class="container">
            <nav class="navbar navbar-expand-lg"> 
                <a class="navbar-brand" href="index.html">
                    <img class="logo_light" src="{{ asset('frontend') }}/assets/images/logo_light.png" alt="logo" />
                    <img class="logo_dark" src="{{ asset('frontend') }}/assets/images/logo_dark.png" alt="logo" />
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-expanded="false"> 
                    <span class="ion-android-menu"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li class="dropdown">
                            <a data-bs-toggle="dropdown" class="nav-link dropdown-toggle active" href="#">Home</a>
                            <div class="dropdown-menu">
                                <ul> 
                                    <li><a class="dropdown-item nav-link nav_item active" href="index.html">Fashion 1</a></li>
                                    <li><a class="dropdown-item nav-link nav_item" href="index-2.html">Fashion 2</a></li>
                                    <li><a class="dropdown-item nav-link nav_item" href="index-3.html">Furniture 1</a></li>
                                    <li><a class="dropdown-item nav-link nav_item" href="index-4.html">Furniture 2</a></li>
                                    <li><a class="dropdown-item nav-link nav_item" href="index-5.html">Electronics 1</a></li>
                                    <li><a class="dropdown-item nav-link nav_item" href="index-6.html">Electronics 2</a></li>
                                </ul>
                            </div>   
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle nav-link" href="#" data-bs-toggle="dropdown">Shop</a>
                            <div class="dropdown-menu">
                                <ul id="category"> 
                                    
                                </ul>
                            </div>
                        </li>

                        <li>
                            <a class="nav-link nav_item" href="{{ route('cartPage') }}">Cart</a>
                        </li>
                        
                        <li><a class="nav-link nav_item" href="contact.html">Contact Us</a></li> 
                    </ul>
                </div>
                <ul class="navbar-nav attr-nav align-items-center">
                    <li><a href="javascript:;" class="nav-link search_trigger"><i class="linearicons-magnifier"></i></a>
                        <div class="search_wrap">
                            <span class="close-search"><i class="ion-ios-close-empty"></i></span>
                            <form>
                                <input type="text" placeholder="Search" class="form-control" id="search_input">
                                <button type="submit" class="search_icon"><i class="ion-ios-search-strong"></i></button>
                            </form>
                        </div><div class="search_overlay"></div>
                    </li>
                    <li class="dropdown cart_dropdown"><a class="nav-link cart_trigger" href="#" data-bs-toggle="dropdown"><i class="linearicons-cart"></i><span class="cart_count" id="cart_count">0</span></a>
                        <div class="cart_box dropdown-menu dropdown-menu-right">
                            <ul class="cart_list" id="cart_list_item">
                                
                                
                            </ul>
                            <div class="cart_footer">
                                <p class="cart_total">
                                    <strong >Subtotal:</strong> 
                                    <span class="cart_price"> <span class="price_symbole">$</span>
                                </span> <span id="subtotal"></span> </p>
                                <p class="cart_buttons"><a href="{{ route('cartPage') }}" class="btn btn-fill-line rounded-0 view-cart">View Cart</a><a href="#" class="btn btn-fill-out rounded-0 checkout">Checkout</a></p>
                            </div>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>
<!-- END HEADER -->


<script>
    countCart();
    cartDropDown();
    async function category(){
        let res=await axios.get("/categories");
        
        $("#category").empty()
        res.data['data'].forEach((item,i)=>{
            // console.log(item)
            let EachItem= `
            <li><a class="dropdown-item nav-link nav_item" href="/by-category?id=${item.id}">${item.categoryName}</a></li>
            `
            $("#category").append(EachItem)
        })	
    }
    async function countCart(){
        let res=await axios.get("/cart-count");
        $("#cart_count").text(res.data['data']);
    }
    async function cartDropDown(){
        let res=await axios.get("/cartList");

        $("#cart_list_item").empty();
        res.data['data'].forEach((item,i)=>{
            // console.log(item)
            let EachItem= `
            <li>
                <span class="item_remove remove" data-id="${item['product_id']}"><i class="ion-close"></i></span>
                <a href="#"><img src="${item['product']['image']}" alt="cart_thumb1">${item['product']['title']}</a>
                <span class="cart_quantity"> ${item['qty']} x <span class="cart_amount"> <span class="price_symbole">$</span>${item['product']['price']}</span></span>
            </li>
            `
            $("#cart_list_item").append(EachItem)
        });

        $('.remove').on('click',function(){
            let id=$(this).data('id');
            removeCart(id);
        })
        await cartSubTotal(res.data['data']);
    }

    async function cartSubTotal(data){
        let Total=0;
        data.forEach((item,i)=>{
            Total=Total+parseFloat(item['price']);
        })
        // console.log(Total)
        $("#subtotal").text(Total);
    }

    async function removeCart(id){
        $(".preloader").delay(90).fadeOut(100).removeClass('loaded');
        let res=await axios.get('/removeCartList/'+id);
        $(".preloader").delay(90).fadeOut(100).addClass('loaded');
        if(res.status===200){
            await cartDropDown();
            await countCart();
            await carts();
        }else{
            alert('Something went wrong')
        }
    }
</script>