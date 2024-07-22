// //categories
$(function(){
  var userid = Cookies.get('userid')
  var lost = false;
  var limit = false;
  var borrowed = false;
  var overdue = false;
  
  checklimit(userid)
  checkLost(userid)
  CheckDues(userid)

  function checkLost(userid) {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
      type: "GET",
      url: "/checkBorrowStatus",
      data: {user_id: userid, _token: csrfToken},
      dataType: "json",
      success: function (response30) {
        // console.log(response30)
        if (response30.hasOwnProperty('lost')) {
          lost = true;
        } else {
          lost = false;
        }
      }
    });
  }

  function checklimit(userid) {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
      type: "GET",
      url: "/checkBorrowLimit",
      data: {user_id: userid, _token: csrfToken },
      dataType: "json",
      success: function (response32) {
        // console.log(response32)
        if (response32.hasOwnProperty('limit')) {
          limit = true;
        } else {
          limit = false;
        }
      }
    });
  }

  function borrowcontrol(userid, isbn) {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
      type: "POST",
      url: "/borrowControl",
      data: {userid: userid, isbn:isbn, _token: csrfToken},
      dataType: "json",
      success: function (response32) {
        // console.log(response32)
        if (response32.hasOwnProperty('borrowed')) {
          borrowed = true;
        } else {
          borrowed = false;
        }         
      }
    });
  }

  function CheckDues(userid) {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
      type: "POST",
      url: "/checkDueStatus",
      data: {userid: userid, _token: csrfToken},
      dataType: "json",
      success: function (response35) {
        // console.log(response35)
        if (response35.hasOwnProperty('overdue')) {
          overdue = true;
        } else {
          overdue = false;
        }
      }
    });
  }
$.ajax({
    type: "GET",
    url: "/getBookCategories",
    dataType: "json",
    success: function (response12) {
      console.log('im laravel')
    html3 = "";
    for(var x=0; x<response12.length; x++){
        html3 += '<a class="dropdown-item bookcategorydrop" data-id="' + response12[x].bookCat + '">'+ response12[x].bookCat+' </a> ';
    }
    $(".dropdown-menu").append(html3);

    //categories
    $('.bookcategorydrop').click(function () { 
        var bookcategory = $(this).data('id');
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
        type: "GET",
        url: "/viewBooks",
        data: { bookcategory : bookcategory, _token: csrfToken},
        dataType: "json",
        success: function (response13) {
            var html = "";
            for(var x=0; x<response13.length; x++){
            if(response13[x].bookCat === bookcategory){
                html += '<div class="card" data-id="' + response13[x].ISBN + '" data-toggle="modal" data-target="#exampleModal">' +
                    '<div class="image"><img style="width:120px;height:120px;" src="/book-imgs/' + response13[x].bookImg + '"></div>' +
                    '<span class="title">'+ response13[x].bookTitle +'</span>' +
                    '<span class="price">'+ response13[x].replacementCost +'</span>' +
                    '</div>';
            }
            }
            $(".cardcont").html(html);
            $(".card").click(function () { 
                var id = $(this).data('id'); //ISBN

                borrowcontrol(userid,id)
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                // console.log(userid)
                $.ajax({
                  type: "POST",
                  url: "/getBookDetails",
                  data: { id : id, _token: csrfToken},
                  dataType: "json",
                  success: function(response1) {
                    // console.log(response1)
                    // console.log(response1)
                    var html1 = "";
                    var html2 = "";
                    // console.log(response1[0].bookTitle)
                    // console.log(response1[0].bookImg)

                    // for (var i = 0; i < response1.length; i++) {
                      html1 += '<div class="row">' +
                        '<div class="col-sm-4">' +
                        '<img style="width:269px;height:400px;" src="/book-imgs/' + response1[0].bookImg + '">' +
                        '</div>' +
                        '<div class="col-sm-8" style="padding-left:30px;">' +
                        '<strong>ISBN: </strong>' + response1[0].bookISBN + '<br>' +
                        '<strong>Book Description </strong>' + '<br>' + response1[0].bookDesc + '<br>' +
                        '<strong>Author/s: </strong>' + response1[0].author_fullname + '<br>' +
                        '<strong>Category: </strong>' + response1[0].bookCat + '<br>' +
                        '<strong>Publisher: </strong>' + response1[0].publisher + '<br>' +
                        '<strong>Publication Year : </strong>' + response1[0].yearPublished + '<br>' +
                        '<strong>Replacement Cost: </strong>' + response1[0].replacementCost + '<br>';
                    
                      if (response1[0].stocks > 0) {
                        html1 += '<strong>In stock: </strong>' + response1[0].stocks +'<span style="color:green;"> &nbsp; Available</span>';
                      } else {
                        html1 += '<strong>In stock: </strong>' + response1[0].stocks + '<span style="color:red;">&nbsp; Out of stock</span>';
                      }
                    
                      html1 += '</div>' +
                        '</div>';
                    
                      html2 += '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
                    
                      if (lost) {
                          html2 += '<button class="btn btn-warning" disabled>Pay the fine first.</button>';
                        } else if (limit) {
                          html2 += '<button class="btn btn-warning" disabled>You have reached the maximum borrowing limit for books from the library.</button>';
                        } else if (response1[0].stocks === 0) {
                          html2 += '<button class="btn btn-danger" disabled>Book is out of stock.</button>';
                        }else {
                          if(borrowed){
                            html2 += '<button class="btn btn-warning borrow" data-id="' + response1[0].bookISBN + '" disabled>Currently Borrowed</button>';
                          }else if(overdue === true){
                            html2 += '<button class="btn btn-danger" disabled>Cannot borrow when having an overdue record.</button>';
                          }else{
                            html2 += '<button class="btn btn-info borrow" data-id="' + response1[0].bookISBN + '">Borrow</button>';
                          }
                      }

            $(".modalcntn").html(html1);
            $(".modal-footer").html(html2);

              //borrow
              $('.borrow').click(function() {
                var userid = Cookies.get('userid')
                var id = $(this).data('id');
                // console.log('what id '+id)

                Swal.fire({
                  title: 'Are you sure to borrow?',
                  text: "This borrowing will be recorded to your account!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, proceed'
                }).then((result) => {
                  if (result.isConfirmed) {
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                      type: 'POST',
                      url: '/borrowBook',
                      data: { id: id, userid:userid, _token: csrfToken }, 
                      success: function(response) {
                        // button.prop('disabled', true);
                        if(response.messageType == "success"){              
                          Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Borrowed successfully!',
                            text: 'You can claim the book once the request is approved.',
                            showConfirmButton: true,
                            timer: 3000
                          })
                          setTimeout(() => {
                            location.reload();
                          }, 3000);              
                        }else{
                          alert(response)
                        }
                      },
                      error: function(xhr, status, error) {
                        console.log('failed'); 
                      }
                    });
                  }
                })
              });        
            }
            });

            });
        }
        });
    });

//     //all books
    $('.viewall').click(function () { 
      var userid = Cookies.get('userid')
      var lost = false;
      var limit = false;
      var borrowed = false;
      var overdue = false;
      
      checklimit(userid)
      checkLost(userid)
      CheckDues(userid)
  
      function checkLost(userid) {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
          type: "GET",
          url: "/checkBorrowStatus",
          data: {user_id: userid, _token: csrfToken},
          dataType: "json",
          success: function (response30) {
            // console.log(response30)
            if (response30.hasOwnProperty('lost')) {
              lost = true;
            } else {
              lost = false;
            }
          }
        });
      }
  
      function checklimit(userid) {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
          type: "GET",
          url: "/checkBorrowLimit",
          data: {user_id: userid, _token: csrfToken},
          dataType: "json",
          success: function (response32) {
            // console.log(response32)
            if (response32.hasOwnProperty('limit')) {
              limit = true;
            } else {
              limit = false;
            }
          }
        });
      }
  
      function borrowcontrol(userid, isbn) {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
          type: "POST",
          url: "/borrowControl",
          data: {userid: userid, isbn:isbn, _token: csrfToken},
          dataType: "json",
          success: function (response32) {
            // console.log(response32)
            if (response32.hasOwnProperty('borrowed')) {
              borrowed = true;
            } else {
              borrowed = false;
            }         
          }
        });
      }
  
      function CheckDues(userid) {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
          type: "POST",
          url: "/checkDueStatus",
          data: {userid: userid, _token: csrfToken},
          dataType: "json",
          success: function (response35) {
            // console.log(response35)
            if (response35.hasOwnProperty('overdue')) {
              overdue = true;
            } else {
              overdue = false;
            }
          }
        });
      }
    var viewall = 'view-all';
    // console.log(viewall)
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type: "GET",
        url: "/viewBooks",
        data: {viewall : viewall, _token: csrfToken},
        dataType: "json",
        success: function (response) {
            var html = "";
            for(var x=0; x<response.length; x++){
                html += '<div class="card" data-id="' + response[x].ISBN + '" data-toggle="modal" data-target="#exampleModal">' +
                    '<div class="image"><img style="width:120px;height:120px;" src="/book-imgs/' + response[x].bookImg + '"></div>' +
                    '<span class="title">'+ response[x].bookTitle +'</span>' +
                    '<span class="price">'+ response[x].replacementCost +'</span>' +
                    '</div>';
            }
            $(".cardcont").html(html);

            $(".card").click(function () { 
                var id = $(this).data('id'); //ISBN

                borrowcontrol(userid,id)
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                // console.log(userid)
                $.ajax({
                  type: "POST",
                  url: "/getBookDetails",
                  data: { id : id, _token: csrfToken},
                  dataType: "json",
                  success: function(response1) {
                    // console.log(response1)
                    // console.log(response1)
                    var html1 = "";
                    var html2 = "";
                    // console.log(response1[0].bookTitle)
                    // console.log(response1[0].bookImg)

                    // for (var i = 0; i < response1.length; i++) {
                      html1 += '<div class="row">' +
                        '<div class="col-sm-4">' +
                        '<img style="width:269px;height:400px;" src="/book-imgs/' + response1[0].bookImg + '">' +
                        '</div>' +
                        '<div class="col-sm-8" style="padding-left:30px;">' +
                        '<strong>ISBN: </strong>' + response1[0].bookISBN + '<br>' +
                        '<strong>Book Description </strong>' + '<br>' + response1[0].bookDesc + '<br>' +
                        '<strong>Author/s: </strong>' + response1[0].author_fullname + '<br>' +
                        '<strong>Category: </strong>' + response1[0].bookCat + '<br>' +
                        '<strong>Publisher: </strong>' + response1[0].publisher + '<br>' +
                        '<strong>Publication Year : </strong>' + response1[0].yearPublished + '<br>' +
                        '<strong>Replacement Cost: </strong>' + response1[0].replacementCost + '<br>';
                    
                      if (response1[0].stocks > 0) {
                        html1 += '<strong>In stock: </strong>' + response1[0].stocks +'<span style="color:green;"> &nbsp; Available</span>';
                      } else {
                        html1 += '<strong>In stock: </strong>' + response1[0].stocks + '<span style="color:red;">&nbsp; Out of stock</span>';
                      }
                    
                      html1 += '</div>' +
                        '</div>';
                    
                      html2 += '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
                    
                      if (lost) {
                        html2 += '<button class="btn btn-warning" disabled>Pay the fine first.</button>';
                      } else if (limit) {
                        html2 += '<button class="btn btn-warning" disabled>You have reached the maximum borrowing limit for books from the library.</button>';
                      } else if (response1[0].stocks === 0) {
                        html2 += '<button class="btn btn-danger" disabled>Book is out of stock.</button>';
                      }else {
                        if(borrowed){
                          html2 += '<button class="btn btn-warning borrow" data-id="' + response1[0].bookISBN + '" disabled>Currently Borrowed</button>';
                        }else if(overdue === true){
                          html2 += '<button class="btn btn-danger" disabled>Cannot borrow when having an overdue record.</button>';
                        }else{
                          html2 += '<button class="btn btn-info borrow" data-id="' + response1[0].bookISBN + '">Borrow</button>';
                        }
                      }

                $(".modalcntn").html(html1);
                $(".modal-footer").html(html2);

              //borrow
              $('.borrow').click(function() {
                var userid = Cookies.get('userid')
                var id = $(this).data('id');
                // console.log('what id '+id)

                Swal.fire({
                  title: 'Are you sure to borrow?',
                  text: "This borrowing will be recorded to your account!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, proceed'
                }).then((result) => {
                  if (result.isConfirmed) {
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                      type: 'POST',
                      url: '/borrowBook',
                      data: { id: id, userid:userid, _token: csrfToken }, 
                      success: function(response) {
                        // button.prop('disabled', true);
                        if(response.messageType == "success"){              
                          Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Borrowed successfully!',
                            text: 'You can claim the book once the request is approved.',
                            showConfirmButton: true,
                            timer: 3000
                          })
                          setTimeout(() => {
                            location.reload();
                          }, 3000);              
                        }else{
                          alert(response)
                        }
                      },
                      error: function(xhr, status, error) {
                        console.log('failed'); 
                      }
                    });
                  }
                })
              });
            }
                });

                });
        }
    });    
    });

    }
});
});

//all books
$(function(){
  var userid = Cookies.get('userid')
  var lost = false;
  var limit = false;
  var borrowed = false;
  var overdue = false;
  
  checklimit(userid)
  checkLost(userid)
  CheckDues(userid)

  function checkLost(userid) {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
      type: "GET",
      url: "/checkBorrowStatus",
      data: {user_id: userid, _token: csrfToken },
      dataType: "json",
      success: function (response30) {
        // console.log(response30)
        if (response30.hasOwnProperty('lost')) {
          lost = true;
        } else {
          lost = false;
        }
      }
    });
  }

  function checklimit(userid) {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
      type: "GET",
      url: "/checkBorrowLimit",
      data: {user_id: userid, _token: csrfToken },
      dataType: "json",
      success: function (response32) {
        // console.log(response32)
        if (response32.hasOwnProperty('limit')) {
          limit = true;
        } else {
          limit = false;
        }
      }
    });
  }

  function borrowcontrol(userid, isbn) {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
      type: "POST",
      url: "/borrowControl",
      data: {userid: userid, isbn:isbn, _token: csrfToken},
      dataType: "json",
      success: function (response32) {
        // console.log(response32)
        if (response32.hasOwnProperty('borrowed')) {
          borrowed = true;
        } else {
          borrowed = false;
        }         
      }
    });
  }

  function CheckDues(userid) {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
      type: "POST",
      url: "/checkDueStatus",
      data: {userid: userid, _token: csrfToken },
      dataType: "json",
      success: function (response35) {
        // console.log(response35)
        if (response35.hasOwnProperty('overdue')) {
          overdue = true;
        } else {
          overdue = false;
        }
      }
    });
  }
  
      $.ajax({
          type: "GET",
          url: "/viewBooks",
          dataType: "json",
          success: function (response16) {
              var html = "";
              for(var x=0; x<response16.length; x++){
                  html += '<div class="card" data-id="' + response16[x].ISBN + '" data-toggle="modal" data-target="#exampleModal">' +
                      '<div class="image"><img style="width:120px;height:120px;" src="/book-imgs/' + response16[x].bookImg + '"></div>' +
                      '<span class="title">'+ response16[x].bookTitle +'</span>' +
                      '<span class="price">'+ response16[x].replacementCost +'</span>' +
                      '</div>';
              }
              $(".cardcont").append(html);

              $(".card").click(function () { 
                var id = $(this).data('id'); //ISBN

                borrowcontrol(userid,id)
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                // console.log(userid)
                $.ajax({
                  type: "POST",
                  url: "/getBookDetails",
                  data: { id : id, _token: csrfToken},
                  dataType: "json",
                  success: function(response1) {
                    // console.log(response1)
                    // console.log(response1)
                    var html1 = "";
                    var html2 = "";
                    // console.log(response1[0].bookTitle)
                    // console.log(response1[0].bookImg)

                    // for (var i = 0; i < response1.length; i++) {
                      html1 += '<div class="row">' +
                        '<div class="col-sm-4">' +
                        '<img style="width:269px;height:400px;" src="/book-imgs/' + response1[0].bookImg + '">' +
                        '</div>' +
                        '<div class="col-sm-8" style="padding-left:30px;">' +
                        '<strong>ISBN: </strong>' + response1[0].bookISBN + '<br>' +
                        '<strong>Book Description </strong>' + '<br>' + response1[0].bookDesc + '<br>' +
                        '<strong>Author/s: </strong>' + response1[0].author_fullname + '<br>' +
                        '<strong>Category: </strong>' + response1[0].bookCat + '<br>' +
                        '<strong>Publisher: </strong>' + response1[0].publisher + '<br>' +
                        '<strong>Publication Year : </strong>' + response1[0].yearPublished + '<br>' +
                        '<strong>Replacement Cost: </strong>' + response1[0].replacementCost + '<br>';
                    
                      if (response1[0].stocks > 0) {
                        html1 += '<strong>In stock: </strong>' + response1[0].stocks +'<span style="color:green;"> &nbsp; Available</span>';
                      } else {
                        html1 += '<strong>In stock: </strong>' + response1[0].stocks + '<span style="color:red;">&nbsp; Out of stock</span>';
                      }
                    
                      html1 += '</div>' +
                        '</div>';
                    
                      html2 += '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
                    

                      if (lost) {
                        html2 += '<button class="btn btn-warning" disabled>Pay the fine first.</button>';
                      } else if (limit) {
                        html2 += '<button class="btn btn-warning" disabled>You have reached the maximum borrowing limit for books from the library.</button>';
                      } else if (response1[0].stocks === 0) {
                        html2 += '<button class="btn btn-danger" disabled>Book is out of stock.</button>';
                      }else {
                        if(borrowed){
                          html2 += '<button class="btn btn-warning borrow" data-id="' + response1[0].bookISBN + '" disabled>Currently Borrowed</button>';
                        }else if(overdue === true){
                          html2 += '<button class="btn btn-danger" disabled>Cannot borrow when having an overdue record.</button>';
                        }else{
                          html2 += '<button class="btn btn-info borrow" data-id="' + response1[0].bookISBN + '">Borrow</button>';
                        }
                      }

                $(".modalcntn").html(html1);
                $(".modal-footer").html(html2);

              //borrow
              $('.borrow').click(function() {
                var userid = Cookies.get('userid')
                var id = $(this).data('id');
                // console.log('what id '+id)

                Swal.fire({
                  title: 'Are you sure to borrow?',
                  text: "This borrowing will be recorded to your account!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, proceed'
                }).then((result) => {
                  if (result.isConfirmed) {
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                      type: 'POST',
                      url: '/borrowBook',
                      data: { id: id, userid:userid, _token: csrfToken }, 
                      success: function(response) {
                        // button.prop('disabled', true);
                        if(response.messageType == "success"){              
                          Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Borrowed successfully!',
                            text: 'You can claim the book once the request is approved.',
                            showConfirmButton: true,
                            timer: 3000
                          })
                          setTimeout(() => {
                            location.reload();
                          }, 3000);              
                        }else{
                          alert(response)
                        }
                      },
                      error: function(xhr, status, error) {
                        console.log('failed'); 
                      }
                    });
                  }
                })
              });                
              }
                  });

                });
          }
      });    
  });