/*=======================Detail Media===================== */
const calendar = document.querySelector(".calendar"),
  date = document.querySelector(".date"),
  daysContainer = document.querySelector(".days"),
  prev = document.querySelector(".prev"),
  next = document.querySelector(".next"),
  todayBtn = document.querySelector(".today-btn"),
  eventDay = document.querySelector(".event-day"),
  eventDate = document.querySelector(".event-date"),
  eventsContainer = document.querySelector(".events"),
  addEventBtn = document.querySelector(".add-event"),
  addEventWrapper = document.querySelector(".add-event-wrapper "),
  addEventCloseBtn = document.querySelector(".close"),
  addEventTitle = document.querySelector(".event-name"),
  addEventFrom = document.querySelector(".event-time-from "),
  incharge = document.querySelector(".incharge "),
  addEventSubmit = document.querySelector(".add-event-btn ");

const months = [
  "January",
  "February",
  "March",
  "April",
  "May",
  "June",
  "July",
  "August",
  "September",
  "October",
  "November",
  "December",
];
  
var mediaData;
var eventsArr = [];
getEvents();
console.log(eventsArr);


let today = new Date();
let activeDay;
let month = today.getMonth();
let year = today.getFullYear();


//function to add days in days with class day and prev-date next-date on previous month and next month days and active on today
function initCalendar() {
  const firstDay = new Date(Date.UTC(year, month, 1));
  const lastDay = new Date(Date.UTC(year, month + 1, 0));
  const prevLastDay = new Date(Date.UTC(year, month, 0));
  const prevDays = prevLastDay.getUTCDate();
  const lastDate = lastDay.getUTCDate();
  const day = firstDay.getUTCDay();
  const nextDays = 7 - lastDay.getUTCDay() - 1;

  date.innerHTML = months[month] + " " + year;

  let days = "";

  for (let x = day; x > 0; x--) {
    days += `<div class="day prev-date">${prevDays - x + 1}</div>`;
  }

  for (let i = 1; i <= lastDate; i++) {
    //check if event is present on that day
    let event = false;
    eventsArr.forEach((eventObj) => {
      if (
        eventObj.day === i &&
        eventObj.month === month + 1 &&
        eventObj.year === year
      ) {
        event = true;
      }
    });

    const currentDate = new Date(Date.UTC(year, month, i));
    const formattedDate = currentDate.toISOString().split('T')[0];

    if (
      i === new Date().getUTCDate() &&
      year === new Date().getUTCFullYear() &&
      month === new Date().getUTCMonth()
    ) {
      activeDay = i;
      getActiveDay(i);
      updateEvents(i);
      if (event) {
        days += `<div class="day today active event" date="${formattedDate}">${i}</div>`;
      } else {
        days += `<div class="day today active" date="${formattedDate}">${i}</div>`;
      }
    } else {
      if (event) {
        days += `<div class="day event" date="${formattedDate}">${i}</div>`;
      } else {
        days += `<div class="day" date="${formattedDate}">${i}</div>`;
      }
    }
  }

  for (let j = 1; j <= nextDays; j++) {
    days += `<div class="day next-date" date=""></div>`;
  }
  daysContainer.innerHTML = days;
  addListner();
}


//function to add month and year on prev and next button
function prevMonth() {
  month--;
  if (month < 0) {
    month = 11;
    year--;
  }
  initCalendar();
}

function nextMonth() {
  month++;
  if (month > 11) {
    month = 0;
    year++;
  }
  initCalendar();
}

prev.addEventListener("click", prevMonth);
next.addEventListener("click", nextMonth);

initCalendar();

//function to add active on day
function addListner() {
  const days = document.querySelectorAll(".day");
  days.forEach((day) => {
    day.addEventListener("click", (e) => {
      getActiveDay(e.target.innerHTML);
      updateEvents(Number(e.target.innerHTML));
      activeDay = Number(e.target.innerHTML);
      //remove active
      days.forEach((day) => {
        day.classList.remove("active");
      });
      //if clicked prev-date or next-date switch to that month
      if (e.target.classList.contains("prev-date")) {
        prevMonth();
        //add active to clicked day afte month is change
        setTimeout(() => {
          //add active where no prev-date or next-date
          const days = document.querySelectorAll(".day");
          days.forEach((day) => {
            if (
              !day.classList.contains("prev-date") &&
              day.innerHTML === e.target.innerHTML
            ) {
              day.classList.add("active");
            }
          });
        }, 100);
      } else if (e.target.classList.contains("next-date")) {
        nextMonth();
        //add active to clicked day afte month is changed
        setTimeout(() => {
          const days = document.querySelectorAll(".day");
          days.forEach((day) => {
            if (
              !day.classList.contains("next-date") &&
              day.innerHTML === e.target.innerHTML
            ) {
              day.classList.add("active");
            }
          });
        }, 100);
      } else {
        e.target.classList.add("active");
      }
    });
  });
}

todayBtn.addEventListener("click", () => {
  today = new Date();
  month = today.getMonth();
  year = today.getFullYear();
  initCalendar();
});


//function get active day day name and date and update eventday eventdate
function getActiveDay(date) {
  const day = new Date(year, month, date);
  const dayName = day.toString().split(" ")[0];
  eventDay.innerHTML = dayName;
  eventDate.innerHTML = date + " " + months[month] + " " + year;
}

//function update events when a day is active
function updateEvents(date) {
  let events = "";
  eventsArr.forEach((event) => {
    if (
      date === event.day &&
      month + 1 === event.month &&
      year === event.year
    ) {
      console.log(event);
      event.events.forEach((event) => {
        events += `<div class="event">
            <div class="title">
              <i class="fas fa-circle"></i>
              <h3 class="event-title">${event.title}</h3>
            </div>
            <div class="event-time">
              <span class="event-time">${event.time}</span>
            </div>
            <div class="event-incharge">
              <span class="event-time">${event.incharge}</span>
            </div>
        </div>`;
      });
    }
  });
  if (events === "") {
    events = `<div class="no-event">
            <h3>No Events</h3>
        </div>`;
  }
  eventsContainer.innerHTML = events;
  saveEvents();
}

//function to add event
addEventBtn.addEventListener("click", () => {
  addEventWrapper.classList.toggle("active");
});

addEventCloseBtn.addEventListener("click", () => {
  addEventWrapper.classList.remove("active");
});

document.addEventListener("click", (e) => {
  if (e.target !== addEventBtn && !addEventWrapper.contains(e.target)) {
    addEventWrapper.classList.remove("active");
  }
});

//allow 50 chars in eventtitle
addEventTitle.addEventListener("input", (e) => {
  addEventTitle.value = addEventTitle.value.slice(0, 60);
});



//allow only time in eventtime from and to
addEventFrom.addEventListener("input", (e) => {
  addEventFrom.value = addEventFrom.value.replace(/[^0-9:]/g, "");
  if (addEventFrom.value.length === 2) {
    addEventFrom.value += ":";
  }
  if (addEventFrom.value.length > 5) {
    addEventFrom.value = addEventFrom.value.slice(0, 5);
  }
});


// //function to add event to eventsArr
// addEventSubmit.addEventListener("click", () => {
//   const eventTitle = addEventTitle.value;
//   const eventTime = addEventFrom.value;
//   const inchargeName = incharge.value;
//   if (eventTitle === "" || eventTime === "" || incharge === "") {
//     alert("Please fill all the fields");
//     return;
//   }

//   //check if event is already added
//   let eventExist = false;
//   eventsArr.forEach((event) => {
//     if (
//       event.day === activeDay &&
//       event.month === month + 1 &&
//       event.year === year
//     ) {
//       event.events.forEach((event) => {
//         if (event.title === eventTitle) {
//           eventExist = true;
//         }
//       });
//     }
//   });
//   if (eventExist) {
//     alert("Event already added");
//     return;
//   }
//   const newEvent = {
//     title: eventTitle,
//     time: eventTime,
//     incharge: inchargeName
//   };
//   console.log(newEvent);
//   console.log(activeDay);
//   let eventAdded = false;
//   if (eventsArr.length > 0) {
//     eventsArr.forEach((item) => {
//       if (
//         item.day === activeDay &&
//         item.month === month + 1 &&
//         item.year === year
//       ) {
//         item.events.push(newEvent);
//         eventAdded = true;
//       }
//     });
//   }

//   if (!eventAdded) {
//     eventsArr.push({
//       day: activeDay,
//       month: month + 1,
//       year: year,
//       events: [newEvent],
//     });
//   }

//   console.log(eventsArr);
//   addEventWrapper.classList.remove("active");
//   addEventTitle.value = "";
//   addEventFrom.value = "";
//   incharge.value = "";
//   updateEvents(activeDay);
//   //select active day and add event class if not added
//   const activeDayEl = document.querySelector(".day.active");
//   if (!activeDayEl.classList.contains("event")) {
//     activeDayEl.classList.add("event");
//   }
// });

// //function to delete event when clicked on event
// eventsContainer.addEventListener("click", (e) => {
//   if (e.target.classList.contains("event")) {
//     if (confirm("Are you sure you want to delete this event?")) {
//       const eventTitle = e.target.children[0].children[1].innerHTML;
//       eventsArr.forEach((event) => {
//         if (
//           event.day === activeDay &&
//           event.month === month + 1 &&
//           event.year === year
//         ) {
//           event.events.forEach((item, index) => {
//             if (item.title === eventTitle) {
//               event.events.splice(index, 1);
//             }
//           });
//           //if no events left in a day then remove that day from eventsArr
//           if (event.events.length === 0) {
//             eventsArr.splice(eventsArr.indexOf(event), 1);
//             //remove event class from day
//             const activeDayEl = document.querySelector(".day.active");
//             if (activeDayEl.classList.contains("event")) {
//               activeDayEl.classList.remove("event");
//             }
//           }
//         }
//       });
//       updateEvents(activeDay);
//     }
//   }
// });

// // function to mark event as done when clicked on event
// eventsContainer.addEventListener("click", (e) => {
//   if (e.target.classList.contains("event")) {
//     if (confirm("Are you sure you want to mark this event as completed?")) {
//       const eventElement = e.target;
//       eventElement.classList.toggle("completed-event"); // Thêm hoặc xóa lớp "completed-event"
//     }
//   }
// });

  


//function to save events in local storage
function saveEvents() {
  localStorage.setItem("events", JSON.stringify(eventsArr));
}


//function to get events from local storage
function getEvents() {
  //check if events are already saved in local storage then return event else nothing
  if (localStorage.getItem("events") === null) {
    return;
  }
  eventsArr.push(...JSON.parse(localStorage.getItem("events")));
}

function convertTime(time) {
  //convert time to 24 hour format
  let timeArr = time.split(":");
  let timeHour = timeArr[0];
  let timeMin = timeArr[1];
  let timeFormat = timeHour >= 12 ? "PM" : "AM";
  timeHour = timeHour % 12 || 12;
  time = timeHour + ":" + timeMin + " " + timeFormat;
  return time;
}



// const eventsArr = [
//   {
//     day: 13,
//     month: 11,
//     year: 2022,
//     events: [
//       {
//         title: "Event 1 lorem ipsun dolar sit genfa tersd dsad ",
//         time: "10:00 AM",
//       },
//       {
//         title: "Event 2",
//         time: "11:00 AM",
//       },
//     ],
//   },
// ];

$(document).on('click', ".day", function () {
  // Lấy tất cả các phần tử có class "day"
  const dayElements = document.querySelectorAll('.day');

  // Xóa class "active" khỏi tất cả các phần tử ".day"
  dayElements.forEach(dayElement => {
    dayElement.classList.remove('active');
  });

  // Thêm class "active" cho phần tử ".day" được click
  this.classList.add('active');

  // Lấy giá trị thuộc tính "date" của phần tử ".day.active"
  const selectedDate = this.getAttribute('date');

  // Gán giá trị selectedDate vào thuộc tính "data-date" của nút ".add-event-btn"
  $('.add-event-btn').attr('data-date', selectedDate);
});

// Xử lý sự kiện khi click vào nút ".add-event-btn"
$(document).on('click', ".add-event-btn", function () {
  const selectedDate = $(this).attr('data-date');

  if (selectedDate) {
    // Thực hiện hành động thêm sự kiện với giá trị selectedDate
    console.log(`Adding event for date: ${selectedDate}`);
    createMediaTask(selectedDate);
  } else {
    alert('Please select a date first.');
  }
});


function createMediaTask(selectedDate) {
  let selectElement = document.getElementById('inchargeName'); // Lấy phần tử select theo id
  let selectedInchargeId = selectElement.options[selectElement.selectedIndex].value;
  console.log(selectedDate);
  $.ajax({
    url: '../controllers/createMediaTask.php',
    method:'POST',
    data:{ 
      date: selectedDate,
      title: $(".event-name").val(),
      time: $(".event-time-from").val(),
      incharge: selectedInchargeId
     },
    success: function (data) {
      console.log(data);
      console.log("create Media Task successfully!");
      loadMediaTaskDetail();
    }
  });
}

function deleteMediaTaskDetail(mediaTaskDetailId) {
  $.ajax({
    url: '../controllers/deleteMediaTaskDetail.php',
    method:'POST',
    data:{ 
      mediaTaskDetailId: mediaTaskDetailId,
     },
    success: function (data) {
      console.log("Delete Media Task Detail successfully!");
    }
  });
}

$(document).ready(function() {
  loadMediaTaskDetail();
});

function loadMediaTaskDetail() {
  $.ajax({
    url: '../controllers/loadMediaDetailTask.php',
    method: 'POST',
    success: function(data) {
      
      var eventData = JSON.parse(data);
      if (Array.isArray(eventData)) {
        
        eventsArr = eventData; // Cập nhật dữ liệu vào biến eventsArr
      
        // Cập nhật lịch và hiển thị sự kiện trên trang web
        initCalendar();
      } else {
        console.error("Dữ liệu không phải mảng.");
      }
      
    }
  });
}

//function update events for all days in eventsArr
function updateAllEvents() {
  let allEvents = "";
  eventsArr.forEach((event) => {
    event.events.forEach((subEvent) => {
      allEvents += `<div class="event">
          <div class="title">
            <i class="fas fa-circle"></i>
            <h3 class="event-title">${subEvent.title}</h3>
          </div>
          <div class="event-time">
            <span class="event-time">${subEvent.time}</span>
          </div>
          <div class="event-incharge">
            <span class="event-time">${subEvent.incharge}</span>
          </div>
      </div>`;
    });
  });

  if (allEvents === "") {
    allEvents = `<div class="no-event">
        <h3>No Events</h3>
    </div>`;
  }
  eventsContainer.innerHTML = allEvents;
}