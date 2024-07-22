function filterTable() {
  var input, filter, table, tr, td, i, j;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td");
    for (j = 0; j < td.length; j++) {
      if (td[j].innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
        break;
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

$(document).ready(function() {
  $('#showPasswordCheckbox').change(function() {
    var passwordField = $('#epassword');
    if ($(this).is(':checked')) {
      passwordField.prop('type', 'text');
    } else {
      passwordField.prop('type', 'password');
    }
  });
});

$('#closeBtn').click(function(){
  // $('#edit-form').hide(1000)
  // $('#display').show();
  $('#myTable').show(1000);

})
$(function(){
  var id = Cookies.get('usertype')
  if (id === "Admin") {
    $.ajax({
        url: '/users',
        type: 'GET',
        dataType: 'json',
        success: function (result) {
            console.log(result.data);

            var dataTable = $('#userstable').DataTable();
            dataTable.clear();

            for (var x = 0; x < result.data.length; x++) {
                var rowData = [
                  '<div class="btn-group">' +
                  '<button class="btn btn-info editBtn" title="Edit book" data-toggle="modal" data-target="#editusermodal" data-id="' + result.data[x].userID + '"><i class="fa fa-edit" style="font-size:24px;"></i></button>' +
                  '</div>',
                  '<div class="btn-group">' +
                  '<button class="btn btn-danger deleteBtn" title="Delete book" data-id="' + result.data[x].userID + '"><i class="fa fa-trash-o" style="font-size:24px;"></i></button>' +
                  '</div>',
                    result.data[x].userID,
                    '<img src="/uploads/' + result.data[x].userImg + '" style="height:100px;width:100px;">',
                    result.data[x].firstname,
                    result.data[x].middlename,
                    result.data[x].lastname,
                    result.data[x].gender,
                    result.data[x].birthdate,
                    result.data[x].email,
                    result.data[x].phoneNo,
                    result.data[x].current_address,
                    result.data[x].city,
                    result.data[x].province,
                    result.data[x].zipcode,
                    result.data[x].username,
                    result.data[x].password,
                    result.data[x].userType
                ];
                dataTable.row.add(rowData);
            }
            dataTable.draw();

        // delete
        $(document).on('click', '.deleteBtn', function () {
          var id = $(this).data('id');
          console.log(id);

          Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
              if (result.isConfirmed) {
                  // Get CSRF token from the meta tag
                  var csrfToken = $('meta[name="csrf-token"]').attr('content');

                  $.ajax({
                      type: 'POST',
                      url: '/deleteUser',
                      data: {
                          id: id,
                          _token: csrfToken // Include the CSRF token in the data
                      },
                      dataType: 'json',
                      success: function (response) {
                          if (response.messageType == "success") {
                              Swal.fire({
                                  position: 'center',
                                  icon: 'success',
                                  title: 'Deleted successfully',
                                  showConfirmButton: true,
                                  timer: 1500
                              })
                              setTimeout(() => {
                                  location.reload();
                              }, 1500);
                          } else {
                              alert(response.message);
                          }
                          console.log(response);
                      },
                      error: function (xhr, status, error) {
                          console.log(xhr.responseText);
                      }
                  });
              }
          });
        });

        // edit
        $(document).on('click', '.editBtn', function () { 
          var id = $(this).data('id'); 
          console.log(id)
    
          var btn = this;
          const row = btn.closest('tr');
            var idno = row.cells[0].textContent;
            var userimg = row.cells[1].textContent;
            var fn = row.cells[4].textContent;
            var mn = row.cells[5].textContent;
            var ln = row.cells[6].textContent;
            var gen = row.cells[7].textContent;
            var dob = row.cells[8].textContent;
            var em = row.cells[9].textContent;
            var phn = row.cells[10].textContent;
            var crntadd = row.cells[11].textContent;
            var city = row.cells[12].textContent;
            var prov = row.cells[13].textContent;
            var zip = row.cells[14].textContent;
            var un = row.cells[15].textContent;
            var pwd = row.cells[16].textContent;
            var usrtp = row.cells[17].textContent;
    
            $('#eid').val(id)
            $('#efname').val(fn)
            $('#emname').val(mn)
            $('#elname').val(ln)
            $('#egender').val(gen)
            $('#ebirthdate').val(dob)
            $('#eemail').val(em)
            $('#ephoneNo').val(phn)
            $('#ecurrent_address').val(crntadd)
            $('#ecity').val(city)
            $('#eprovince').val(prov)
            $('#ezipcode').val(zip)
            $('#eusername').val(un)
            $('#epassword').val(pwd)
            $('#eusertype').val(usrtp)
    
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

          $('#edit-form').submit(function(event) {
            event.preventDefault();
            var formData1 = new FormData(this);
            formData1.append('_token', csrfToken);

            $.ajax({
              type: 'POST',
              url: '/updateUser',
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
                console.log(response)
              },
              error: function(xhr, status, error) {
                console.log(xhr.responseText); 
              }
            });          
          });
        });

        }
    });
    // add users
    $('#myForm').submit(function (event) {
      event.preventDefault();
      var formData = new FormData(this);

      // Include CSRF token in the headers
      var csrfToken = $('meta[name="csrf-token"]').attr('content');

      $.ajax({
          type: 'POST',
          url: '/createUser',
          data: formData,
          dataType: 'json',
          contentType: false,
          processData: false,
          headers: {
              'X-CSRF-TOKEN': csrfToken
          },
          success: function (response) {
              if (response.messageType == "success") {
                  Swal.fire({
                      position: 'center',
                      icon: 'success',
                      title: 'Added successfully',
                      showConfirmButton: true,
                      timer: 1500
                  })
                  setTimeout(() => {
                      location.reload();
                  }, 1500);
              } else {
                  alert(response.message);
              }
          },
          error: function (xhr, status, error) {
              console.log(xhr.responseText);
          }
      });
    });

    // add librarian
    $('#addlibrarianform').submit(function (event) {
      event.preventDefault();
      var formData = new FormData(this);

      // Include CSRF token in the headers
      var csrfToken = $('meta[name="csrf-token"]').attr('content');

      $.ajax({
          type: 'POST',
          url: '/createLibrarian',
          data: formData,
          dataType: 'json',
          contentType: false,
          processData: false,
          headers: {
              'X-CSRF-TOKEN': csrfToken
          },
          success: function (response) {
              if (response.messageType == "success") {
                  Swal.fire({
                      position: 'center',
                      icon: 'success',
                      title: 'Librian created successfully',
                      showConfirmButton: true,
                      timer: 1500
                  })
                  setTimeout(() => {
                      location.reload();
                  }, 1500);
              } else {
                  alert(response.message);
              }
          },
          error: function (xhr, status, error) {
              console.log(xhr.responseText);
          }
      });
    });

    // add admin
    $('#addadminForm').submit(function (event) {
      event.preventDefault();
      var formData = new FormData(this);

      // Include CSRF token in the headers
      var csrfToken = $('meta[name="csrf-token"]').attr('content');

      $.ajax({
          type: 'POST',
          url: '/createAdmin',
          data: formData,
          dataType: 'json',
          contentType: false,
          processData: false,
          headers: {
              'X-CSRF-TOKEN': csrfToken
          },
          success: function (response) {
              if (response.messageType == "success") {
                  Swal.fire({
                      position: 'center',
                      icon: 'success',
                      title: 'Admin created successfully',
                      showConfirmButton: true,
                      timer: 1500
                  })
                  setTimeout(() => {
                      location.reload();
                  }, 1500);
              } else {
                  alert(response.message);
              }
          },
          error: function (xhr, status, error) {
              console.log(xhr.responseText);
          }
      });
    });
}
  else if(id === "Librarian"){
    $.ajax({
      url: '/users',
      type: 'GET',
      dataType: 'json',
      success: function (result) {
          console.log(result.data);

          var dataTable = $('#userstable').DataTable();
          dataTable.clear();

          for (var x = 0; x < result.data.length; x++) {
              var rowData = [
                '<div class="btn-group">' +
                '<button class="btn btn-info editBtn" title="Edit book" data-toggle="modal" data-target="#editusermodal" data-id="' + result.data[x].userID + '"><i class="fa fa-edit" style="font-size:24px;"></i></button>' +
                '</div>',
                  result.data[x].userID,
                  '<img src="/uploads/' + result.data[x].userImg + '" style="height:100px;width:100px;">',
                  result.data[x].firstname,
                  result.data[x].middlename,
                  result.data[x].lastname,
                  result.data[x].gender,
                  result.data[x].birthdate,
                  result.data[x].email,
                  result.data[x].phoneNo,
                  result.data[x].current_address,
                  result.data[x].city,
                  result.data[x].province,
                  result.data[x].zipcode,
                  result.data[x].username,
                  result.data[x].password,
                  result.data[x].userType
              ];
              dataTable.row.add(rowData);
          }
          dataTable.draw();

        // edit
        $(document).on('click', '.editBtn', function () { 
          var id = $(this).data('id'); 
          console.log(id)
          var csrfToken = $('meta[name="csrf-token"]').attr('content');
          $.ajax({
            type: "POST",
            url: "/getOne",
            data: { id: id, _token: csrfToken },
            dataType: "json",
            success: function (response) {
              console.log(response.data)
              console.log(response.data[0].firstname)
              $('#eid').val(response.data[0].userID)
              $('#efname').val(response.data[0].firstname)
              $('#emname').val(response.data[0].middlename)
              $('#elname').val(response.data[0].lastname)
              $('#egender').val(response.data[0].gender)
              $('#ebirthdate').val(response.data[0].birthdate)
              $('#eemail').val(response.data[0].email)
              $('#ephoneNo').val(response.data[0].phoneNo)
              $('#ecurrent_address').val(response.data[0].current_address)
              $('#ecity').val(response.data[0].city)
              $('#eprovince').val(response.data[0].province)
              $('#ezipcode').val(response.data[0].zipcode)
              $('#eusername').val(response.data[0].username)  
              $('#epassword').val(response.data[0].password)
              $('#eusertype').val(response.data[0].userType)
            }
          });
          $('#edit-form').submit(function(event) {
            event.preventDefault();
            var formData1 = new FormData(this);
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            formData1.append('_token', csrfToken);

            // formData1.forEach(function(value, key) {
            //   console.log(key, value);
            // });
            $.ajax({
              type: 'POST',
              url: '/updateUser',
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
                console.log(response)
              },
              error: function(xhr, status, error) {
                console.log(xhr.responseText); 
              }
            });          
          });
        });

      }
  });
    //add user
    $('#myForm').submit(function(event) {
      event.preventDefault();
      var formData = new FormData(this);
      var csrfToken = $('meta[name="csrf-token"]').attr('content');
      formData.append('_token', csrfToken);
      $.ajax({
        type: 'POST',
        url: '/createUser',
        data: formData,
        dataType: 'json', 
        contentType: false,
        processData: false,
        success: function(response) {
          if(response.messageType == "success"){
                Swal.fire({
                  position: 'center',
                  icon: 'success',
                  title: 'Added successfully',
                  showConfirmButton: true,
                  timer: 1500
                })   
              setTimeout(() => {
                location.reload();
              }, 1500);   
              }else{
                alert(response.message); 
              }
        },
        error: function(xhr, status, error) {
          console.log(xhr.responseText); 
        }
      });
    });
  }			
});