<div class="container">
    <div class="d-flex justify-content-center align-items-center vh-100">
        <form method ="post" id="login_form">
            <div id="errors"></div>
            <div class="mb-3">
                <label for="name" class="form-label">Identifiant</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="button" class="btn btn-primary" name="login_button" id="valid-login-btn" >Submit</button>
        </form>
    </div>
</div>
<script src="./_assets/js/services/login.js" type="module"></script>
<script type="module">
    import {login} from "./_assets/js/services/login.js";

    document.addEventListener("DOMContentLoaded",()=>{
        const validLoginBtn = document.querySelector("#valid-login-btn")
        const loginFormElement = document.querySelector("#login_form")
        const errorsElement = document.querySelector("#errors")
        validLoginBtn.addEventListener("click",async ()=>{
            if (!loginFormElement.checkValidity()){
                loginFormElement.reportValidity()
                return false
            }
            const loginResult = await login(loginFormElement.elements["name"].value,loginFormElement.elements["password"].value)
            if(loginResult.hasOwnProperty("authentication")){
                document.location.href = 'index.php'
            }else if(loginResult.hasOwnProperty('errors')){
                const errors = []
                for (let i = 0; i<loginResult.error.length;i++){
                    errors.push(`<div class="alert alert-danger" role="alert">${loginResult.error[i]}</div>`)
                }
                errorsElement.innerHTML = errors.join('')
            }
        })
    })
</script>