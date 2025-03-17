const emailInput = document.querySelector("#email-input");
const passwordInput = document.querySelector("#password-input");
const signupForm = document.querySelector("#signup-form");
const continueBtn = document.querySelector("#continue-btn");
const signupContainer = document.querySelector("#signup-container");
const otpContainer = document.querySelector("#otp-container");
const verificationIdInput = document.querySelector("#user-registration");

//  NAVIGATE TO GOOGLE AUTH
const navigate = (url) => {
  location.href = url;
};

// SUBMIT REGISTRATION
const sumbitRegistration = () => {
  signupForm.removeEventListener("submit", onContinue);
  signupForm.removeAttribute("disabled");
  signupForm.setAttribute("action", "./");
  signupForm.setAttribute("method", "POST");

  signupForm.submit();
};

// SHOW OT WARNING
const showWarning = (message) => {
  if (otpContainer.firstElementChild.id === "warning-label") {
    otpContainer.firstElementChild.remove();
  }

  const warningLabel = document.createElement("p");
  warningLabel.id = "warning-label";
  warningLabel.textContent = message;
  warningLabel.classList = "bg-danger text-light mt-3 p-3 opacity-50";
  otpContainer.prepend(warningLabel);
};
// CHECK OTP
const checkOtp = (otpEntered, verificationDetails) => {
  if (otpEntered !== verificationDetails.otp_code) {
    showWarning("Incorrect OTP!");
  } else {
    const currentTimeStamp = Math.floor(Date.now() / 1000);

    if (parseInt(verificationDetails.expiration) < currentTimeStamp) {
      showWarning("OTP Expired!");
    } else {
      sumbitRegistration();
    }
  }
};

// SEND SIGNUP OTP
const sendOtp = async (email, password) => {
  const send = await fetch(
    `./?send-otp=true&email=${email}&password=${password}`
  );
  const response = await send.json();
  return response;
};

// HANDLE SIGNUP FORM WHEN SUBMITTED
const onContinue = async (e) => {
  e.preventDefault();
  if (emailInput.value === "") {
    emailInput.focus();
    return (emailInput.style.outline = "5px solid rgba(240, 49, 49, 0.32)");
  }

  if (passwordInput.value.length < 6) {
    passwordInput.focus();
    return (passwordInput.style.outline = "5px solid rgba(240, 49, 49, 0.29)");
  }

  continueBtn.textContent = "Loading...";
  signupForm.setAttribute("disabled", "true");

  const sendOtpResponse = await sendOtp(emailInput.value, passwordInput.value);
  verificationIdInput.value = sendOtpResponse.verification_id;

  // HIDE SIGNUP FORM
  signupContainer.classList.add("d-none");

  // SHOW OTP CONTAINER
  otpContainer.classList.remove("d-none");
  otpContainer.innerHTML = `
      <div id="otp-input-container">
          <input type="text" name="" id="" class="otp-input" />
          <input type="text" name="" id="" class="otp-input" />
          <input type="text" name="" id="" class="otp-input" />
          <input type="text" name="" id="" class="otp-input" />
        </div>
        <p class="mt-5 text-secondary">
          <small>OTP was sent to ${emailInput.value}</small>
        </p>
        <button class="w-100" id="create-account-btn">Create account</button>
    `;

  const otpInputs = Array.from(document.querySelectorAll(".otp-input"));
  let otpEntered = [];

  otpInputs.forEach((otpInput, ind, ele) => {
    otpInput.addEventListener;
    otpInput.addEventListener("input", (e) => {
      if (e.target.value !== "") e.target.value = e.data.split("")[0];
      if (!/^\d+$/.test(e.target.value)) return (e.target.value = "");
      otpEntered[ind] = e.target.value;
      if (ind !== 3) ele[ind + 1].focus();
      if (otpEntered.length === 4)
        checkOtp(otpEntered.join(""), sendOtpResponse);
    });
  });

  otpInputs.forEach((otpInput, ind, ele) => {
    otpInput.addEventListener("keydown", (e) => {
      if (e.code === "Backspace" || e.code === "Delete") {
        e.target.value = "";
        otpEntered = otpEntered.filter((item, iInd) => ind !== iInd);
        if (ind !== 0) ele[ind - 1].focus();
      }
    });
  });
};

signupForm.addEventListener("submit", onContinue);

//  RETURN TO DEFAULT STATE WHEN THE VALUE ID VALID
emailInput.addEventListener("input", () => {
  if (emailInput.value !== "") emailInput.style.outline = "none";
});

//  RETURN TO DEFAULT STATE WHEN THE VALUE ID VALID ELSE SHOW ERROR WARNING
passwordInput.addEventListener("input", () => {
  if (passwordInput.value.length > 5) {
    passwordInput.style.outline = "none";
  } else {
    passwordInput.style.outline = "5px solid rgba(240, 49, 49, 0.29)";
  }
});
