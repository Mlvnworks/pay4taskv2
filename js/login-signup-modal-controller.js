const myModal = document.querySelector(".mymodal");
const closeModalBtn = document.querySelector("#close-modal-btn");

// OPEN MODAL
const openModal = () => {
  myModal.style.display = "flex";
};

// CLOSE MODAL
const closeModal = () => {
  myModal.style.display = "none";
};

closeModalBtn.addEventListener("click", closeModal);
