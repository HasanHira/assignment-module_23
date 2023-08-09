{{-- CSS for Show Passwor Eye Icon --}}
<style>
    #btn-show-pass {
        top: 0.5rem;
        right: 1.1rem;
    }
</style>
{{-- CSS for Show Passwor Eye Icon --}}

<!-- Login Form -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 animated fadeIn col-lg-6 center-screen">
            <div class="card w-90  p-4">
                <div class="card-body">
                    <h4>SIGN IN</h4>
                    <br/>
                    <input id="email" placeholder="User Email" class="form-control" type="email"/>
                    <br/>
                    <div class="show-password-btn--pos">
                        <span id="btn-show-pass"><i class="fa fa-eye-slash"></i></span>
                        <input id="password" placeholder="User Password" class="form-control" type="password"/>
                    </div>
                    <br/>
                    <button onclick="SubmitLogin()" class="btn w-100 btn-primary">Next</button>
                    <hr/>
                    <div class="float-end mt-3">
                        <span>
                            <a class="text-center ms-3 h6" href="{{url('/register-user')}}">Sign Up </a>
                            <span class="ms-1">|</span>
                            <a class="text-center ms-3 h6" href="{{url('/forget-password')}}">Forget Password</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    async function SubmitLogin(){
        let email = document.getElementById('email').value;
        let password = document.getElementById('password').value;

        if(email.length===0){
            errorToast("Email is required.");
        } else if(password.length===0){
            errorToast("Password is required.");
        } else {

            showLoader();
            let response = await axios.post('/user-login', {
                email:email,
                password:password
            });
            hideLoader();

            if(response.status===200 && response.data['status']==='success'){
                window.location.href="/dashboard";
                successToast(response.data['message']);
            } else {
                errorToast(response.data['message']);
            }

        }
    }




// JS for Show Passwor Eye Icon
var btnShowPass = document.querySelector('#btn-show-pass');
var showPass = 0;

btnShowPass.addEventListener('click', function() {
    if (showPass === 0) {
        btnShowPass.nextElementSibling.setAttribute('type', 'text');
        btnShowPass.classList.add('active');
        btnShowPass.querySelector('i').classList.remove('fa-eye-slash');
        btnShowPass.querySelector('i').classList.add('fa-eye');
        showPass = 1;
    } else {
        btnShowPass.nextElementSibling.setAttribute('type', 'password');
        btnShowPass.classList.remove('active');
        btnShowPass.querySelector('i').classList.add('fa-eye-slash');
        btnShowPass.querySelector('i').classList.remove('fa-eye');
        showPass = 0;
    }
});

</script>
