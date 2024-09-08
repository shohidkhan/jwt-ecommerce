<!-- START SECTION SHOP -->
<div class="section small_pt pb_70">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-6">
            	<div class="heading_s1 text-center">
                	<h2>Exclusive Products</h2>
                </div>
            </div>
		</div>
        <div class="row">
        	<div class="col-12">
            	<div class="tab-style1">
                    <ul class="nav nav-tabs justify-content-center" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="popular-tab" data-bs-toggle="tab" href="#popular" role="tab" aria-controls="popular" aria-selected="true">popular</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="new-tab" data-bs-toggle="tab" href="#new" role="tab" aria-controls="new" aria-selected="false">new</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="top-tab" data-bs-toggle="tab" href="#top" role="tab" aria-controls="top" aria-selected="false">top</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="special-tab" data-bs-toggle="tab" href="#special" role="tab" aria-controls="special" aria-selected="false">Special
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="trending-tab" data-bs-toggle="tab" href="#trending" role="tab" aria-controls="trending" aria-selected="false">trending
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="regular-tab" data-bs-toggle="tab" href="#regular" role="tab" aria-controls="regular" aria-selected="false">regular
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                	<div class="tab-pane fade show active" id="popular" role="tabpanel" aria-labelledby="popular-tab">
                        <div class="row shop_container" id="popularItem">
                            
                            
                        </div>
                    </div>
                    <div class="tab-pane fade" id="new" role="tabpanel" aria-labelledby="new-tab">
                        <div class="row shop_container" id="newItem">
                            
                        </div>
                    </div>
                    <div class="tab-pane fade" id="top" role="tabpanel" aria-labelledby="top-tab">
                        <div class="row shop_container" id="topItem">
                            
                            
                        </div>
                    </div>
                    <div class="tab-pane fade" id="special" role="tabpanel" aria-labelledby="special-tab">
                        <div class="row shop_container" id="specialItem">
                          
                        </div>
                    </div>
                    <div class="tab-pane fade" id="trending" role="tabpanel" aria-labelledby="trending-tab">
                        <div class="row shop_container" id="trendingItem">
                            
                        </div>
                    </div>
                    <div class="tab-pane fade" id="regular" role="tabpanel" aria-labelledby="regular-tab">
                        <div class="row shop_container" id="regularItem">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>
<!-- END SECTION SHOP -->


<script>
    
    
    async function popular() {
        let res=await axios.get("/productByRemark/popular");
        // console.log()
        $("#popularItem").empty()
        res.data['data'].forEach((item, i) => {
            let eachItem=`
            <div class="col-lg-3 col-md-4 col-6">
                                <div class="product">
                                    <span class="pr_flash ">${item['remark']}</span>
                                    <div class="product_img">
                                        <a href="shop-product-detail.html">
                                            <img src="${item['image']}" alt="product_img1">
                                        </a>
                                        <div class="product_action_box">
                                            <ul class="list_none pr_action_btn">
                                                <li><a href="/product-details?id=${item['id']}" class="popup-ajax"><i class="icon-magnifier-add"></i></a>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product_info">
                                        <h6 class="product_title"><a href="/product-details?id=${item['id']}">${item['title']}</a></h6>
                                        <div class="product_price">
                                            <span class="price">$ ${item.price}</span>
                                            ${item['discount']!=0?`<del>$ ${item['discount']}</del>`:''}
                                            
                                            ${item['discount']!=0?`<div class="on_sale"><span>${item['discount_price']}% Off</span></div>`:''}
                                           
                                        </div>
                                        <div class="rating_wrap">
                                            <div class="rating">
                                                <div class="product_rate" style="width:80%"></div>
                                            </div>
                                            <span class="rating_num">(21)</span>
                                        </div>
                                        <div class="pr_desc">
                                            <p>${item['short_des']}</p>
                                        </div>
                                        <div class="pr_switch_wrap">
                                            <div class="product_color_switch">
                                                <span class="active" data-color="#87554B"></span>
                                                <span data-color="#333333"></span>
                                                <span data-color="#DA323F"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
            `;

            $("#popularItem").append(eachItem);
        })
    }
    async function newProduct(){
        let res=await axios.get("/productByRemark/new");
        $("#newItem").empty()
        res.data['data'].forEach((item, i) => {
            let eachItem=`
            <div class="col-lg-3 col-md-4 col-6">
                                <div class="product">
                                    <span class="pr_flash">${item['remark']}</span>
                                    <div class="product_img"></div>
                                        <a href="shop-product-detail.html">
                                            <img src="${item['image']}" alt="product_img1">
                                        </a>
                                        <div class="product_action_box">
                                            <ul class="list_none pr_action_btn">
                                              
                                                <li><a href="/product-details?id=${item['id']}" class="popup-ajax"><i class="icon-magnifier-add"></i></a></li>
                                            </ul>
                                        </div>
                                    <div class="product_info">
                                        <h6 class="product_title"><a href="/product-details?id=${item['id']}">${item['title']}</a></h6>
                                        <div class="product_price">
                                            <span class="price">$ ${item.price}</span>
                                            ${item['discount']!=0?`<del>$ ${item['discount']}</del>`:''}
                                            
                                            ${item['discount']!=0?`<div class="on_sale"><span>${item['discount_price']}% Off</span></div>`:''}
                                           
                                        </div>
                                        <div class="rating_wrap">
                                            <div class="rating">
                                                <div class="product_rate" style="width:80%"></div>
                                            </div>
                                            <span class="rating_num">(21)</span>
                                        </div>
                                        <div class="pr_desc">
                                            <p>${item['short_des']}</p>
                                        </div>
                                        <div class="pr_switch_wrap">
                                            <div class="product_color_switch">
                                                <span class="active" data-color="#87554B"></span>
                                                <span data-color="#333333"></span>
                                                <span data-color="#DA323F"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
            `;
            $("#newItem").append(eachItem);
        });

    }
    async function topProduct(){
        let res=await axios.get("/productByRemark/top");
        $("#topItem").empty()
        res.data['data'].forEach((item, i) => {
            let eachItem=`
            <div class="col-lg-3 col-md-4 col-6">
                                <div class="product">
                                    <span class="pr_flash">${item['remark']}</span>
                                    <div class="product_img"></div>
                                        <a href="shop-product-detail.html">
                                            <img src="${item['image']}" alt="product_img1">
                                        </a>
                                        <div class="product_action_box">
                                            <ul class="list_none pr_action_btn">
                                                
                                                <li><a href="/product-details?id=${item['id']}" class="popup-ajax"><i class="icon-magnifier-add"></i></a></li>
                                                
                                            </ul>
                                        </div>
                                    <div class="product_info">
                                        <h6 class="product_title"><a href="/product-details?id=${item['id']}">${item['title']}</a></h6>
                                        <div class="product_price">
                                            <span class="price">$ ${item.price}</span>
                                            ${item['discount']!=0?`<del>$ ${item['discount']}</del>`:''}
                                            
                                            ${item['discount']!=0?`<div class="on_sale"><span>${item['discount_price']}% Off</span></div>`:''}
                                           
                                        </div>
                                        <div class="rating_wrap">
                                            <div class="rating">
                                                <div class="product_rate" style="width:80%"></div>
                                            </div>
                                            <span class="rating_num">(21)</span>
                                        </div>
                                        <div class="pr_desc">
                                            <p>${item['short_des']}</p>
                                        </div>
                                        <div class="pr_switch_wrap">
                                            <div class="product_color_switch">
                                                <span class="active" data-color="#87554B"></span>
                                                <span data-color="#333333"></span>
                                                <span data-color="#DA323F"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
            `;
            $("#topItem").append(eachItem);
        });

    }
    async function specialProduct(){
        let res=await axios.get("/productByRemark/special");
        $("#specialItem").empty()
        res.data['data'].forEach((item, i) => {
            let eachItem=`
            <div class="col-lg-3 col-md-4 col-6">
                                <div class="product">
                                    <span class="pr_flash">${item['remark']}</span>
                                    <div class="product_img"></div>
                                        <a href="shop-product-detail.html">
                                            <img src="${item['image']}" alt="product_img1">
                                        </a>
                                        <div class="product_action_box">
                                            <ul class="list_none pr_action_btn">
                                                
                                                <li><a href="/product-details?id=${item['id']}" class="popup-ajax"><i class="icon-magnifier-add"></i></a></li>
                                                
                                            </ul>
                                        </div>
                                    <div class="product_info">
                                        <h6 class="product_title"><a href="/product-details?id=${item['id']}">${item['title']}</a></h6>
                                        <div class="product_price">
                                            <span class="price">$ ${item.price}</span>
                                            ${item['discount']!=0?`<del>$ ${item['discount']}</del>`:''}
                                            
                                            ${item['discount']!=0?`<div class="on_sale"><span>${item['discount_price']}% Off</span></div>`:''}
                                           
                                        </div>
                                        <div class="rating_wrap">
                                            <div class="rating">
                                                <div class="product_rate" style="width:80%"></div>
                                            </div>
                                            <span class="rating_num">(21)</span>
                                        </div>
                                        <div class="pr_desc">
                                            <p>${item['short_des']}</p>
                                        </div>
                                        <div class="pr_switch_wrap">
                                            <div class="product_color_switch">
                                                <span class="active" data-color="#87554B"></span>
                                                <span data-color="#333333"></span>
                                                <span data-color="#DA323F"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
            `;
            $("#specialItem").append(eachItem);
        });

    }
    async function trendProduct(){
        let res=await axios.get("/productByRemark/trending");
        $("#trendingItem").empty()
        res.data['data'].forEach((item, i) => {
            let eachItem=`
            <div class="col-lg-3 col-md-4 col-6">
                                <div class="product">
                                    <span class="pr_flash">${item['remark']}</span>
                                    <div class="product_img"></div>
                                        <a href="shop-product-detail.html">
                                            <img src="${item['image']}" alt="product_img1">
                                        </a>
                                        <div class="product_action_box">
                                            <ul class="list_none pr_action_btn">
                                               
                                                <li><a href="/product-details?id=${item['id']}" class="popup-ajax"><i class="icon-magnifier-add"></i></a></li>
                                                
                                            </ul>
                                        </div>
                                    <div class="product_info">
                                        <h6 class="product_title"><a href="/product-details?id=${item['id']}">${item['title']}</a></h6>
                                        <div class="product_price">
                                            <span class="price">$ ${item.price}</span>
                                            ${item['discount']!=0?`<del>$ ${item['discount']}</del>`:''}
                                            
                                            ${item['discount']!=0?`<div class="on_sale"><span>${item['discount_price']}% Off</span></div>`:''}
                                           
                                        </div>
                                        <div class="rating_wrap">
                                            <div class="rating">
                                                <div class="product_rate" style="width:80%"></div>
                                            </div>
                                            <span class="rating_num">(21)</span>
                                        </div>
                                        <div class="pr_desc">
                                            <p>${item['short_des']}</p>
                                        </div>
                                        <div class="pr_switch_wrap">
                                            <div class="product_color_switch">
                                                <span class="active" data-color="#87554B"></span>
                                                <span data-color="#333333"></span>
                                                <span data-color="#DA323F"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
            `;
            $("#trendingItem").append(eachItem);
        });

    }
    async function regularProduct(){
        let res=await axios.get("/productByRemark/regular");
        $("#regularItem").empty()
        res.data['data'].forEach((item, i) => {
            let eachItem=`
            <div class="col-lg-3 col-md-4 col-6">
                                <div class="product">
                                    <span class="pr_flash">${item['remark']}</span>
                                    <div class="product_img"></div>
                                        <a href="shop-product-detail.html">
                                            <img src="${item['image']}" alt="product_img1">
                                        </a>
                                        <div class="product_action_box">
                                            <ul class="list_none pr_action_btn">
                                                
                                                <li><a href="/product-details?id=${item['id']}" class="popup-ajax"><i class="icon-magnifier-add"></i></a></li>
                                                
                                            </ul>
                                        </div>
                                    <div class="product_info">
                                        <h6 class="product_title"><a href="/product-details?id=${item['id']}">${item['title']}</a></h6>
                                        <div class="product_price">
                                            <span class="price">$ ${item.price}</span>
                                            ${item['discount']!=0?`<del>$ ${item['discount']}</del>`:''}
                                            
                                            ${item['discount']!=0?`<div class="on_sale"><span>${item['discount_price']}% Off</span></div>`:''}
                                           
                                        </div>
                                        <div class="rating_wrap">
                                            <div class="rating">
                                                <div class="product_rate" style="width:80%"></div>
                                            </div>
                                            <span class="rating_num">(21)</span>
                                        </div>
                                        <div class="pr_desc">
                                            <p>${item['short_des']}</p>
                                        </div>
                                        <div class="pr_switch_wrap">
                                            <div class="product_color_switch">
                                                <span class="active" data-color="#87554B"></span>
                                                <span data-color="#333333"></span>
                                                <span data-color="#DA323F"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
            `;
            $("#regularItem").append(eachItem);
        });

    }
    
    
    
</script>