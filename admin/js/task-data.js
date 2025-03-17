const changeStatusLink = document.querySelector("#submit-status-change");
const deleteTaskLink = document.querySelector("#delete-task-link");
const editDetailtBtn = document.querySelector("#edit-details-btn");
const saveBtn = document.querySelector("#save-btn");
const changeThumbnailBtn = document.querySelector("#change-thumbnail-btn");
const thumbnailContainer = document.querySelector(".thumbnail-container");
const dragDropArea = document.querySelector("#drag-drop-area");
const selectThumbnailBtn = document.querySelector("#select-thumbnail-btn");
const thumbnailFileInput = document.querySelector("#change-thumbnail-input");
const saveThumbnailBtn = document.querySelector("#save-thumbnail-btn");
const changeThumbnailSubmitBtn = document.querySelector(
  "#change-thumbnail-submit-btn"
);

saveThumbnailBtn.addEventListener("click", () =>
  changeThumbnailSubmitBtn.click()
);

// ON IMAGE SELECTED
const onImageSelected = (ev) => {
  const file = ev.target.files[0];
  if (file.size > 5 * 1024 * 1024) {
    alert("File size must not exceed 5MB.");
    return;
  }

  if (!file.type.startsWith("image/")) {
    alert("Only image files are allowed.");
    return;
  }

  const reader = new FileReader();
  reader.onload = (e) => {
    dragDropArea.style.backgroundImage = `url("${reader.result}")`;
    dragDropArea.style.backgroundSize = "contain";
    dragDropArea.style.backgroundPosition = "center";
    dragDropArea.style.backgroundRepeat = "no-repeat";
  };

  reader.readAsDataURL(file);
};

// ON SELECT IMAGE
const onSelectImage = (ev) => {
  thumbnailFileInput.click();
};

// ON CANCEL THUMBNAIL CHANGING
const onCancelChangeThumbnail = (ev) => {
  thumbnailContainer.classList.remove("d-none");
  dragDropArea.classList.add("d-none");
  saveThumbnailBtn.classList.add("d-none");

  changeThumbnailBtn.textContent = "Edit";
  changeThumbnailBtn.removeEventListener("click", onCancelChangeThumbnail);
  changeThumbnailBtn.addEventListener("click", onChangeThumbnail);
};

// CHANGE TASK THUMBNAIL
const onChangeThumbnail = (ev) => {
  thumbnailContainer.classList.add("d-none");
  dragDropArea.classList.remove("d-none");
  saveThumbnailBtn.classList.remove("d-none");

  changeThumbnailBtn.textContent = "Cancel";
  changeThumbnailBtn.removeEventListener("click", onChangeThumbnail);
  changeThumbnailBtn.addEventListener("click", onCancelChangeThumbnail);
};

// WHEN USER CAN EDITING DETAILS
const onEditCancel = (ev) => {
  const inputs = document.querySelectorAll(
    "#task-details-form .task-detail-input"
  );

  Array.from(inputs).forEach((input) => {
    input.setAttribute("readonly", "true");
  });

  ev.target.textContent = "Edit";
  saveBtn.classList.add("d-none");
  editDetailtBtn.removeEventListener("click", onEditCancel);
  editDetailtBtn.addEventListener("click", onEditDeatails);
};

// WHEN USER CLICK EDIT BTN
const onEditDeatails = (ev) => {
  const inputs = document.querySelectorAll(
    "#task-details-form .task-detail-input"
  );

  Array.from(inputs).forEach((input, ind) => {
    input.removeAttribute("readonly");
    if (ind == 0) input.focus();
  });

  saveBtn.classList.remove("d-none");
  ev.target.textContent = "Cancel";
  editDetailtBtn.removeEventListener("click", onEditDeatails);
  editDetailtBtn.addEventListener("click", onEditCancel);
};

thumbnailFileInput.addEventListener("change", onImageSelected);
selectThumbnailBtn.addEventListener("click", onSelectImage);
changeThumbnailBtn.addEventListener("click", onChangeThumbnail);
editDetailtBtn.addEventListener("click", onEditDeatails);
deleteTaskLink.addEventListener("click", (e) => {
  e.preventDefault();
  if (window.confirm("Are you sure you want to delete this Task?")) {
    location.href = deleteTaskLink.href;
  }
});

changeStatusLink.addEventListener("click", (e) => {
  e.preventDefault();
  if (window.confirm("Are you sure you want to change this taks's status?")) {
    location.href = changeStatusLink.href;
  }
});
