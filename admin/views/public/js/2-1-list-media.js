let createMedia = document.querySelector('#create-media'),
  createMediaWrapper = document.querySelector(".create-media-wrapper");
  bodyContainer=document.querySelector(".body-container");
let createMediaCounter = 0;

createMedia.addEventListener("click", function (event) {
  event.preventDefault(); // Ngăn chặn trình duyệt tải lại trang
  createMediaCounter++;
  
  if (createMediaCounter % 2 === 1) {
    createMediaWrapper.classList.add("createMediaActive");
    console.log('Đã vào');
  } else {
    createMediaWrapper.classList.remove("createMediaActive");
  }
});

/*=======================List Media===================== */
var table = $("#detail-row");

function loadMediaData() {
  $.ajax({
    url: "../controllers/loadMediaData.php",
    method: "GET",
    success: function (data) {
      // Clear existing content of the table
      console.log(data);
      let mediaData = JSON.parse(data); // Chuyển đổi chuỗi JSON thành mảng JavaScript
      let noRow = mediaData.length;
      table.empty();
      for (let i = 0; i < noRow; i++) {
        let media = mediaData[i]; // Lấy đối tượng sự kiện tại vị trí i

        let row = table[0].insertRow(i);

        // Add the event data to the row
        let cell0 = row.insertCell(0);
        let cell1 = row.insertCell(1);
        let cell2 = row.insertCell(2);
        let cell3 = row.insertCell(3);
        let cell4 = row.insertCell(4);
        let cell5 = row.insertCell(5);
        let cell6 = row.insertCell(6);
        let cell7 = row.insertCell(7);
        let cell8 = row.insertCell(8)

        cell0.innerHTML = media.id;
        cell1.innerHTML = media.name;
        cell2.innerHTML = media.description;
        cell3.innerHTML = media.start;
        cell4.innerHTML = media.end;
        cell5.innerHTML = media.eventHostId;
        cell6.innerHTML = media.mediaInchargeID;
        cell7.innerHTML = media.status;
        cell8.innerHTML = cell8.innerHTML = `
        <button type="button" class="btn btn-primary editMediaBtn" data-bs-toggle="modal" data-bs-target="#editMediaModal" value=${media.id}>
          <i class="bx bxs-edit"></i>
        </button>
        <button type="button" class="btn btn-primary deleteMediaBtn" data-bs-toggle="modal" data-bs-target="#deleteMediaModal" value=${media.id}>
          <i class='bx bx-x'></i>
        </button>
        <button type="button" class="btn btn-primary detailMediaBtn" value=${media.id}>
            <i class='bx bxs-report' ></i>
        </button>
        `;
      }
    }
  });
}

function displayEditMediaModal(mediaId) {
  $.ajax({
    method: "GET",
    url: "../controllers/getMediaByMediaId.php",
    data: { mediaId: mediaId },
    success: function (data) {
      console.log(data);
      var media = JSON.parse(data);
      $('#edit_mediaName').val(media.name);
      $('#edit_mediaDescription').val(media.description);
      $('#edit_mediaStart').val(media.start);
      $('#edit_mediaEnd').val(media.end);
      
      $('.studentEditModal').modal('show');
    }
  });
}

function createMediaProcess() {
  let selectElement1 = document.getElementById('eventHostId'); // Lấy phần tử select theo id
  let selectedEventHostId = selectElement1.options[selectElement1.selectedIndex].value;

  let selectElement2 = document.getElementById('mediaInchargeID'); // Lấy phần tử select theo id
  let selectedMediaInchargeID = selectElement2.options[selectElement2.selectedIndex].value;

  $.ajax({
    url: "../controllers/createMedia.php",
    method: 'POST',
    data: {
      name: $('#media-name').val(),
      description: $('#description').val(),
      start: $('#start').val(),
      end: $('#end').val(),
      eventHostId: selectedEventHostId,
      mediaInchargeID: selectedMediaInchargeID,
    },
    success: function (response) {
      console.log(response);
      loadMediaData();
    }
  });
}

function updateMedia(mediaId) {
  $.ajax({
    method: "POST",
    url: "../controllers/updateMedia.php",
    data: {
      id : mediaId,
      name: $('#edit_mediaName').val(),
      description: $('#edit_mediaDescription').val(),
      end: $('#edit_mediaEnd').val(),
    },
    success: function (data) {
      loadMediaData();
      $('#editMediaModal').modal('hide');
    }
  });
}

function deleteMedia(mediaId) {
  $.ajax({
    method: "POST",
    url: "../controllers/deleteMedia.php",
    data: {
      id : mediaId,
    },
    success: function (data) {
      loadMediaData();
      $('#deleteMediaModal').modal('hide');
    }
  });
}

$(document).ready(function(){
  loadMediaData();
})

$(document).on('click',"#addMediaBtn", function () {
  createMediaProcess();
});

$(document).on('click', '.editMediaBtn', function () {
  let mediaId = $(this).val();
  $('.confirmEdit').val(mediaId); // Gán giá trị eventId cho các phần tử có class confirmEdit
  displayEditMediaModal(mediaId);
});

$(document).on('click', ".confirmEdit", function () {
  let mediaId = $(this).val();
  console.log(mediaId);
  updateMedia(mediaId);
});

$(document).on('click', '.deleteMediaBtn', function () {
  let mediaId = $(this).val();
  $('.confirmDelete').val(mediaId); // Gán giá trị eventId cho các phần tử có class confirmEdit
});

$(document).on('click', ".confirmDelete", function () {
  let mediaId = $(this).val();
  console.log(mediaId);
  deleteMedia(mediaId);
});

$(document).on('click', ".detailMediaBtn", function () {
  var mediaId = $(this).val();
  // Set eventID to session variable
  $.ajax({
    url: "../controllers/setSessionMedia.php",
    method: "POST",
    data: { mediaId: mediaId },
    success: function(response) {
      // Redirect to another page after setting the session
      window.location.href = "2-2-media-detail.php";
      console.log(response);
    }
  });
});
