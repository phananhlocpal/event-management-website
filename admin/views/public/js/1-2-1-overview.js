let overviewBtn = document.querySelector('.tab ul li:nth-child(1)');
  overviewBtn.classList.add('overviewActive');


$(document).ready(function() {
  loadNotDoneTask()
})

function loadNotDoneTask() {
  $.ajax({
    url: '../controllers/loadNotDoneTask.php',
    method: 'POST',
    success: function (data) {
      // Parse dữ liệu JSON từ phản hồi

      const tasks = JSON.parse(data);

      // Tạo một chuỗi HTML để hiển thị danh sách task
      let taskHtml = '';
      tasks.forEach(task => {
        // Tính toán ngày kết thúc dựa trên ngày bắt đầu và duration
        const startDate = new Date(task.start);
        const endDate = new Date(startDate);
        endDate.setDate(startDate.getDate() + task.duration);

        taskHtml += `
          <div class="taskCard" style="width: 100%;">
            <div class="taskCard-body">
              <h5 class="taskCard-title">On Processing</h5>
              <p class="taskCard-text">${task.taskName}</p>
              <p class="taskCard-deadline">Deadline: ${endDate.toDateString()}</p>
            </div>
          </div>`;
      });

      // Gán chuỗi HTML đã tạo vào phần tử có class "not-done-task"
      $('.not-done-task').html(taskHtml);
    },
    error: function (error) {
      console.error("Error loading tasks:", error);
    }
  });
}
