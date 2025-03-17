const uploadReceiptBtn = document.querySelector("#upload-btn");
const fileInput = document.querySelector("#payment-receipt-input");
const receiptPreviewModal = document.querySelector(
  "#submit-payment-proof-modal"
);
const receiptPreview = document.querySelector("#receipt-preview");

fileInput.addEventListener("change", (e) => {
  const file = e.target.files[0];

  if (file) {
    const validImageTypes = ["image/jpeg", "image/png", "image/gif"];
    if (!validImageTypes.includes(file.type)) {
      alert("Please upload a valid image file (JPEG, PNG, GIF).");
      fileInput.value = "";
      return;
    }

    if (file.size > 5 * 1024 * 1024) {
      // 5MB in bytes
      alert("File size must be less than or equal to 5MB.");
      fileInput.value = "";
      return;
    }
  }

  const reader = new FileReader();

  reader.onload = (event) => {
    receiptPreviewModal.style.display = "flex";
    receiptPreview.style.backgroundImage = `url("${reader.result}")`;
  };

  reader.readAsDataURL(file);
});

uploadReceiptBtn.addEventListener("click", () => {
  fileInput.click();
});
