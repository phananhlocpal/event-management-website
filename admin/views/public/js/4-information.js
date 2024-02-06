
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

    $('#editMemberModal').modal('show');
    }
});
}


  function updateMember(memberId) {
    $.ajax({
      method: "POST",
      url: "../controllers/updateMemberInfo.php",
      data: {
        id : memberId,
        name: $('#edit_memberName').val(),
        email: $('#edit_memberEmail').val(),
        phone: $('#edit_memberPhone').val(),
        username: $('#edit_memberUsername').val(),
        password: $('#edit_memberPassword').val(),
      },
      success: function (data) {
        console.log(data);
        updateSession(memberId);
        console.log("Qua");
        $('#editUserModal').modal('hide');
        
      }
    });
  }


  $(document).on('click', '.editUserBtn', function () {
    let memberId = $(this).val();
    console.log("Hello!");
    $('.confirmEdit').val(memberId); // Gán giá trị eventId cho các phần tử có class confirmEdit
    displayEditMemberModal(memberId);
  });
  
  $(document).on('click', ".confirmEdit", function () {
    let memberId = $(this).val();
    console.log(memberId);
    updateMember(memberId);
  });
  
function updateSession(id) {
    $.ajax({
        url: '../controllers/updateSession.php',
        method: 'POST',
        data: {id: id},
        success: function(data) {
            console.log("Thành công");
            window.location.reload();
        }
    })
}