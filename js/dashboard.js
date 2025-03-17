const startTaskBtn = document.querySelector("#start-task-btn");
const transferBtn = document.querySelector("#transfer-btn");

transferBtn.addEventListener("click", () => {
  if (!isLogin) return openModal();
  window.location.href = "./?c=transfer";
});

startTaskBtn.addEventListener("click", () => {
  if (!isLogin) return openModal();
  window.location.href = "./?c=tasks";
});
