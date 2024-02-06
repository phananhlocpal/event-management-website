let createEvent = document.querySelector('#create-event'),
  createEventWrapper = document.querySelector(".create-event-wrapper");
  bodyContainer=document.querySelector(".body-container");
let createEventCounter = 0;

createEvent.addEventListener("click", function (event) {
  event.preventDefault(); // Ngăn chặn trình duyệt tải lại trang
  createEventCounter++;

  if (createEventCounter % 2 === 1) {
    createEventWrapper.classList.add("createEventActive");
  } else {
    createEventWrapper.classList.remove("createEventActive");
  }
});

/*=======================List Event===================== */
var table = $("#detail-row");

function loadEventData() {
  $.ajax({
    url: "../controllers/loadEventData.php",
    method: "GET",
    success: function (data) {
      console.log(data);
      // Clear existing content of the table
      let eventData = JSON.parse(data); // Chuyển đổi chuỗi JSON thành mảng JavaScript
      let noRow = eventData.length;
      table.empty();
      for (let i = 0; i < noRow; i++) {
        let event = eventData[i]; // Lấy đối tượng sự kiện tại vị trí i

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

        cell0.innerHTML = event.id;
        cell1.innerHTML = event.name;
        cell2.innerHTML = event.description;
        cell3.innerHTML = event.start;
        cell4.innerHTML = event.end;
        cell5.innerHTML = event.location;
        cell6.innerHTML = event.inchargeID;
        cell7.innerHTML = event.status;
        cell8.innerHTML = cell8.innerHTML = `
        <button type="button" class="btn btn-primary editEventBtn" data-bs-toggle="modal" data-bs-target="#editEventModal" value=${event.id}>
          <i class="bx bxs-edit"></i>
        </button>
        <button type="button" class="btn btn-primary deleteEventBtn" data-bs-toggle="modal" data-bs-target="#deleteEventModal" value=${event.id}>
          <i class='bx bx-x'></i>
        </button>
        <button type="button" class="btn btn-primary deltailEventBtn" value=${event.id}>
            <i class='bx bxs-report' ></i>
        </button>
        `;
      }
    }
  });
}

function displayEditEventModal(eventId) {
  $.ajax({
    method: "GET",
    url: "../controllers/getEventByEventId.php",
    data: { eventId: eventId },
    success: function (data) {
      var event = JSON.parse(data);
      $('#edit_eventName').val(event.name);
      $('#edit_eventDescription').val(event.description);
      $('#edit_eventStart').val(event.start);
      $('#edit_eventEnd').val(event.end);
      $('#edit_eventLocation').val(event.location);
      $('#edit_eventInchargeName').val(event.inchargeID);


      $('.studentEditModal').modal('show');
    }
  });
}

function createEventProcess() {
  let selectElement = document.getElementById('inchargeName'); // Lấy phần tử select theo id
  let selectedHostId = selectElement.options[selectElement.selectedIndex].value;

  $.ajax({
    url: "../controllers/createEvent.php",
    method: 'POST',
    data: {
      name: $('#event-name').val(),
      description: $('#description').val(),
      start: $('#start').val(),
      end: $('#end').val(),
      location: $('#location').val(),
      inchargeID: selectedHostId,
    },
    success: function (response) {
      alert("sucess");
      console.log(response);
      loadEventData();
    }
  });
}

function updateEvent(eventId) {
  $.ajax({
    method: "POST",
    url: "../controllers/updateEvent.php",
    data: {
      id : eventId,
      name: $('#edit_eventName').val(),
      description: $('#edit_eventDescription').val(),
      end: $('#edit_eventEnd').val(),
      location: $('#edit_eventLocation').val(),
    },
    success: function (data) {
      loadEventData();
      $('#editEventModal').modal('hide');
    }
  });
}

function deleteEvent(eventId) {
  $.ajax({
    method: "POST",
    url: "../controllers/deleteEvent.php",
    data: {
      id : eventId,
    },
    success: function (data) {
      loadEventData();
      $('#deleteEventModal').modal('hide');
    }
  });
}

$(document).ready(function(){
  loadEventData();
})

$(document).on('click',"#addEventBtn", function () {
  createEventProcess();
});

$(document).on('click', '.editEventBtn', function () {
  let eventId = $(this).val();
  $('.confirmEdit').val(eventId); // Gán giá trị eventId cho các phần tử có class confirmEdit
  displayEditEventModal(eventId);
});

$(document).on('click', ".confirmEdit", function () {
  let eventId = $(this).val();
  console.log(eventId);
  updateEvent(eventId);
});

$(document).on('click', '.deleteEventBtn', function () {
  let eventId = $(this).val();
  $('.confirmDelete').val(eventId); // Gán giá trị eventId cho các phần tử có class confirmEdit
});

$(document).on('click', ".confirmDelete", function () {
  let eventId = $(this).val();
  console.log(eventId);
  deleteEvent(eventId);
});

$(document).on('click', ".deltailEventBtn", function () {
  var eventId = $(this).val();
  // Set eventID to session variable
  $.ajax({
    url: "../controllers/setSessionEvent.php",
    method: "POST",
    data: { eventId: eventId },
    success: function(response) {
      // Redirect to another page after setting the session
      window.location.href = "1-2-1-overview.php";
    }
  });
});




