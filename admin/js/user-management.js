const openProfileBtns = document.querySelectorAll(".opb");
const userTableBody = document.querySelector("#user-table-body");
const userTableContainer = document.querySelector("#user-table-container");
const searchInput = document.querySelector("#search-input");

// USER TABLE OFFSET AND LIMIT
var offset = 0;
var limit = 100;
let lastScrollTop = 0;

// SHOW USERS ON TABLE
const showOnTable = (data) => {
  // APPEND THE DATA TO TABLE
  data.forEach((userData) => {
    const tr = document.createElement("tr");
    tr.innerHTML = `<tr>
                        <td>${userData.user_id}</td>
                        <td>${formatTimestamp(userData.registration_date)}</td>
                        <td>${userData.name}</td>
                        <td>${userData.email}</td>
                        <td>${userData.referral_code}</td>
                        <td>${toCurrencySign(userData.earning)}</td>
                        <td>${toCountFormat(userData.energy)}</td>
                        <td>${userData.status == "1" ? "Active" : ""}</td>
                        <td>
                            <a href="./?c=user-profile&id=${
                              userData.user_id
                            }"><button class="btn btn-sm btn-primary opb"><i class="bi bi-person-lines-fill"></i></button></a>
                        </td>
                    </tr>`;
    userTableBody.append(tr);
  });

  // SHOW NO DATA MESSAGE WHEN THERES NO USER
  if (userTableBody.childElementCount <= 0) {
    userTableBody.innerHTML = `
          <tr>
              <td colspan="8" class="text-center">No data to show</td>
          </tr>
    `;
  }
};

// ON USERS SEARCH
const onSearch = async (key) => {
  const submit = await fetch(`./?search-user=${key}`);
  const response = await submit.json();

  if (response.err) {
    window.alert("Something went wrong!");
  } else {
    userTableBody.innerHTML = ``;
    showOnTable(response.data);
  }
};

// SEARCH USERs
searchInput.addEventListener("input", (e) => {
  const key = e.target.value.toLowerCase();

  if (key.length > 3) {
    onSearch(key);
  } else if (searchInput.value === "") {
    location.reload();
  }
});

// FETCH USER'S LIST
const fetchUserList = async (offset, limit) => {
  const submit = await fetch(
    `./?get-users-list&offset=${offset}&limit=${limit}`
  );

  // RESPONSE
  const res = await submit.json();

  // SHOW RESPONSE ON TABLE
  showOnTable(res.data);
};

// TRIGGER FETCH USERS WHEN THE SCROLL REACH BOTTOM
const onScroll = (e) => {
  const currentScrollTop = userTableContainer.scrollTop;

  if (currentScrollTop > lastScrollTop) {
    // Ensures it triggers only on vertical scrolling
    if (
      userTableContainer.scrollTop + userTableContainer.clientHeight >=
      userTableContainer.scrollHeight
    ) {
      fetchUserList(offset, limit);
      // INCREMENT OFFSET AND LIMIT EVERY FETCH
      offset += 100;
      limit += 100;
    }
  }

  lastScrollTop = currentScrollTop; // Update last scroll position
};

userTableContainer.addEventListener("scroll", onScroll);

// FETCH INITIAL LIST WHEN THE PAGE LOADS
fetchUserList(offset, limit);
// INCREMENT OFFSET AND LIMIT EVERY FETCH
offset += 100;
limit += 100;

// WHEN TO OPEN PROFILE BTN CLICKED
Array.from(openProfileBtns).forEach((openProfileBtns) => {
  openProfileBtns.addEventListener("click", (e) => {
    location.href = "./?c=user-profile";
  });
});
