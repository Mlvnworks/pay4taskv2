const closeUpgradeBtn = document.querySelector("#close-upgrade-btn");
const upgradeModal = document.querySelector("#upgrade-modal");

closeUpgradeBtn.addEventListener("click", () => {
  upgradeModal.style.display = "none";
});

const showUpgradeModal = () => {
  upgradeModal.style.display = "flex";
};
