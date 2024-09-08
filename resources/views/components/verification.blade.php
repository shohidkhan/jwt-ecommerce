<div class="login_register_wrap section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-md-10">
                <div class="login_wrap">
                    <div class="padding_eight_all bg-white">
                        <div class="heading_s1">
                            <h3>Verification</h3>
                        </div>
                            <div class="form-group mb-3">
                                <input id="code" type="text" required="" class="form-control" name="email" placeholder="Verification Code">
                            </div>
                            <div class="form-group mb-3">
                                <button onclick="verify()" type="submit" class="btn btn-fill-out btn-block" name="login">Confirm</button>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    async function verify(){
        try{
            let code=document.getElementById('code').value;
        if(code.length<4){
            alert('Please Enter 4 Digit Code');
        }else{
            $(".preloader").delay(90).fadeIn(100).removeClass('loaded');
            let email=localStorage.getItem('email');
            let res=await axios.get('/verifyOtp/'+email+'/'+code);
            // console.log(res)
             if(res.status==200){
                if(localStorage.getItem('last_location')){
                    window.location.href=localStorage.getItem('last_location');
                    localStorage.clear();
                }else{
                    window.location.href="/";
                }
             }else{
                $(".preloader").delay(90).fadeOut(100).addClass('loaded');
                alert("Invalid Code or something went wrong");
             }
        }
        }catch(e){
            
            // alert(e.response.data.message)
            if(e.response.status===401){
                $(".preloader").delay(90).fadeIn(100).addClass('loaded');
                // alert(e.response.status);
            }
        }
    }
</script>