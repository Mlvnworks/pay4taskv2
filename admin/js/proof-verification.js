const viewProofBtns = document.querySelectorAll(".view-proof-btn");
const imgProofPreview = document.querySelector("#img-proof-preview");
const searchInput = document.querySelector("#search-input");
const tableBody = document.querySelector("#table-body");
const proofApproveBtn = document.querySelector("#proof-approve-btn");
const proofDelcineBtn = document.querySelector("#proof-decline-btn");

const filter = !new URLSearchParams(window.location.search).get("filter")
  ? 0
  : new URLSearchParams(window.location.search).get("filter");

proofDelcineBtn.addEventListener("click", () => {
  const submission_id = proofDelcineBtn.getAttribute("data-submission-id");
  if (confirm("Are you sure you want to decline?")) {
    location.href = `./?update-proof=${submission_id}&status=-1`;
  }
});

proofApproveBtn.addEventListener("click", () => {
  const submission_id = proofApproveBtn.getAttribute("data-submission-id");
  if (confirm("Are you sure you want to approved?")) {
    location.href = `./?update-proof=${submission_id}&status=1`;
  }
});

// ON SEARCH
const onSearch = async (key) => {
  const search = await fetch(`./?search-proof=${key}&filter=${filter}`);
  const res = await search.json();
  tableBody.innerHTML = ``;

  if (res.msg.length > 0) {
    res.msg.forEach((proof_item) => {
      const tr = document.createElement("tr");
      tr.innerHTML = `
          <td>${proof_item.submission_id}</td>
          <td>${formatTimestamp(proof_item.date_submitted)}</td>
          <td>${proof_item.name}</td>
          <td>${proof_item.email}</td>
          <td><a href="./?c=task-data&id=${
            proof_item.task_id
          }" target="_blank">Task-${proof_item.task_id}</a></td>
          <td>${proof_item.task_instruction}</td>
          <td>
              <button class="btn btn-sm btn-primary view-proof-btn" data-bs-toggle="modal"  data-bs-target="#submitted-proof-modal" data-proof-id="${
                proof_item.file_id
              }">View Proof</button>
          </td>
      `;

      tableBody.appendChild(tr);
    });
  }
};

searchInput.addEventListener("input", (ev) => {
  const key = searchInput.value.toLowerCase();

  if (key.length > 3) {
    onSearch(key);
  } else if (key.length <= 0) {
    location.reload();
  }
});

Array.from(viewProofBtns).forEach((proof_btn) => {
  proof_btn.addEventListener("click", () => {
    imgProofPreview.src = "";
    imgProofPreview.src = `../tools/fetchImage.php?id=${proof_btn.getAttribute(
      "data-proof-id"
    )}`;

    proofApproveBtn.setAttribute(
      "data-submission-id",
      proof_btn.getAttribute("data-submission-id")
    );

    proofDelcineBtn.setAttribute(
      "data-submission-id",
      proof_btn.getAttribute("data-submission-id")
    );
  });
});
