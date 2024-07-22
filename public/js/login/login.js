$(document).ready(function () {
    if (Cookies.get('usertype') != undefined) {
      Swal.fire({
        icon: 'error',
        title: 'Please login first.',
        footer: '<a href="../../login/">Login here.</a>',
        timer: 2000
      })
      setTimeout(() => {
        location.replace('../user/');
      }, 2000);     
      // window.location.replace('../user/index');
    }
    
  $('#loginForm').submit(function (e) {
    e.preventDefault()
    var formData = new FormData(this)
    formData.append('login', 1)
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    formData.append('_token', csrfToken);
    
    // Print formData values
    for (var pair of formData.entries()) {
      console.log(pair[0] + ': ' + pair[1]);
    }

    console.log(authenticateURL)
    $.ajax({
      type: "POST",
      url: authenticateURL,
      data: formData,
      dataType: "json",
      contentType: false,
      processData: false,
      success: function (data) {
        console.log(data)
        	console.log('ut'+data.userType);
          console.log(data.userID);

          Cookies.set('usertype', data.userType);
          Cookies.set('userid', data.userID);

          if (data.userType === "Patron") {
            Swal.fire({
              position: 'center',
              icon: 'success',
              title: 'Login successfully',
              showConfirmButton: true,
              text: 'Welcome user',
              timer: 1500
            })
            setTimeout(() => {
              window.location.href = "/user/index";
            }, 2000); 

          } else if (data.userType === "Admin") {
            Swal.fire({
              position: 'center',
              icon: 'success',
              title: 'Login successfully',
              showConfirmButton: true,
              text: 'Welcome Admin',
              timer: 1500
            })
            setTimeout(() => {
              window.location.href = "/admin/index";
            }, 2000); 
          }
          else if (data.userType === "Librarian") {
            Swal.fire({
              position: 'center',
              icon: 'success',
              title: 'Login successfully',
              showConfirmButton: true,
              text: 'Welcome Librarian ',
              timer: 1500
            })
            setTimeout(() => {
              window.location.href = "/librarian/index";
            }, 2000); 
        } else {
          showErrorMessage("Incorrect username or password");
        }
      },
      error: function () {
        showErrorMessage("An error occurred during login");
      }
    });
    // console.log(usr + pwd)
  });

  function showErrorMessage(message) {
    // alert(message);   
    Swal.fire({
    icon: 'error',
    title: 'Incorrect username or password',
    footer: '<a href="">Forgot username / password?</a>',
    timer: 3000
    })
    // setTimeout(() => {
          //     location.reload();
          // }, 1500); 
  }

  });