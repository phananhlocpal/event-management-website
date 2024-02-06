let createHRMap = document.querySelector('#create-hr-map'),
  createHRMapWrapper = document.querySelector(".create-hr-map-wrapper");
  bodyContainer=document.querySelector(".body-container");
let createHRMapCounter = 0;

createHRMap.addEventListener("click", function (HRMap) {
  HRMap.preventDefault(); // Ngăn chặn trình duyệt tải lại trang
  createHRMapCounter++;

  if (createHRMapCounter % 2 === 1) {
    createHRMapWrapper.classList.add("createHRMapActive");
  } else {
    createHRMapWrapper.classList.remove("createHRMapActive");
  }
});

/*=======================List Event===================== */
var table = $("#detail-row");

function loadHRMapData() {
  $.ajax({
    url: "../controllers/loadHRMapData.php",
    method: "GET",
    success: function (data) {
      // Clear existing content of the table
      console.log(data);
      let HRMapData = JSON.parse(data); // Chuyển đổi chuỗi JSON thành mảng JavaScript
      let noRow = HRMapData.length;
      table.empty();
      for (let i = 0; i < noRow; i++) {
        let HRMap = HRMapData[i]; // Lấy đối tượng sự kiện tại vị trí i

        let row = table[0].insertRow(i);
        console.log(HRMap);
        // Add the event data to the row
        let cell0 = row.insertCell(0);
        let cell1 = row.insertCell(1);
        let cell2 = row.insertCell(2);
        let cell3 = row.insertCell(3);

        cell0.innerHTML = HRMap.id;
        cell1.innerHTML = HRMap.title;
        cell2.innerHTML = HRMap.link;
        cell3.innerHTML = `
        <button type="button" class="btn btn-primary deleteHRMapBtn" data-bs-toggle="modal" data-bs-target="#deleteHRMapModal" value=${HRMap.id}>
          <i class='bx bx-x'></i>
        </button>
        `;
      }
    }
  });
}


function createHRMapProcess() {
  $.ajax({
    url: "../controllers/createHRMap.php",
    method: 'POST',
    data: {
      title: $('#title').val(),
      link: $('#linkHRMap').val(),
    },
    success: function (response) {
      console.log(response);
      loadHRMapData();
    }
  });
}

function deleteHRMap(HRMapId) {
  $.ajax({
    method: "POST",
    url: "../controllers/deleteHRMap.php",
    data: {
      id : HRMapId,
    },
    success: function (data) {
      loadHRMapData();
      $('#deleteHRMapModal').modal('hide');
    }
  });
}

$(document).ready(function(){
  loadHRMapData();
})

$(document).on('click',"#addHRMapBtn", function () {
  createHRMapProcess();
});

$(document).on('click', '.deleteHRMapBtn', function () {
  let HRMapId = $(this).val();
  $('.confirmDelete').val(HRMapId); // Gán giá trị eventId cho các phần tử có class confirmEdit
});

$(document).on('click', ".confirmDelete", function () {
  let HRMapId = $(this).val();
  console.log(HRMapId);
  deleteHRMap(HRMapId);
});



