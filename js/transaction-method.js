const paymentMethods = document.querySelectorAll(".payment-method-item");
const transferMethod = document.querySelector("#transfer-method");
const method = document.querySelector("#method");

paymentMethods[0].classList.add("active-method-item");

Array.from(paymentMethods).forEach((paymentMethod) => {
  paymentMethod.addEventListener("click", () => {
    Array.from(paymentMethods).forEach((method) => {
      method.classList.remove("active-method-item");
    });

    paymentMethod.classList.add("active-method-item");

    if (paymentMethod.getAttribute("data-method") === "gcash") {
      transferMethod.innerHTML = `
            <input type="text" class="form-control mt-4" placeholder="Gcash Number" required>
            <input type="text" class="form-control mt-4" placeholder="Gcash Name" required>
        `;
    } else {
      transferMethod.innerHTML = `
            <input type="text" class="form-control mt-4" placeholder="Paypal email" required>
        `;
    }
  });
});
