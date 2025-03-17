const transferForm = document.querySelector("#transfer-form");
const accountInput = document.querySelector("#account-input");
const amountInput = document.querySelector("#amount");
const methodInput = document.querySelector("#method");

transferForm.addEventListener("submit", (ev) => {
  ev.preventDefault();
  const paymentMethod = Array.from(paymentMethods)
    .filter((pi) => pi.classList.contains("active-method-item"))
    .map((pi) => pi.getAttribute("data-method"))[0];

  methodInput.value = paymentMethod;
  const accountInputs = Array.from(transferMethod.querySelectorAll("input"));
  let account;

  if (paymentMethod == "gcash") {
    account = `${accountInputs[0].value} - ${accountInputs[1].value}`;
  } else if (paymentMethod == "paypal") {
    account = accountInputs[0].value;
  }

  if (parseFloat(amountInput.value) >= 5) {
    accountInput.value = account;
    transferForm.submit();
  }
});
