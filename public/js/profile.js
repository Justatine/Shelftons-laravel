$(function(){
    var id = Cookies.get('userid');
    // console.log(id)
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
      type: "POST",
      url: "/getOne",
      data: { id: id, _token: csrfToken },
      dataType: "json",
      success: function (result) {
          console.log(result.data);
  
          var row = "";
          for (var x = 0; x < result.data.length; x++) {
              var userData = result.data[x];
              row += '<div class="container">';
              row += '<div class="row">';
              row += '<div class="col-md-4">';
              row += '<div class="container" style="border-radius: 10px; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; padding: 10px 10px 10px 10px;">';
              row += '<center><img src="/uploads/' + userData.userImg + '" alt="" id="img-container" style="height: 300px; width: 300px; border-radius: 50%;">';
              row += '<form id="change-pic-form" enctype="multipart/form-data" style="display: none;">';
              row += '<input type="text" name="eid"  class="form-control" value="' + userData.userID + '" hidden>';
              row += '<input type="file" name="newuserimg"  class="form-control"><br>';
              row += '<button type="submit" class="btn btn-primary btn-sm btn-block" name="change-pic">Update Pic</button>';
              row += '<button class="btn btn-danger btn-sm btn-block" type="button" id="close">x</button>';    
              row += '</form>';
              row += '<br><br><strong><h3>' + userData.firstname + " " + userData.middlename + " " + userData.lastname + '</strong></center><br>';
              row += '<button type="button" class="btn btn-primary btn-sm btn-block" id="edit-info">Edit Info</button>';
              row += '<button type="button" class="btn btn-primary btn-sm btn-block" id="change-pass" data-id>Change Password</button>';
              row += '<button type="button" class="btn btn-primary btn-sm btn-block" id="change-pic">Change Profile Picture</button>';
              row += '<button type="button" class="btn btn-info btn-sm btn-block" data-toggle="modal" data-target="#viewbr">Borrow Records</button>';
              row += '<hr><div class="col-md-12 mb-3 passwordchange" style="display:none;">';
              row += '<div class="alert alert-warning" role="alert" style="border-left: 8px solid #e4b829e3;">'; 
              row += '<h4 class="alert-heading">Note:</h4>';  
              row += '<p>Your password requires 1 uppercase, 1 lowercase, 1 number, and 1 special character.</p><hr></hr>';  
              row += '<p class="mb-0">We will never share your password with anyone else.</p>';  
              row += '</div>';
              row += '<label for="validationServer01">New Password:</label>';   
              row += '<input type="password" class="form-control" id="newpassword" placeholder="New password" value="' + userData.password + '" required>';  
              row +='<input type="checkbox" id="showPasswordCheckbox" name="showPasswordCheckbox"><label for="showPasswordCheckbox">Show Password</label>';
              row += '<small id="passwordHelpBlock" class="form-text text-muted">Your password must be 8-20 characters long and must not contain emojis.</small>';
              row += '<div class="valid-feedback">Strong password</div><br>';  
              row += '<div class="row"><button type="button" class="btn btn-primary ml-5" id="newpass">Save</button>';
              row += '<button type="button" class="btn btn-danger ml-2"  id="cancelnewpass">Cancel</button></div>';
              row += '</div>';   
              row += '</div>';
              row += '</div>'; 
              row += '<div class="col-md-8" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; border-radius: 10px;">';
              row += '<center><h2>Account Personal Information</h2></center><hr>';
              row += '<form id="edit-form" enctype="multipart/form-data">'; 
              row += '<div class="info">';
              row += '<h2>NAME</h2>';
              row += '<div class="row">';
              row += '<div class="col-md-3">';
              row += '<h5>Username</h5>';
              row += '</div>';
              row += '<div class="col-md-9">';
              row += '<input type="text" name="eid"  class="form-control" value="' + userData.userID + '" hidden>';
              row += '<h4><input name="eusername" id="input" class="form-control" type="text" value="' + userData.username + '" readonly></h4>';
              row += '</div>';
              row += '</div>';
              row += '<div class="row">';
              row += '<div class="col-md-3">';
              row += '<h5>First Name</h5>';
              row += '</div>';
              row += '<div class="col-md-9">';
              row += '<h4><input name="efname" id="input" class="form-control" type="text" value="' + userData.firstname + '" readonly></h4>';
              row += '</div>';
              row += '</div>';
              row += '<div class="row">';
              row += '<div class="col-md-3">';
              row += '<h5>Middle Initial</h5>';
              row += '</div>';
              row += '<div class="col-md-9">';
              row += '<h4><input  name="emname" id="input" class="form-control" type="text" value="' + userData.middlename + '" readonly></h4>';
              row += '</div>';
              row += '</div>';
              row += '<div class="row">';
              row += '<div class="col-md-3">';
              row += '<h5>Last Name</h5>';
              row += '</div>';
              row += '<div class="col-md-9" style="margin-bottom: 20px;">';
              row += '<h4><input name="elname" id="input" class="form-control" type="text" value="' + userData.lastname + '" readonly></h4>';
              row += '</div>';
              row += '</div>';
              row += '<h2>DETAILS</h2>';
              row += '<div class="row">';
              row += '<div class="col-md-3">';
              row += '<h5>Gender</h5>';
              row += '</div>';
              row += '<div class="col-md-9">';
              row += '<h4><select name="gender" id="select" class="form-control" disabled>';
              row += '<option value="' + userData.gender + '" selected="selected">' + userData.gender + '</option>';
              row += '</select></h4>';
              row += '</div>';
              row += '</div>';
              row += '<div class="row">';
              row += '<div class="col-md-3">';
              row += '<h5>Birth Date:</h5>';
              row += '</div>';
              row += '<div class="col-md-9">';
              row += '<h4><select name="birth-date" id="select" class="form-control" disabled>';
              row += '<option value="' + userData.birthdate + '" selected="selected">' + userData.birthdate + '</option>';
              row += '</select></h4>';
              row += '</div>';
              row += '</div>';
              row += '<div class="row">';
              row += '<div class="col-md-3">';
              row += '<h5>Contact No.</h5>';
              row += '</div>';
              row += '<div class="col-md-9">';
              row += '<h4><input name="ephoneNo" id="input" class="form-control" type="text" value="' + userData.phoneNo + '" readonly></h4>';
              row += '</div>';
              row += '</div>';
              row += '<div class="row">';
              row += '<div class="col-md-3">';
              row += '<h5>Email Address</h5>';
              row += '</div>';
              row += '<div class="col-md-9" style="margin-bottom: 20px;">';
              row += '<h4><input style="width: 250px;" name="eemail" id="input" class="form-control" type="text" value="' + userData.email + '" readonly></h4>';
              row += '</div>';
              row += '</div>';
              row += '<h2>ADDRESS</h2>';
              row += '<div class="row">';
              row += '<div class="col-md-3">';
              row += '<h5>Current Address</h5>';
              row += '</div>';
              row += '<div class="col-md-9">';
              row += '<h4><input name="ecurrent_address" id="input" class="form-control" type="text" value="' + userData.current_address + '" readonly></h4>';
              row += '</div>';
              row += '</div>';
              row += '<div class="row">';
              row += '<div class="col-md-3">';
              row += '<h5>City</h5>';
              row += '</div>';
              row += '<div class="col-md-9">';
              row += '<h4><input name="ecity" id="input" class="form-control" type="text" value="' + userData.city + '" readonly></h4>';
              row += '</div>';
              row += '</div>';
              row += '<div class="row">';
              row += '<div class="col-md-3">';
              row += '<h5>Province</h5>';
              row += '</div>';
              row += '<div class="col-md-9">';
              row += '<h4><input name="eprovince" id="input" class="form-control" type="text" value="' + userData.province + '" readonly></h4>';
              row += '</div>';
              row += '</div>';
              row += '<div class="row">';
              row += '<div class="col-md-3">';
              row += '<h5>Zipcode</h5>';
              row += '</div>';
              row += '<div class="col-md-9">';
              row += '<h4><input name="ezipcode" id="input" class="form-control" type="text" value="' + userData.zipcode + '" readonly></h4>';
              row += '</div>';
              row += '</div>';
              row +='<hr><div class="row btn-section" style="display: none;">';
              row +='<div class="col-md-12">';   
              row +='<center><button type="submit" class="btn btn-primary" name="update-profile" >Update</button></center>';         
              row +='</div>';  
              row +='</div><br>';
              row += '</div>';
              row += '</form>';
              row +='<center><button type="submit" class="btn btn-primary" id="cancel-btn">Cancel</button></center>';   
              row +='<br><br>';      
              row += '</div>';
              row += '</div>';
              row += '</div>';
          }
  
          $("#personalinfo").html(row);

          $('#edit-form').submit(function(event) {
            event.preventDefault();
            var formData1 = new FormData(this);
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            formData1.append('_token', csrfToken);

            $.ajax({
            type: 'POST',
            url: '/profileUpdate',
            data: formData1,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
                if(response.messageType == "success"){
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Updated successfully',
                    showConfirmButton: true,
                    timer: 1500,
                })   
                setTimeout(() => {
                  location.reload();
                }, 1500);   
                }else{
                console.log(response)
                }
                // console.log(response)
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText); 
            }
            });          
          });

          $('#newpass').click(function () { 
            var id = Cookies.get('userid');
            var passid = $('#newpassword').val();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
              type: "POST",
              url: "/checkPassword",
              data: {
                id: id, 
                passid: passid,
                _token: csrfToken
              },
              dataType: "json",
              success: function (response) {
                if (response.messageType === "success") {
                $('#newpassword').removeClass('form-control').addClass('form-control is-valid');
                  Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: response.message,
                    showConfirmButton: true,
                  }).then((result) => {
                    if (result.isConfirmed) {
                      Swal.fire({
                        title: 'Do you want to save the changes?',
                        showDenyButton: true,
                        showCancelButton: true,
                        confirmButtonText: 'Save',
                        denyButtonText: `Don't save`,
                      }).then((result) => {
                        if (result.isConfirmed) {
                          $.ajax({
                            type: "POST",
                            url: "/changePassword",
                            data: {
                              id: id,
                              passid: passid,
                              _token: csrfToken                                
                            },
                            dataType: "json",
                            success: function (response) {
                              if (response.messageType === "success") {
                                Swal.fire({
                                  position: 'center',
                                  icon: 'success',
                                  title: response.message,
                                  showConfirmButton: true,
                                });
                                setTimeout(() => {
                                  location.reload();
                                }, 1500);
                              } else {
                                alert(response.message);
                              }
                            },
                            error: function () {
                              alert("Error occurred while updating status.");
                            }
                          });
                        } else if (result.isDenied) {
                          Swal.fire('Changes are not saved', '', 'info');
                        }
                      });
                    }
                  });
                } else {
                  Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: response.message,
                    showConfirmButton: true
                  });
                  $('#newpassword').removeClass('form-control').addClass('form-control is-invalid');
                }
              },
              error: function () {
                alert("Error occurred while updating password.");
              }
            });
          });
                      
          $('#change-pic-form').submit(function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            formData.append('_token', csrfToken);

            $.ajax({
            type: 'POST',
            url: '/updateImage',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
                if(response.messageType == "success"){
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Updated successfully',
                    showConfirmButton: true,
                    timer: 1500,
                })   
                setTimeout(() => {
                location.reload();
                }, 1500);   
                }else{
                console.log(response)
                }
                // console.log(response)
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText); 
            }
            });          
        });

        $('#change-pass').click(function () { 
            $('#edit-info').fadeOut(500);
            $('#change-pic').fadeOut(500);
            $('.passwordchange').show(500);
        });

        $('#cancelnewpass').click(function () { 
            $('#edit-info').show(500);
            $('#change-pic').show(500);
            $('.passwordchange').hide(500);
        });

            $('#change-pic').click(function () { 
            $('#img-container').fadeOut(500);
            $('#change-pic-form').fadeIn(500);
            });
    
            $('#close').click(function () { 
            $('#img-container').fadeIn(500);
            $('#change-pic-form').fadeOut(500);
            });
    
            $('#edit-info').click(function () { 
            $('input[id="input"]').removeClass("form-control").addClass("no-outline");
            $('input[id="input"]').removeAttr("readonly");
            $('.btn-section').show();
            });
    
            $('#cancel-btn').click(function () { 
            $('input[id="input"]').removeClass("no-outline").addClass("form-control");
            $('input[id="input"]').attr("readonly", "readonly");
            $('.btn-section').hide();
        });
      }
  });
  
})    
    
$(document).ready(function() {
  $('#showPasswordCheckbox').change(function() {
    var passwordField = $('#newpassword');
    if ($(this).is(':checked')) {
      passwordField.prop('type', 'text');
    } else {
      passwordField.prop('type', 'password');
    }
  });
});

//user side borrow
$(function() {
  var id = Cookies.get('userid');
  var csrfToken = $('meta[name="csrf-token"]').attr('content');

  $.ajax({
    type: "POST",
    url: "/getBorrowDetails",
    data: { id: id, _token: csrfToken },
    dataType: "json",
    success: function(result) {
      var dataTable = $('#borrowtable').DataTable();
      dataTable.clear();

      for (var x = 0; x < result.length; x++) {
        var rowData = [
          result[x].borrowID,
          result[x].userID,
          result[x].borrowISBN,
          result[x].borrowDate,
          result[x].returnSchedule,
          result[x].borrowStatus,
          result[x].fine,
          '<div class="btn-group" style="display:none;">'+result[x].borrowFine+'</div>',
          '<div class="btn-group">' + (result[x].borrowStatus !== "Pending" ? '<button class="btn btn-danger cancel" data-id="' + result[x].borrowID + '" disabled>Cancel</button>' : (result[x].borrowStatus === "Cancelled" ? '<button class="btn btn-info cancel" data-id="' + result[x].borrowID + '" disabled>Cancelled</button>' : '<button class="btn btn-info cancel" data-id="' + result[x].borrowID + '" >Cancel</button>')) + '</div>',
          '<div class="btn-group">' + (result[x].borrowStatus === "Approved" ? '<button class="btn btn-info lost" data-toggle="modal" data-target="#lostModal" data-id="' + result[x].borrowID + '">Lost</button>' : '') + '</div>'
        ];
      
        dataTable.row.add(rowData);
      }      
      dataTable.draw();

    //cancel borrow
    $('.cancel').click(function() {
      var id = $(this).data('id'); 
      var csrfToken = $('meta[name="csrf-token"]').attr('content');

      // console.log(id) 
      Swal.fire({
      title: 'Do you want to cancel borrowing this book??',
      showDenyButton: true,
      showCancelButton: false,
      confirmButtonText: 'Yes, cancel borrow',
      denyButtonText: `Back`,
      }).then((result) => {
      if (result.isConfirmed) {
        
          $.ajax({
          type: 'POST',
          url: '/cancelBorrow',
          data: { 
              borrowID: id,   _token: csrfToken     
          }, 
          dataType: 'json',
          success: function(response) {
              if(response.messageType == "success"){
              Swal.fire({
                  position: 'center',
                  icon: 'success',
                  title: 'Cancelled successfully',
                  showConfirmButton: true,
                  timer: 1500
              })   
              setTimeout(() => {
              location.reload();
              }, 2000);   
              }else{
              // alert(response.message); 
              }
              // console.log(response)
              setTimeout(() => {
              location.reload();
              }, 2000);           },
          error: function(xhr, status, error) {
              console.log('failed'); 
              setTimeout(() => {
              location.reload();
              }, 2000);           }
          });   
          } else if (result.isDenied) {
          Swal.fire('Changes are not saved', '', 'info')
      }
      })       
    });

    //lost book fine update
    $(document).on('click', '.lost', function () { 
      // var id = $(this).data('id'); 

        var btn = this;
        const row = btn.closest('tr');
        var bid  = row.cells[0].textContent;
        var id = row.cells[2].textContent;
        var fine  = row.cells[6].textContent;
        var borrowFine  = row.cells[7].textContent;


        $('#ed_returnStatus').val(bid);
        $('#lostfine').val(borrowFine);
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
          type: "POST",
          url: "/getBookDetails",
          data: { id : id, _token: csrfToken },
          dataType: "json",
          success: function(response20) {
            html1 = "";
            html2 = "";
            for (var i = 0; i < response20.length; i++) {
              html1 += response20[i].bookTitle;
              html2 + response20[i].replacementCost;
            }
          $("#bookname").html(html1);
          $("#repcost").html(html2);
          }
        })

        $('#lostForm').submit(function(event) {
          event.preventDefault();
          var csrfToken = $('meta[name="csrf-token"]').attr('content');

          $.ajax({
              type: 'POST',
              url: '/updateLost',
              data: { 
                borrowID: bid,
                borrowFine: borrowFine,
                _token: csrfToken                                 
              }, 
              dataType: 'json',
              success: function(response) {
              if(response.messageType == "success"){
                  Swal.fire({
                  position: 'center',
                  icon: 'success',
                  title: 'Record updated successfully',
                  text: 'Make a payment in order to borrow again.',
                  showConfirmButton: true,
                  timer: 3000
                  })   
              setTimeout(() => {
                  location.reload();
              }, 3000);   
              }else{
                  alert(response.message); 
              }
              // console.log(response)
              setTimeout(() => {
                  location.reload();
              }, 2000);           },
              error: function(xhr, status, error) {
              console.log('failed'); 
              setTimeout(() => {
                  location.reload();
              }, 2000);           
              }
          });          
        });
    })
    }
  });
});