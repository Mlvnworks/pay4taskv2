const searchInput = document.querySelector("#search-input");
const urlParams = new URLSearchParams(window.location.search);
const filter = !urlParams.get("filter") ? 0 : urlParams.get("filter");
const tableBody = document.querySelector("#table-body");
const actionBtns = document.querySelectorAll(".action-btn");

Array.from(actionBtns).forEach((actionBtn) => {
  actionBtn.addEventListener("click", (ev) => {
    ev.preventDefault();
    const actionType = actionBtn.getAttribute("data-action");
    const link = actionBtn.href;
    const message =
      actionType == "approve"
        ? "Are you sure you want to approve?"
        : "Are you sure you want to decline?";

    if (confirm(message)) {
      location.href = link;
    }
  });
});

const showResult = (data) => {
  tableBody.innerHTML = "";
  if (data.length <= 0)
    return (tableBody.innerHTML = `<tr>
                                    <td colspan="7" class="text-center">No transfer request to show</td>
                                </tr>`);

  data.forEach((element) => {
    const tr = document.createElement("tr");
    tr.innerHTML = `
        <td>${element.request_id}</td> 
        <td>${formatTimestamp(element.request_date)}</td>
        <td>${element.name}</td>
        <td>${element.email}</td>
        <td>${element.method}</td>
        <td>${element.account}</td>
        <td>${toCurrencySign(element.amount)}</td>
        <td>
            <a href="./?update-transfer-request=${
              element.request_id
            }&status=-1" class="action-btn" data-action="decline">
                <button class="btn btn-sm btn-danger view-proof-btn">Decline</button>
            </a>
            <a  href="./?update-transfer-request=${
              element.request_id
            }&status=1" class="action-btn" data-action="approve">
                <button class="btn btn-sm btn-success view-proof-btn">Approve</button>
            </a>
        </td>
    `;

    tableBody.append(tr);
  });
};

const onSearch = async () => {
  const search = await fetch(
    `./?search-transfer-request=${searchInput.value}&status=${filter}`
  );

  const searchResult = await search.json();
  showResult(searchResult.msg);
};

searchInput.addEventListener("input", () => {
  if (searchInput.value.length > 3) {
    onSearch();
  } else if (searchInput.value.length == 0) {
    location.reload();
  }
});
