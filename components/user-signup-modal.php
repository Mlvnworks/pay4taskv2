<?php
 if(isset($_GET["ref"])){

    // setcookie('ref-used', filterValue($_GET["ref"]), time() + 86400, '/');

    echo "<script>
                document.cookie = 'ref-used={$_GET["ref"]}; path=/; max-age=' + 86400;
            </script>";
  }


  $registration_callback = $google->registration_callback_url;
?>

<section class="mymodal">
  <div>
    <header class="d-flex align-items-center justify-content-between">
      <h4 class="h4">Create Account</h4>
      <button class="btn btn-outline-dark" id="close-modal-btn">
        <i class="bi bi-x"></i>
      </button>
    </header>
    <section id="otp-container" class="d-none"></section>
    <section id="signup-container">
      <form action="" class="mt-4" id="signup-form">
        <input type="hidden" name="user-registration" id="user-registration" />
        <div class="mb-4 d-flex align-items-center input-container">
          <label for="" class="fs-2">
            <i class="bi bi-person"></i>
          </label>
          <input
            type="email"
            name=""
            id="email-input"
            class="form-control flex-grow-1"
            placeholder="Email"
            required
          />
        </div>
        <div class="d-flex align-items-center input-container">
          <label for=" " class="fs-2">
            <i class="bi bi-key"></i>
          </label>

          <input
            type="password"
            name=""
            id="password-input"
            class="form-control flex-grow-1"
            placeholder="Create Password"
            required
          />
        </div>
        <p class="text-secondary mb-3">
          <small>A password should be longer than six characters.</small>
        </p>
        <div class="create-account-btn-container">
          <button class="w-100" id="continue-btn" >Continue</button>
        </div>
      </form>
      <div class="divider mt-5">
        <hr />
        <p>OR</p>
        <hr />
      </div>
      <section>
        <a class="text-decoration-none" href="<?= $google->generateUrl($registration_callback)?>">
          <button class="w-100 google-btn">
          <i class="google-icon"></i>
          Continue with Google
          </button>
        </a>
      </section>
    </section>
    <p class="mt-3 text-center">
      <small> Already have an account? <a href="./">Log in</a> </small>
    </p>
  </div>
</section>
<script src="./js/login-signup-modal-controller.js"></script>
<script src="./js/user-signup-modal.js"></script>

