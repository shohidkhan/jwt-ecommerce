<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="page-title">
                    <h1>Policy: <span id="plolicyType"></span></h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="{{url("/")}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">This Page</a></li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>

<div class="mt-5">
    <div class="container my-5">
        <div class="row">
            <div id="policy" class="col-12">

            </div>
        </div>
    </div>
</div>

<script>

    async function policy(){
        let searchParams= new URLSearchParams(window.location.search);
        let type=searchParams.get('type');
        let res=await axios.get("/policyByType/"+type);
      
        $('#policy').html(res.data.data.des);
        $('#plolicyType').text(res.data.data.type);
    }
</script>