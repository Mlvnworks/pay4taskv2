const adminItems = document.querySelectorAll(".admin-item");
const systemMaintenanceCb = document.querySelector("#cb-system-maintenance");
const systemMaintenanceLbl = document.querySelector(
  "#system-maintenance-state"
);

// SUBMIT SETTINGS UPDATE
const updateSettings = async (value) => {
  const submit = await fetch(
    `./?update-settings=true&settings-id=1&value=${value}`
  );
  const response = await submit.json();

  return response;
};

// UPDATE SYSTEM MAINTENANCE SETTINGS
systemMaintenanceCb.addEventListener("change", async (e) => {
  const isChecked = e.target.checked;
  const message = isChecked
    ? "Are you sure you want to do System Maintenance?"
    : "Are you sure you want to off System Maintenance?";
  let response;

  if (window.confirm(message)) {
    if (isChecked) {
      response = await updateSettings(1);
      systemMaintenanceLbl.textContent = "On";
    } else {
      response = await updateSettings(0);
      systemMaintenanceLbl.textContent = "Off";
    }

    if (response.error_msg === "200") {
      window.alert("System settings updated!");
    }
  }
});

// REMOVE ADMIN FROM DATABASE
const removeAdmin = async (adminId) => {
  const sumbit = await fetch(
    `./?admin-action=true&admin_id=${adminId}&action=${-2}`
  );
  const response = await sumbit.json();
  return response;
};

//CHANGE ADMIN NAME
const changeAdminName = async (adminId, name) => {
  const submit = await fetch(
    `./?change-admin-name=true&admin-id=${adminId}&name=${name}`
  );
  const response = await submit.json();
  return response;
};

Array.from(adminItems).forEach((adminItem) => {
  adminItem.addEventListener("click", async (e) => {
    const nameInput = adminItem.querySelector(".admin-name");
    const clickTarget = e.target;

    // IF REMOVE BTN WAS CLICKED
    if (clickTarget.classList.contains("remove-btn")) {
      const adminId = clickTarget.getAttribute("data-admin");

      if (window.confirm("Are you sure you want to remove this admin?")) {
        const response = await removeAdmin(adminId);
        if (response.error_msg == "200") {
          window.alert("Admin remove successfully!");
          location.reload();
        } else {
          window.alert(`Something went wrong error: ${response.error_msg}`);
        }
      }

      // IF EDIT BTN WAS CLICKED
    } else if (clickTarget.classList.contains("edit-btn")) {
      const editBtn = adminItem.querySelector(".edit-btn");
      const btnText = editBtn.textContent;
      const adminId = clickTarget.getAttribute("data-admin");

      if (btnText === "Edit") {
        editBtn.textContent = "Cancel";
        nameInput.setAttribute("contenteditable", "true");
        nameInput.focus();
      } else if (btnText === "Cancel") {
        nameInput.removeAttribute("contenteditable");
        editBtn.textContent = "Edit";
      } else if (btnText === "Save") {
        const name = nameInput.textContent;

        const response = await changeAdminName(adminId, name);
        if (response.error_msg == 200) {
          alert("Name successfully changed!");
        } else {
          alert("Something went wrong!");
        }

        nameInput.removeAttribute("contenteditable");
        editBtn.textContent = "Edit";
      }

      nameInput.addEventListener("input", (e) => {
        const content = e.target.textContent;

        if (content.length > 0) {
          editBtn.textContent = "Save";
          editBtn.removeAttribute("disabled");
        } else {
          editBtn.textContent = "Save";
          editBtn.setAttribute("disabled", true);
        }
      });
    }
  });
});
