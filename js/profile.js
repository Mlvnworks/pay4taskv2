const proofViewBtns = document.querySelectorAll(".submitted-proof-btn");
const proofPreviewModal = document.querySelector("#submitted-proof-modal");
const closeProofPreview = document.querySelector("#close-proof-preview-btn");
const viewSubmittedProofBtns = document.querySelectorAll(
  ".submitted-proof-btn"
);
const proofPreviewImg = document.querySelector("#submitted-proof-preview");
const loadingBar = document.querySelector(".loading-bar");

Array.from(viewSubmittedProofBtns).forEach((btn) => {
  btn.addEventListener("click", (e) => {
    proofPreviewImg.classList.add("opacity-0");
    loadingBar.classList.remove("d-none");

    const proofId = e.target.getAttribute("data-file-id");
    proofPreviewImg.src = `./tools/fetchImage.php?id=${proofId}`;
    proofPreviewImg.onload = () => {
      proofPreviewImg.classList.remove("opacity-0");
      loadingBar.classList.add("d-none");
    };
  });
});

// ON COPY
const onCopy = (target_id, btn) => {
  const targetText = document.querySelector(`${target_id}`).textContent;

  navigator.clipboard
    .writeText(targetText)
    .then(() => {
      const copyCheck = document.querySelector("#copy-check");

      btn.classList.add("d-none");
      copyCheck.classList.remove("d-none");
    })
    .catch((err) => {
      console.error("Failed to copy text: ", err);
    });
};
// Close Preview Modal
closeProofPreview.addEventListener("click", () => {
  proofPreviewModal.style.display = "none";
});

// Open Preview Modal
proofViewBtns.forEach((btn) => {
  btn.addEventListener("click", () => {
    proofPreviewModal.style.display = "flex";
  });
});
