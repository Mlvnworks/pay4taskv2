const tableBody = document.querySelector("#table-body");
const taskTableContainer = document.querySelector("#task-table-container");
const searchInput = document.querySelector("#search-input");

let offset = 0;
let limit = 100;
let lastScrollTop = 0;

const showTasks = (tasks) => {
  if (tasks.length > 0) {
    tasks.forEach((task) => {
      const tr = document.createElement("tr");

      tr.innerHTML = `
            <td>${task.task_id}</td>
            <td>${formatTimestamp(task.created_datetime)}</td>
            <td>${task.task_instruction}</td>
            <td>${task.task_app}</td>
            <td><a href="${task.task_link}" target="_blank">${
        task.task_link
      }</a> </td>
            <td>${toCurrencySign(task.overall_spent)}</td>
            <td>${task.status === "-1" ? "Un-available" : "Available"} </td>
            <td>
              <a href="./?c=task-data&id=${task.task_id}">
                <button class="btn btn-primary btn-sm open-task-btn"><i class="bi bi-box-arrow-up-right"></i></button>
              </a>
            </td>
        `;
      tableBody.append(tr);
    });
  }

  // SHOW NO DATA MESSAGE WHEN THERES NO USER
  if (tableBody.childElementCount <= 0) {
    tableBody.innerHTML = `
      <tr>
        <td class="text-center" colspan="6">No Task to Show</td>
      </tr>
    `;
  }
};

const searchTask = async () => {
  if (searchInput.value === "") return location.reload();

  if (searchInput.value.length > 3) {
    const submit = await fetch(`./?search-task=${searchInput.value}`);
    const response = await submit.json();
    tableBody.innerHTML = "";
    showTasks(response.msg);
  }
};

const fetchTasks = async (offset, limit) => {
  const submit = await fetch(
    `./?get-tasks-list&offset=${offset}&limit=${limit}`
  );
  const response = await submit.json();

  showTasks(response.msg);
};

// TRIGGER FETCH USERS WHEN THE SCROLL REACH BOTTOM
const onScroll = (e) => {
  const currentScrollTop = taskTableContainer.scrollTop;

  if (currentScrollTop > lastScrollTop) {
    // Ensures it triggers only on vertical scrolling
    if (
      taskTableContainer.scrollTop + taskTableContainer.clientHeight >=
      taskTableContainer.scrollHeight
    ) {
      fetchTasks(offset, limit);
      // INCREMENT OFFSET AND LIMIT EVERY FETCH
      offset += 100;
      limit += 100;
    }
  }

  lastScrollTop = currentScrollTop; // Update last scroll position
};

taskTableContainer.addEventListener("scroll", onScroll);
searchInput.addEventListener("input", searchTask);
// FETCH TASKS WHEN THE PAGE LOADS
fetchTasks(offset, limit);
offset += 100;
limit += 100;
