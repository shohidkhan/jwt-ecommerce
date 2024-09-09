<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 mb-4 mb-md-0">
                <div class="product-image">
                    <div class="product_img_box">
                        <img id="product_img1" class="w-100" src='assets/images/product_img1.jpg' />
                    </div>
                    <div class="row p-2">
                        <a href="#" class="col-3 product_img_box p-1">
                            <img id="img1" src="assets/images/product_small_img3.jpg"/>
                        </a>
                        <a href="#" class="col-3 product_img_box p-1">
                            <img id="img2" src="assets/images/product_small_img3.jpg"/>
                        </a>
                        <a href="#" class="col-3 product_img_box p-1">
                            <img id="img3" src="assets/images/product_small_img3.jpg" alt="product_small_img3" />
                        </a>
                        <a href="#" class="col-3 product_img_box p-1">
                            <img id="img4" src="assets/images/product_small_img3.jpg" alt="product_small_img3" />
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6">
                <div class="pr_detail">
                    <div class="product_description">
                        <h4 id="p_title" class="product_title"></h4>
                        <h1 id="p_price"  class="price"></h1>
                    </div>
                    <div>
                        <p id="p_des"></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <label class="form-label">Size</label>
                        <select id="p_size" class="form-select">
                        </select>
                    </div>

                    <div class="col-lg-6">
                        <label class="form-label">Color</label>
                        <select id="p_color" class="form-select">

                        </select>
                    </div>
                </div>


                    <hr />
                    <div class="cart_extra">
                        <div class="cart-product-quantity">
                            <div class="quantity">
                                <input type="button" value="-" class="minus">
                                <input id="p_qty" type="text" name="quantity" value="1" title="Qty" class="qty" size="4">
                                <input type="button" value="+" class="plus">
                            </div>
                        </div>
                        <div class="cart_btn">
                            <button onclick="AddToCart()" class="btn btn-fill-out btn-addtocart" type="button"><i class="icon-basket-loaded"></i> Add to cart</button>
                            <a class="add_wishlist" onclick="AddToWishList()" href="#"><i class="icon-heart"></i></a>
                        </div>
                    </div>
                    <hr />
                </div>
            </div>
        </div>
</div>


<script>
    $('.plus').on('click',function(){
        if($(this).prev().val()){
           $(this).prev().val(+$(this).prev().val() + 1);
        }
    });
    $('.minus').on('click', function() {
        if ($(this).next().val() > 1) {
            if ($(this).next().val() > 1) $(this).next().val(+$(this).next().val() - 1);
        }
    });

    let searchParams=new URLSearchParams(window.location.search);
    let id=searchParams.get('id');
    async function ProductDetails(){
        let res=await axios.get("/productDetailsById/"+id);
        let details=res.data['data'];
        document.getElementById('product_img1').src=details['img1'];
        document.getElementById('img1').src=details['img1'];
        document.getElementById('img2').src=details['img2'];
        document.getElementById('img3').src=details['img3'];
        document.getElementById('img4').src=details['img4'];

        document.getElementById('p_title').innerText=details['product']['title'];
        document.getElementById('p_price').innerText=`$ ${details['product']['price']}`;
        document.getElementById('p_des').innerText=details['product']['short_des'];
        document.getElementById('p_des').innerText=details['des'];
        document.getElementById('p_details').innerHTML=details['des'];

        // console.log(details.des)

        let sizes=details.size.split(',');	
        let colors=details.color.split(',');
        // console.log(sizes,colors)

        let SizeOption=`<option value=''>Choose Size</option>`;

        $('#p_size').append(SizeOption);

        sizes.forEach((item,i)=>{
            let eachSize=`
                <option value="${item}">${item}</option>
            `;
            $('#p_size').append(eachSize);
        });


        let ColorOption=`<option value=''>Choose Color</option>`;
        $('#p_color').append(ColorOption);

        colors.forEach((item,i)=>{
            let eachColor=`
                <option value="${item}">${item}</option>
            `;
            $('#p_color').append(eachColor);
        });

    }

    async function AddToCart(){
        try{
            let size= document.getElementById('p_size').value;
            let color= document.getElementById('p_color').value;
            let qty= document.getElementById('p_qty').value;

            if(size.length==0){
                alert("Please Select Size");
                return;
            } else if(color.length==0){
                alert("Please Select Color");
                return;
            } else if(qty==0){
                alert("Please Select Quantity");
                return;
            }else{
                $(".preloader").delay(90).fadeOut(100).addClass('loaded');
                let res=await axios.post('/createCartList',{
                    "product_id":id,
                    "size":size,
                    "color":color,
                    "qty":qty
                });
                $(".preloader").delay(90).fadeOut(100).addClass('loaded');
                if(res.status==200){
                    await cartDropDown();
                    await countCart();
                    // console.log(res.status)
                    alert("Product Added To Cart");
                }
            }
        }catch(err){
        
            if(err.response.status===401){
                localStorage.setItem('last_location',window.location.href)
                window.location.href="/userLoginPage"
            }
        }
    }
    async function AddToWishList(){
        // alert(id)

        try{
            $(".preloader").delay(90).fadeOut(100).removeClass('loaded');
            let res=await axios.get('/createWishList/'+id);
            $(".preloader").delay(90).fadeOut(100).addClass('loaded');
            if(res.status===200){
                alert("Product Added To WishList");
            }
        }catch(err){
            if(err.response.status===401){
                localStorage.setItem('last_location',window.location.href)
                window.location.href="/userLoginPage"
            }
        }
    }
    async function productReview(){
        let res = await axios.get("/listReviewByProduct/"+id);
        let Details=await res.data['data'];
        // console.log(Details)

        $("#reviewList").empty();

        Details.forEach((item,i)=>{
            let each= `<li class="list-group-item">
                <h6>${item['customer']['cus_name']}</h6>
                <p class="m-0 p-0">${item['description']}</p>
                <div class="rating_wrap">
                    <div class="rating">
                        <div class="product_rate" style="width:${parseFloat(item['rating'])}%"></div>
                    </div>
                </div>
            </li>`;
           $("#reviewList").append(each);
        })
    }

    async function AddReview(){
        try{

            let reviewText=document.getElementById('reviewTextID').value;
            let reviewScore=document.getElementById('reviewScore').value;
            if(reviewText.length==0){
                alert("Please Enter Review");

            }else if(reviewScore==0){
                alert("Please Enter Rating Score");            
    
            }else{
                $(".preloader").delay(90).fadeOut(100).removeClass('loaded');
                let res=await axios.post('/createProductReview',{
                    "product_id":id,
                    "description":reviewText,
                    "rating":reviewScore
                });
                
                $(".preloader").delay(90).fadeOut(100).addClass('loaded');
                if(res.status===200){
                    document.getElementById('reviewTextID').value="";
                    document.getElementById('reviewScore').value="";
                    await productReview();
                    alert("Review Added");
                }
            }
        }catch(er){
            if(er.response.status===401){
                localStorage.setItem('last_location',window.location.href)
                window.location.href="/userLoginPage"
            }
        }

    }
</script>