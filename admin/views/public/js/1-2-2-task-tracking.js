// Lấy tham chiếu đến nút theo dõi công việc trên tab
let taskTrackingBtn = document.querySelector('.tab ul li:nth-child(2)');
taskTrackingBtn.classList.add('taskTrackingActive');

let addFolderTask = document.querySelector('.gantt_grid_head_cell gantt_grid_head_add gantt_last_cell'),
addDetailTask = document.querySelector('.gantt_add');

var ganttChart = document.getElementById('gantt_here');
var startDate = ganttChart.getAttribute('data-start-date');
var endDate = ganttChart.getAttribute('data-end-date');

// Chuyển đổi các chuỗi ngày thành đối tượng Date
var start = new Date(startDate);
var end = new Date(endDate);

// Đặt ngày bắt đầu và kết thúc cho biểu đồ Gantt
gantt.config.start_date = start;
gantt.config.end_date = end;

gantt.config.columns = [
  {name: "text", label: "Task name", tree:true, width: 150},
  {name: "holder", label: "Holder", align: "center", width: 80},
  {name: "start_date", label: "Start time", align: "center", width: 80},
  {name: "duration", label: "Duration", align: "center", width: 80},
  {name: "add",  align: "center", width: 40},
]
gantt.init("gantt_here");

function loadTaskData() {
  gantt.clearAll();

  $.ajax({
    url: "../controllers/loadTaskData.php",
    method: 'GET', 
    dataType: 'json', // Chỉ định kiểu dữ liệu trả về
    success: function(response) {
      console.log(response);
      const inchargeInfo = {}; // Đối tượng lưu thông tin người phụ trách
    
      // Lặp qua mảng response để lấy thông tin người phụ trách
      response.forEach(item => {
        const inchargeID = item.inchargeID;
    
        // Thực hiện truy vấn để lấy thông tin người phụ trách dựa trên inchargeID
        $.ajax({
          url: `../controllers/getUsernameById.php`,
          data: {id: inchargeID}, // Thay đổi URL của truy vấn
          method: 'POST',
          dataType: 'json',
          success: function(inchargeResponse) {
            console.log(inchargeResponse);
            if (inchargeResponse) {
              const inchargeName = inchargeResponse.username; // Thay bằng tên trường chứa tên người phụ trách trong dữ liệu
    
              // Lưu thông tin người phụ trách vào đối tượng inchargeInfo
              inchargeInfo[inchargeID] = inchargeName;
              var parsedData = {
                data: response.map(item => ({
                  id: item.id,
                  text: item.taskName,
                  start_date: new Date(item.start),
                  duration: item.duration,
                  holder: inchargeInfo[item.inchargeID], // Sử dụng thông tin từ inchargeInfo
                  parent: item.parentTaskId
                }))
              };
    
                console.log(parsedData);
                gantt.parse(parsedData);
            }
          },
          error: function(error) {
            console.error("Error fetching incharge data:", error);
          }
        });
      });
    },
    error: function(error) {
      console.error("Error fetching data:", error);
    }
  });
}

$(document).ready(function(){
  loadTaskData();
});

//===================================================================================================

var create = "";
var parentTaskId = 0;
var task_id;

// Bắt sự kiện click vào phần tử .gantt_cell .gantt_last_cell
$(document).on('click', ".gantt_cell.gantt_last_cell", function () {
  create = "Child";
  console.log("Loại công việc: Child");
  const confirmBtn = document.querySelector('.gantt_btn_set.gantt_left_btn_set.gantt_save_btn_set');
  confirmBtn.setAttribute('data-bs-toggle', 'modal');
  confirmBtn.setAttribute('data-bs-target', '#confirmAddInchargeTask');
  confirmBtn.setAttribute('taskName', 'create');
});

// Bắt sự kiện click vào phần tử .gantt_grid_head_cell.gantt_grid_head_add.gantt_last_cell
$(document).on('click', ".gantt_grid_head_cell.gantt_grid_head_add.gantt_last_cell", function () {
  create = "Parent";
  console.log("Loại công việc: Parent");
  const confirmBtn = document.querySelector('.gantt_btn_set.gantt_left_btn_set.gantt_save_btn_set');
  confirmBtn.setAttribute('data-bs-toggle', 'modal');
  confirmBtn.setAttribute('data-bs-target', '#confirmAddInchargeTask');
  confirmBtn.setAttribute('taskName', 'create');
});


$(document).on('dblclick', '.gantt_row.gantt_selected.gantt_row_task', function() {
  const confirmBtn = document.querySelector('.gantt_btn_set.gantt_left_btn_set.gantt_save_btn_set');
  confirmBtn.setAttribute('data-bs-toggle', 'modal');
  confirmBtn.setAttribute('data-bs-target', '#confirmAddInchargeTask');
  confirmBtn.setAttribute('taskName', 'update');
  var ganttChart = this;
  let taskId = ganttChart.getAttribute('task_id');
  console.log(taskId);
  confirmBtn.setAttribute('task_id', taskId);
  const confirmDelete = document.querySelector('.gantt_btn_set.gantt_left_btn_set.gantt_delete_btn_set');
  confirmDelete.setAttribute('task_id', taskId);
})



$(document).on('click', ".gantt_btn_set.gantt_left_btn_set.gantt_save_btn_set", function() {
  if (this.getAttribute('taskName') == 'create'){
    createTask(create);
  } else {
    let taskId = this.getAttribute('task_id');
    updateTask(taskId);
  }
  
})

$(document).on('click', ".gantt_add", function() {
  // Tìm thẻ cha gần nhất có class "gantt_row_task"
  var parentRow = $(this).closest('.gantt_row.gantt_row_task');

  // Lấy giá trị của thuộc tính "task_id" từ thẻ cha
  task_id = parentRow.attr('task_id');

  console.log('task_id:', task_id);
  // Thực hiện các hành động khác tại đây
});


// Lấy tham chiếu đến các phần tử <select>
function createTask(task) {
  if (task == "Child") {
    parentTaskId = task_id;
    console.log(parentTaskId);
  } else {
    parentTaskId = null;
    console.log('đã nhận');
  };

  let daysSelect = document.querySelector('.gantt_time_selects select[aria-label="Days"]');
  let monthsSelect = document.querySelector('.gantt_time_selects select[aria-label="Months"]');
  let yearsSelect = document.querySelector('.gantt_time_selects select[aria-label="Years"]');
  
  let selectedDay = daysSelect.options[daysSelect.selectedIndex].value;
  let selectedMonth = parseInt(monthsSelect.options[monthsSelect.selectedIndex].value) + 1; // Tăng giá trị tháng lên 1
  let selectedYear = yearsSelect.options[yearsSelect.selectedIndex].value;
  
  console.log(selectedDay);
  console.log(selectedMonth);
  console.log(selectedYear);
  
  let selectedDate = new Date(selectedYear, selectedMonth - 1, selectedDay); // Giảm giá trị tháng xuống 1 khi tạo đối tượng Date
  let formattedDate = `${selectedDate.getFullYear()}-${selectedDate.getMonth() + 1}-${selectedDate.getDate()}`;
  console.log("Selected Date:", formattedDate);
  
  console.log(parentTaskId);

  $.ajax({
    url: "../controllers/createTask.php",
    method: 'POST',
    data: {
      taskName: $('.gantt_cal_ltext textarea').val(),
      start: formattedDate,
      duration: $('.gantt_duration_value').val(),
      parentTaskId: parentTaskId
    },
    success: function (response) {
      console.log("sucess");
      console.log(response);
      $(document).on('click', '.confirmAddInchargeTask', function() {
        addInchargeTask(response);
        $('#confirmAddInchargeTask').modal('hide');
      })
    }
  });
}

function addInchargeTask(id) {
  let selectElement = document.getElementById('inchargeName'); // Lấy phần tử select theo id
  let incharge = selectElement.options[selectElement.selectedIndex].value;
  console.log(id);
  console.log(incharge);

  $.ajax({
    url: "../controllers/addInchargeTask.php",
    method: 'POST',
    data: {
      id: id,
      incharge: incharge
    },
    success: function (response) {
      console.log(response);
      loadTaskData();
    }
  });
}

//===================================================================
$(document).on('click', '.gantt_popup_button.gantt_ok_button', function() {
  const confirmDelete = document.querySelector('.gantt_btn_set.gantt_left_btn_set.gantt_delete_btn_set');
  let taskId = confirmDelete.getAttribute('task_id');
  deleteTask(taskId);
});

function deleteTask(taskId) {
  $.ajax({
    url: "../controllers/deleteTask.php",
    method: 'POST',
    data: { id: taskId },
    success: function (response) {
      console.log("Delete task sucessfully!");
      console.log(response);
      loadTaskData();
    }
  });
}

//====================================================
function updateTask(taskId) {
  console.log("Task Id là");
  console.log(taskId);

  let daysSelect = document.querySelector('.gantt_time_selects select[aria-label="Days"]');
  let monthsSelect = document.querySelector('.gantt_time_selects select[aria-label="Months"]');
  let yearsSelect = document.querySelector('.gantt_time_selects select[aria-label="Years"]');
  
  let selectedDay = daysSelect.options[daysSelect.selectedIndex].value;
  let selectedMonth = parseInt(monthsSelect.options[monthsSelect.selectedIndex].value) + 1; // Tăng giá trị tháng lên 1
  let selectedYear = yearsSelect.options[yearsSelect.selectedIndex].value;
  
  console.log(selectedDay);
  console.log(selectedMonth);
  console.log(selectedYear);
  
  let selectedDate = new Date(selectedYear, selectedMonth - 1, selectedDay); // Giảm giá trị tháng xuống 1 khi tạo đối tượng Date
  let formattedDate = `${selectedDate.getFullYear()}-${selectedDate.getMonth() + 1}-${selectedDate.getDate()}`;
  console.log("Selected Date:", formattedDate);
  

  $.ajax({
    url: "../controllers/updateTask.php",
    method: 'POST',
    data: {
      id: taskId,
      taskName: $('.gantt_cal_ltext textarea').val(),
      start: formattedDate,
      duration: $('.gantt_duration_value').val(),
    },
    success: function (response) {
      console.log("sucess");
      console.log(response);
      $(document).on('click', '.confirmAddInchargeTask', function() {
        addInchargeTask(response);
        $('#confirmAddInchargeTask').modal('hide');
      })
    }
  });
}


