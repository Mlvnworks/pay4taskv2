const dragAndDropArea = document.querySelector("#drag-drop-area");
const thumbnailPreview = document.querySelector("#thumbnail-preview");
const thumbnailContainer = document.querySelector(".thumbnail-container");
const changeBtn = document.querySelector("#thumbnail-change-btn");
const fileInput = document.querySelector("#file-input");
const selectImage = document.querySelector("#select-thumbnail-btn");
const submitBtn = document.querySelector("#submit-form-btn");
const submitBtnTrigger = document.querySelector("#submit-form-btn-trigger");

submitBtnTrigger.addEventListener("click", () => {
  submitBtn.click();
});

selectImage.addEventListener("click", () => {
  fileInput.click();
});

fileInput.addEventListener("change", (e) => {
  const file = e.target.files[0];
  handleFiles(file);
});

changeBtn.addEventListener("click", () => {
  fileInput.value = "";
  thumbnailContainer.classList.add("d-none");
  changeBtn.classList.add("d-none");
});

dragAndDropArea.addEventListener("dragover", (event) => {
  event.preventDefault();
});

dragAndDropArea.addEventListener("dragenter", (event) => {
  event.preventDefault();
  dragAndDropArea.style.borderStyle = "solid";
});

dragAndDropArea.addEventListener("dragleave", () => {
  dragAndDropArea.style.borderStyle = "dashed";
});

dragAndDropArea.addEventListener("drop", (event) => {
  event.preventDefault();
  dragAndDropArea.style.borderStyle = "solid";

  const files = event.dataTransfer.files;
  handleFiles(files[0]);
});

function handleFiles(file) {
  if (file.type.startsWith("image/") && file.size < 5 * 1024 * 1024) {
    const reader = new FileReader();

    reader.onload = function (event) {
      const imageUrl = event.target.result;

      // You can use this URL to display the image or for other purposes
      thumbnailContainer.classList.remove("d-none");
      thumbnailPreview.src = imageUrl;
      changeBtn.classList.remove("d-none");

      const dataTransfer = new DataTransfer();
      dataTransfer.items.add(file);
      fileInput.files = dataTransfer.files;
    };

    reader.readAsDataURL(file);
  } else {
    alert("Please upload an image file less than 5MB.");
  }
}
