const viewReceiptBtns = document.querySelectorAll(".view-receipt-btn");
const receiptPreview = document.querySelector("#receipt-preview");
const checkPaymentBtns = document.querySelectorAll(".check-payment-btn");
const approveReceiptBtn = document.querySelector("#approve-receipt-btn");
const referenceNumberInput = document.querySelector("#referrence-number-input");

const applyActions = () => {
  const actionBtns = document.querySelectorAll(".action-btn");

  Array.from(actionBtns).forEach((actionBtn) => {
    actionBtn.addEventListener("click", () => {
      const action = actionBtn.getAttribute("data-action");
      const href = actionBtn.getAttribute("data-href");
      if (confirm(`Are sure you want to ${action}`)) {
        location.href = href;
      }
    });
  });
};

Array.from(viewReceiptBtns).forEach((btn) => {
  btn.addEventListener("click", (ev) => {
    const src = btn.getAttribute("data-src");
    receiptPreview.src = src;
  });
});

const approveReceipt = async () => {
  const url = `./?update-upgrade-request=${approveReceiptBtn.getAttribute(
    "data-id"
  )}&action=1`;

  // INSERT REFERENCE NUMBER
  const insertNewReference = await fetch(
    `./?insert-new-reference=${
      referenceNumberInput.value
    }&id=${approveReceiptBtn.getAttribute("data-id")}`
  );
  const insertResponse = await insertNewReference.json();
  if (!insertResponse.err) {
    location.href = `./?update-upgrade-request=${approveReceiptBtn.getAttribute(
      "data-id"
    )}&action=1`;
  } else {
    alert("Something went wrong!");
  }
};

referenceNumberInput.addEventListener("input", async () => {
  if (referenceNumberInput.value.length == 13) {
    const referenceNumber = referenceNumberInput.value;
    const checkRef = await fetch(
      `./?check-reference-number=${referenceNumber}`
    );
    const response = await checkRef.json();

    if (!response.data) {
      approveReceiptBtn.removeAttribute("disabled");
      approveReceiptBtn.addEventListener("click", approveReceipt);
    } else {
      approveReceiptBtn.setAttribute("disabled", "true");
      approveReceiptBtn.removeEventListener("click", approveReceipt);
      alert(
        `Payment already used on upgrade request id: ${response.data.request_id}`
      );
    }
  } else {
    approveReceiptBtn.setAttribute("disabled", "true");
    approveReceiptBtn.removeEventListener("click", approveReceipt);
  }
});

Array.from(checkPaymentBtns).forEach((btn) => {
  btn.addEventListener("click", () => {
    const requestId = btn.getAttribute("data-id");
    approveReceiptBtn.setAttribute("data-id", requestId);
  });
});

// APPLY ACTION BUTTON FUNCTIONS WHEN THE PAGE LOADS
applyActions();
