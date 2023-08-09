<!-- Verify OTP Form -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6 center-screen">
            <div class="card animated fadeIn w-90  p-4">
                <div class="card-body">
                    <h4>ENTER OTP CODE</h4>
                    <br/>
                    <label>6 Digits Code Here</label>
                    <input id="code" placeholder="Code" class="form-control" type="text"/>
                    <br/>
                    <button onclick="VerifyOtp()"  class="btn w-100 float-end btn-primary">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>


<script>

    async function VerifyOtp(){
        let otp = document.getElementById('code').value;
        if(otp.length!==6){
            errorToast("Please, put the right otp from your email.")
        }else{

            showLoader();
            let response = await axios.post('/verify-otp', {
                email:sessionStorage.getItem('email'),
                otp:otp
            });
            hideLoader();
            if(response.status===200 && response.data['status']==='success'){
                successToast(response.data['message']);
                sessionStorage.clear();
                setTimeout(() => {
                    window.location.href='/reset-password';
                }, 1000);
            } else {
                errorToast(response.data['message']);
            }

        }
    }

</script>
