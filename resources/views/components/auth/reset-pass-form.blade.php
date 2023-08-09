{{-- CSS for Show Passwor Eye Icon --}}
<style>
    #btn-show-pass {
        top: 2.3rem;
        right: 1.1rem;
    }
</style>
{{-- CSS for Show Passwor Eye Icon --}}

<!-- Reset Pass Form -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6 center-screen">
            <div class="card animated fadeIn w-90 p-4">
                <div class="card-body">
                    <h4>SET NEW PASSWORD</h4>
                    <br/>
                    <div class="show-password-btn--pos">
                        <label>New Password</label>
                        <span id="btn-show-pass"><i class="fa fa-eye-slash"></i></span>
                        <input id="password" placeholder="New Password" class="form-control" type="password"/>
                    </div>
                    <br/>
                    <div class="show-password-btn--pos">
                        <label>Confirm Password</label>
                        <span hidden id="btn-show-conf-pass"></span>
                        <input id="conpassword"  placeholder="Confirm Password" class="form-control" type="password"/>
                    </div>
                    <br/>
                    <button onclick="ResetPass()" class="btn w-100  btn-primary">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>


<script>

    async function ResetPass(){
        let password = document.getElementById('password').value;
        let conpassword = document.getElementById('conpassword').value;
        if(password.length===0){
            errorToast('Password is required.')
        } else if(conpassword.length===0){
            errorToast('Confirm Password is requirde also.')
        } else if(password!==conpassword){
            errorToast('Password & Confirm Password must be same')
        } else {
            showLoader()
            let response = await axios.post('/reset-password', {
                password:password
            });
            hideLoader()

            if(response.status===200 && response.data['status']==='success'){
                successToast(response.data['message']);
                setTimeout(() => {
                    window.location.href='/login-user';
                }, 1000);
            } else {
                errorToast(response.data['message'])
            }
        }
    }



// JS for Show Passwor Eye Icon
var btnShowPass = document.querySelector('#btn-show-pass');
var btnShowConfPass = document.querySelector('#btn-show-conf-pass');
var showPass = 0;

btnShowPass.addEventListener('click', function() {
    if (showPass === 0) {
        btnShowPass.nextElementSibling.setAttribute('type', 'text');
        btnShowConfPass.nextElementSibling.setAttribute('type', 'text');
        btnShowPass.classList.add('active');
        btnShowPass.querySelector('i').classList.remove('fa-eye-slash');
        btnShowPass.querySelector('i').classList.add('fa-eye');
        showPass = 1;
    } else {
        btnShowPass.nextElementSibling.setAttribute('type', 'password');
        btnShowConfPass.nextElementSibling.setAttribute('type', 'password');
        btnShowPass.classList.remove('active');
        btnShowPass.querySelector('i').classList.add('fa-eye-slash');
        btnShowPass.querySelector('i').classList.remove('fa-eye');
        showPass = 0;
    }
});

</script>
