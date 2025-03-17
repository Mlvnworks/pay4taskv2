const allowBtn = document.querySelector("#allow-btn");
const declinedBtn = document.querySelector("#decline-btn");
const bridge = document.querySelector("#bridge");

const bridgeData = bridge.getAttribute("data");

const submitAction = async (adminId, action) => {
  const sumbit = await fetch(
    `./?admin-action=true&admin_id=${adminId}&action=${action}`
  );
  const response = await sumbit.json();
  return response;
};

declinedBtn.addEventListener("click", async () => {
  if (window.confirm("Are you sure you want to declined?")) {
    const response = await submitAction(bridgeData, -1);
    if (response.error_msg === "200") {
      alert("Successfully declined!");
      location.reload();
    } else {
      alert(`Somethinng went wrong, error code: ${response.error_msg}`);
    }
  }
});

allowBtn.addEventListener("click", async () => {
  if (window.confirm("Are you sure you want to allow?")) {
    const response = await submitAction(bridgeData, 1);
    if (response.error_msg === "200") {
      alert("New admin access added!");
      location.reload();
    } else {
      alert(`Somethinng went wrong, error code: ${response.error_msg}`);
    }
  }
});
