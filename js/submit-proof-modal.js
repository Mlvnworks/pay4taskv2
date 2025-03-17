const selectFileBtn = document.querySelector("#select-file-btn");
const fileInput = document.querySelector("#file-input");
const proofImg = document.querySelector("#proof-preview");
const changeImageBtn = document.querySelector("#change-img-btn");

selectFileBtn.addEventListener("click", () => fileInput.click());

changeImageBtn.addEventListener("click", () => {
  proofImg.classList.add("d-none");
  changeImageBtn.classList.add("d-none");
});

const showProofPreview = (file) => {
  const reader = new FileReader();
  reader.readAsDataURL(file);

  reader.onload = () => {
    proofImg.src = reader.result;
    proofImg.classList.remove("d-none");
  };

  changeImageBtn.classList.remove("d-none");
};

fileInput.addEventListener("change", () => {
  const file = fileInput.files[0];
  if (file) {
    // The file must be image
    if (!file.type.includes("image")) {
      fileInput.value = "";
      alert("Please select an image file");
      return;
    }

    // the file must be less than 5mb
    if (file.size > 5 * 1024 * 1024) {
      fileInput.value = "";
      alert("Please select an image file less than 5mb");
      return;
    }

    showProofPreview(file);
  }
});
