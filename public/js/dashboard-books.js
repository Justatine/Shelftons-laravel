
    //new releases
    $(function(){
      $.ajax({
        type: "get",
        url: "/newReleases",
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
            $(".new-releases").html(html);
  
            $(".card").click(function () { 
              var csrfToken = $('meta[name="csrf-token"]').attr('content');
                  var id = $(this).data('id'); //ISBN
  
                  $.ajax({
                    type: "POST",
                    url: "/getBookDetails",
                    data: { id : id, _token: csrfToken},
                    dataType: "json",
                    success: function(response1) {
                    //   console.log(response1)
                      var html1 = "";
                      var html2 = "";
                      // console.log(response1[0].bookTitle)
                      // console.log(response1[0].bookImg)
  
                    //   for (var i = 0; i < response1.length; i++) {
                        html1 += '<div class="row" >'+
                          '<div class="col-sm-4" >'+  
                            '<img style="width:269px;height:400px;" src="/book-imgs/' + response1[0].bookImg + '">'+
                          '</div>'+
                          '<div class="col-sm-8" style="padding-left:30px;">'+
                            '<strong>ISBN: </strong>'+response1[0].bookISBN+'<br>'+
                            '<strong>Book Description </strong>'+'<br>'+response1[0].bookDesc+'<br>'+
                            '<strong>Author/s: </strong>'+response1[0].author_fullname+'<br>'+
                            '<strong>Category: </strong>'+response1[0].bookCat+'<br>'+
                            '<strong>Publisher: </strong>'+response1[0].publisher+'<br>'+
                            '<strong>Publication Year : </strong>'+response1[0].yearPublished+'<br>'+
                            '<strong>Replacement Cost: </strong>'+response1[0].replacementCost+'<br>'+
                          '</div>'+
                        '</div>';    
                        html2 += '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
                            html2 += '<button class="btn btn-info borrow" data-id="' + response1[0].bookISBN + '">Borrow</button>';
                    //   }
  
                $(".modalcntn").html(html1);
                $(".modal-footer").html(html2);
  
                //borrow
                $('.borrow').click(function() {
                  Swal.fire({
                    icon: 'error',
                    title: 'Shelftons is requiring you to login. ',
                    footer: '<a href="/">Login here.</a>'
                  })
                });
              }
                  });
  
                });          
        }
      });
    });
  
    //popularity
    $(function(){
      $.ajax({
        type: "get",
        url: "/popular",
        dataType: "json",
        success: function (response1) {
          var html1 = "";
            for(var x=0; x<response1.length; x++){
                html1 += '<div class="card" data-id="' + response1[x].ISBN + '" data-toggle="modal" data-target="#exampleModal">' +
                    '<div class="image"><img style="width:120px;height:120px;" src="/book-imgs/' + response1[x].bookImg + '"></div>' +
                    '<span class="title">'+ response1[x].bookTitle +'</span>' +
                    '<span class="price">'+ response1[x].replacementCost +'</span>' +
                    '</div>';
            }
            $(".popularity").html(html1);
  
            $(".card").click(function () { 
                  var id = $(this).data('id');
                  // console.log(id)
  
                  $.ajax({
                    type: "POST",
                    url: "/getBookDetails",
                    data: { id : id },
                    dataType: "json",
                    success: function(response1) {
                      // console.log(response1)
                      var html1 = "";
                      var html2 = "";
                      // console.log('id isbn', id)
                      // console.log(response1[0].bookTitle)
                      // console.log(response1[0].bookImg)
  
                    //   for (var i = 0; i < response1.length; i++) {
                        html1 += '<div class="row" >'+
                          '<div class="col-sm-4" >'+  
                            '<img style="width:269px;height:400px;" src="/book-imgs/' + response1[0].bookImg + '">'+
                          '</div>'+
                          '<div class="col-sm-8" style="padding-left:30px;">'+
                            '<strong>ISBN: </strong>'+response1[0].bookISBN+'<br>'+
                            '<strong>Book Description </strong>'+'<br>'+response1[0].bookDesc+'<br>'+
                            '<strong>Author/s: </strong>'+response1[0].author_fullname+'<br>'+
                            '<strong>Category: </strong>'+response1[0].bookCat+'<br>'+
                            '<strong>Publisher: </strong>'+response1[0].publisher+'<br>'+
                            '<strong>Publication Year : </strong>'+response1[0].yearPublished+'<br>'+
                            '<strong>Replacement Cost: </strong>'+response1[0].replacementCost+'<br>'+
                          '</div>'+
                        '</div>';    
                        html2 += '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
                            html2 += '<button class="btn btn-info borrow" data-id="' + response1[0].ISBN + '">Borrow</button>';
                    //   }
  
                $(".modalcntn").html(html1);
                $(".modal-footer").html(html2);
  
                // POPULARITY borrow
                $('.borrow').click(function() {
                  Swal.fire({
                    icon: 'error',
                    title: 'Shelftons is requiring you to login. ',
                    footer: '<a href="/">Login here.</a>'
                  })
                });
              }
                  });
  
                });
        }
      });
    });