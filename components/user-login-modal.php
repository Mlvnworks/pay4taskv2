<?php
  $login_callback = $google->login_callback_url;
?>
<section class="mymodal">
  <div>
    <header class="d-flex align-items-center justify-content-between">
      <h4 class="h4">Log in</h4>
      <button class="btn btn-outline-dark" id="close-modal-btn">
        <i class="bi bi-x"></i>
      </button>
    </header>
    <section id="login-container">
      <form action="./" method="POST" class="mt-4" id="login-form">
        <input type="hidden" name="remember" id="remember" value="false">
        <input type="hidden" name="login">
        <div class="mb-4 d-flex align-items-center input-container">
          <label for="" class="fs-2">
            <i class="bi bi-person"></i>
          </label>
          <input
            type="text"
            name="email"
            class="form-control flex-grow-1"
            placeholder="Email"
            required
          />
        </div>
        <div class="mb-3 d-flex align-items-center input-container">
          <label for=" " class="fs-2">
            <i class="bi bi-key"></i>
          </label>

          <input
            type="password"
            name="password"
            class="form-control flex-grow-1"
            placeholder="Password"
            required
          />
        </div>
        <section>
          <div class="cb-container">
            <label for="cb-remember">
              <input
                type="checkbox"
                name=""
                id="cb-remember"
                class="form-check-input"
              />
              Remember me
            </label>
            <a href="#"> Forgot Password</a>
          </div>
        </section>
        <div class="login-btn-container">
          <button class="w-100" id="login-btn">LOGIN</button>
        </div>
      </form>
      <div class="divider mt-5">
        <hr />
        <p>OR</p>
        <hr />
      </div>
      <section>
         <a class="text-decoration-none" href="<?= $google->generateUrl($login_callback) ?>">
          <button class="w-100 google-btn">
            <i class="google-icon"></i>
             Continue with Google
          </button>
        </a>
      </section>
    </section>

    <p class="mt-3 text-center">
      <small>
        Want to create an account? <a href="./?create-account">Sign up</a>
      </small>
    </p>
  </div>
</section>
<script src="./js/login-signup-modal-controller.js"></script>
<script>
  const rememberMe =document.querySelector("#remember");
  const rememberControl =document.querySelector("#cb-remember");
  const loginButton = document.querySelector("#login-btn");
  const loginForm =document.querySelector("#login-form");
  const inputs = Array.from(loginForm.querySelectorAll("input[name=email], input[name=password]"));



  const submit = () => {
    if(inputs[0].value != "" && inputs[1].value != "" ){
      loginForm.submit();
      loginButton.removeEventListener("click", submit)
    }
  };

  loginButton.addEventListener("click", submit);

  loginForm.addEventListener("submit", (e) => {
    e.preventDefault();
    loginButton.click();
    loginButton.textContent = "Please wait..."
    loginButton.setAttribute("disabled", "true");  
  }
)
  
  rememberControl.addEventListener("input", (e) => {
    rememberMe.value = e.target.checked;
  })
</script>