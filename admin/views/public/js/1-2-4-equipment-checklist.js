let createChecklist = document.querySelector('#create-checklist'),
  createChecklistWrapper = document.querySelector(".create-checklist-wrapper");
  bodyContainer=document.querySelector(".body-container");
let createChecklistCounter = 0;

createChecklist.addEventListener("click", function (event) {
  event.preventDefault(); // Ngăn chặn trình duyệt tải lại trang
  createChecklistCounter++;

  if (createChecklistCounter % 2 === 1) {
    createChecklistWrapper.classList.add("createChecklistActive");
  } else {
    createChecklistWrapper.classList.remove("createChecklistActive");
  }
});

/*=======================List Event===================== */
var table = $("#detail-row");

function loadChecklistData() {
  $.ajax({
    url: "../controllers/loadChecklistData.php",
    method: "GET",
    success: function (data) {
      // Clear existing content of the table
      
      let checklistData = JSON.parse(data); // Chuyển đổi chuỗi JSON thành mảng JavaScript
      let noRows = checklistData.length;
      console.log(noRows); // In ra số lượng đối tượng trong mảng JSON

      table.empty();
      for (let i = 0; i < noRows; i++) {
        let checklist = checklistData[i]; // Lấy đối tượng sự kiện tại vị trí i

        let row = table[0].insertRow(i);
        console.log(checklist);

        // Add the checklist data to the row
        let cell0 = row.insertCell(0);
        let cell1 = row.insertCell(1);
        let cell2 = row.insertCell(2);
        let cell3 = row.insertCell(3);
        let cell4 = row.insertCell(4);
        let cell5 = row.insertCell(5);
        let cell6 = row.insertCell(6);
        let cell7 = row.insertCell(7);
        let cell8 = row.insertCell(8);
        let cell9 = row.insertCell(9)
        let cell10 = row.insertCell(10)

        cell0.innerHTML = checklist.id;
        cell1.innerHTML = checklist.name;
        cell2.innerHTML = checklist.description;
        cell3.innerHTML = checklist.unit;
        cell4.innerHTML = checklist.quantity;
        cell5.innerHTML = checklist.vendor;
        cell6.innerHTML = checklist.class;
        cell7.innerHTML = checklist.status;
        cell8.innerHTML = checklist.inchargeId;
        cell9.innerHTML = `
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
            Check
            </label>
        </div>
        `;        
        cell10.innerHTML = `
        <button type="button" class="btn btn-primary editChecklistBtn" data-bs-toggle="modal" data-bs-target="#editChecklistModal" value=${checklist.id}>
          <i class="bx bxs-edit"></i>
        </button>
        <button type="button" class="btn btn-primary deleteChecklistBtn" data-bs-toggle="modal" data-bs-target="#deleteChecklistModal" value=${checklist.id}>
          <i class='bx bx-x'></i>
        </button>
        `;
      }
    }
  });
}

function displayEditChecklistModal(checklistId) {
  $.ajax({
    method: "POST",
    url: "../controllers/getChecklistByChecklistId.php",
    data: { checklistId: checklistId },
    success: function (data) {
      var checklist = JSON.parse(data);
      $('#edit_checklistName').val(checklist.name);
      $('#edit_checklistDescription').val(checklist.description);
      $('#edit_checklistUnit').val(checklist.unit);
      $('#edit_checklistQuantity').val(checklist.quantity);
      $('#edit_checklistVendor').val(checklist.vendor);
      $('#edit_checklistClass').val(checklist.class);

      $('.studentEditModal').modal('show');
    }
  });
}

function createChecklistProcess() {
  let selectElement1 = document.getElementById('inchargeName'); // Lấy phần tử select theo id
  let selectedHostId = selectElement1.options[selectElement1.selectedIndex].value;
  let selectElement2 = document.getElementById('unit'); // Lấy phần tử select theo id
  let selectedUnit = selectElement2.options[selectElement2.selectedIndex].value;
  let selectElement3 = document.getElementById('class'); // Lấy phần tử select theo id
  let selectedClass = selectElement3.options[selectElement3.selectedIndex].value;

  $.ajax({
    url: "../controllers/createChecklist.php",
    method: 'POST',
    data: {
      name: $('#name').val(),
      description: $('#description').val(),
      unit: selectedUnit,
      quantity: $('#quantity').val(),
      vendor: $('#vendor').val(),
      class: selectedClass,
      inchargeID: selectedHostId,
    },
    success: function (response) {
      alert("sucess");
      console.log(response);
      loadChecklistData();
    }
  });
}

function updateChecklist(checklistId) {
  $.ajax({
    method: "POST",
    url: "../controllers/updateChecklist.php",
    data: {
      id : checklistId,
      description: $('#edit_checklistDescription').val(),
      quantity: $('#edit_checklistQuantity').val(),
      vendor: $('#edit_checklistVendor').val(),
    },
    success: function (data) {
      loadChecklistData();
      $('#editChecklistModal').modal('hide');
    }
  });
}

function deleteChecklist(checklistId) {
  $.ajax({
    method: "POST",
    url: "../controllers/deleteChecklist.php",
    data: {
      id : checklistId,
    },
    success: function (data) {
      loadChecklistData();
      $('#deleteChecklistModal').modal('hide');
    }
  });
}

$(document).ready(function(){
  loadChecklistData();
})

$(document).on('click',"#addChecklistBtn", function () {
  createChecklistProcess();
});

$(document).on('click', '.editChecklistBtn', function () {
  let checklistId = $(this).val();
  $('.confirmEdit').val(checklistId); // Gán giá trị eventId cho các phần tử có class confirmEdit
  displayEditChecklistModal(checklistId);
});

$(document).on('click', ".confirmEdit", function () {
  let checklistId = $(this).val();
  console.log(checklistId);
  updateChecklist(checklistId);
});

$(document).on('click', '.deleteChecklistBtn', function () {
  let checklistId = $(this).val();
  $('.confirmDelete').val(checklistId); // Gán giá trị eventId cho các phần tử có class confirmEdit
});

$(document).on('click', ".confirmDelete", function () {
  let checklistId = $(this).val();
  console.log(checklistId);
  deleteChecklist(checklistId);
});
