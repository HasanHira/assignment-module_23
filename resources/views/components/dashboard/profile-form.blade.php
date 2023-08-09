{{-- CSS for Show Passwor Eye Icon --}}
<style>
    #btn-show-pass {
        top: 2.9rem;
        right: 1.1rem;
    }
</style>
{{-- CSS for Show Passwor Eye Icon --}}


<!-- Registration Form -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-10 center-screen">
            <div class="card animated fadeIn w-100 p-3">
                <div class="card-body">
                    <h4>User Profile</h4>
                    <hr/>
                    <div class="container-fluid m-0 p-0">
                        <div class="row m-0 p-0">
                            <div class="col-md-4 p-2">
                                <label>First Name</label>
                                <input id="firstName" placeholder="First Name" class="form-control" type="text"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Last Name</label>
                                <input id="lastName" placeholder="Last Name" class="form-control" type="text"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Email Address</label>
                                <input readonly id="email" placeholder="User Email" class="form-control" type="email"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Mobile Number</label>
                                <input id="mobile" placeholder="Mobile" class="form-control" type="mobile"/>
                            </div>
                            <div class="col-md-4 p-2 show-password-btn--pos">
                                <label>Password</label>
                                <span id="btn-show-pass"><i class="fa fa-eye-slash"></i></span>
                                <input id="password" placeholder="User Password" class="form-control" type="password"/>
                            </div>
                        </div>
                        <div class="row m-0 p-0">
                            <div class="col-md-4 p-2">
                                <button onclick="onUpdate()" class="btn mt-3 w-100  btn-primary">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script>


    getProfileDetails();

    async function getProfileDetails(){
        showLoader();
        let response = await axios.get('/user-profile')
        hideLoader();

        if(response.status === 200 && response.data['status'] === 'success'){

            let data = response.data['data'];
            document.getElementById('firstName').value = data['firstName'];
            document.getElementById('lastName').value = data['lastName'];
            document.getElementById('email').value = data['email'];
            document.getElementById('mobile').value = data['mobile'];
            document.getElementById('password').value = data['password'];
        }
        else {
            errorToast(response.data['message']);
        }

    }

    async function onUpdate(){
        let firstName = document.getElementById('firstName').value;
        let lastName = document.getElementById('lastName').value;
        let mobile = document.getElementById('mobile').value;
        let password = document.getElementById('password').value;

        if(firstName.length===0){
            errorToast("First name is required.")
        }
        else if(lastName.length===0){
            errorToast("Last name is required.")
        }
        else if(mobile.length===0){
            errorToast("Mobile number is required.")
        }
        else if(password.length===0){
            errorToast("Password is required.")
        }

        else{
            showLoader();
            let response = await axios.post('/user-update', {
                firstName:firstName,
                lastName:lastName,
                mobile:mobile,
                password:password
            });
            hideLoader();
            if(response.status===200 && response.data['status']==='success'){
                successToast(response.data['message']);
                await getProfileDetails();
            }
            else{
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
