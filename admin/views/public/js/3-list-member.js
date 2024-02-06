let createMember = document.querySelector('#create-member'),
  createMemberWrapper = document.querySelector(".create-member-wrapper");
  bodyContainer=document.querySelector(".body-container");
let createMemberCounter = 0;

createMember.addEventListener("click", function (event) {
  event.preventDefault(); // Ngăn chặn trình duyệt tải lại trang
  createMemberCounter++;

  if (createMemberCounter % 2 === 1) {
    createMemberWrapper.classList.add("createMemberActive");
  } else {
    createMemberWrapper.classList.remove("createMemberActive");
  }
});

/*=======================List Member===================== */
var table = $("#detail-row");

function loadMemberData() {
  $.ajax({
    url: "../controllers/loadMemberData.php",
    method: "GET",
    success: function (data) {
      console.log(data);
      // Clear existing content of the table
      let memberData = JSON.parse(data); // Chuyển đổi chuỗi JSON thành mảng JavaScript
      let noRow = memberData.length;
      table.empty();
      for (let i = 0; i < noRow; i++) {
        let member = memberData[i]; // Lấy đối tượng sự kiện tại vị trí i

        let row = table[0].insertRow(i);

        // Add the member data to the row
        let cell0 = row.insertCell(0);
        let cell1 = row.insertCell(1);
        let cell2 = row.insertCell(2);
        let cell3 = row.insertCell(3);
        let cell4 = row.insertCell(4);
        let cell5 = row.insertCell(5);


        cell0.innerHTML = member.id;
        cell1.innerHTML = member.name;
        cell2.innerHTML = member.email;
        cell3.innerHTML = member.phone;
        cell4.innerHTML = member.role;
        cell5.innerHTML =  `
        <button type="button" class="btn btn-primary editMemberBtn" data-bs-toggle="modal" data-bs-target="#editMemberModal" value=${member.id}>
          <i class="bx bxs-edit"></i>
        </button>
        <button type="button" class="btn btn-primary deleteMemberBtn" data-bs-toggle="modal" data-bs-target="#deleteMemberModal" value=${member.id}>
          <i class='bx bx-x'></i>
        </button>
        `;
      }
    }
  });
}

function displayEditMemberModal(memberId) {
  $.ajax({
    method: "GET",
    url: "../controllers/getMemberByMemberId.php",
    data: { memberId: memberId },
    success: function (data) {
      console.log(data);
      var member = JSON.parse(data);
      $('#edit_memberName').val(member.name);
      $('#edit_memberEmail').val(member.email);
      $('#edit_memberPhone').val(member.phone);
      $('#edit_memberUsername').val(member.username);
      $('#edit_memberPassword').val(member.password);

      $('#editMemberModal').modal('show');
    }
  });
}

function createMemberProcess() {
  let selectElement = document.getElementById('role'); 
  let selectedRole = selectElement.options[selectElement.selectedIndex].value;

  $.ajax({
    url: "../controllers/createMember.php",
    method: 'POST',
    data: {
      name: $('#name').val(),
      email: $('#email').val(),
      phone: $('#phone').val(),
      role: selectedRole,
    },
    success: function (response) {
      console.log(response);
      loadMemberData();
    }
  });
}

function updateMember(memberId) {
  let selectElement = document.getElementById('edit_role'); 
  let selectedRole = selectElement.options[selectElement.selectedIndex].value;
  console.log('Role la');
  console.log(selectedRole);
  $.ajax({
    method: "POST",
    url: "../controllers/updateMember.php",
    data: {
      id : memberId,
      name: $('#edit_memberName').val(),
      email: $('#edit_memberEmail').val(),
      phone: $('#edit_memberPhone').val(),
      username: $('#edit_memberUsername').val(),
      password: $('#edit_memberPassword').val(),
      role: selectedRole,
    },
    success: function (data) {
      loadMemberData();
      $('#editMemberModal').modal('hide');
    }
  });
}

function deleteMember(memberId) {
  $.ajax({
    method: "POST",
    url: "../controllers/deleteMember.php",
    data: {
      id : memberId,
    },
    success: function (data) {
      loadMemberData();
      $('#deleteMemberModal').modal('hide');
    }
  });
}

$(document).ready(function(){
  loadMemberData();
})

$(document).on('click',"#addMemberBtn", function () {
  createMemberProcess();
});

$(document).on('click', '.editMemberBtn', function () {
  let memberId = $(this).val();
  $('.confirmEdit').val(memberId); // Gán giá trị eventId cho các phần tử có class confirmEdit
  displayEditMemberModal(memberId);
});

$(document).on('click', ".confirmEdit", function () {
  let memberId = $(this).val();
  console.log(memberId);
  updateMember(memberId);
});

$(document).on('click', '.deleteMemberBtn', function () {
  let memberId = $(this).val();
  $('.confirmDelete').val(memberId); // Gán giá trị eventId cho các phần tử có class confirmEdit
});

$(document).on('click', ".confirmDelete", function () {
  let memberId = $(this).val();
  console.log(memberId);
  deleteMember(memberId);
});





