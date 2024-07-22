    //add
    $(function(){
        $('#myForm').submit(function(event) {
            event.preventDefault();
            // var formData = $(this).serialize(); 
            var formData = new FormData(this);
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            formData.append('_token', csrfToken);

            $.ajax({
              type: 'POST',
              url: '/register',
              data: formData,
              dataType: 'json', 
              contentType: false,
              processData: false,
      
              success: function(response) {
                if(response.messageType === "success"){
                      Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Registered successfully',
                        showConfirmButton: false,
                        timer: 1500
                      })   
                    setTimeout(() => {
                      location.reload();
                    }, 1500);   
                    }else if(response.messageType == "alreadyexist"){
                      Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Username or password already exist1',
                        showConfirmButton: true
                      })  
                    }
                    // else{
                    //   alert(response.message); 
                    // }
              },
              error: function(xhr, status, error) {
                console.log(xhr.responseText); 
              }
            });
          });
    });