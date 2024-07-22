function filterTable() {
  var input, filter, table, tr, td, i, j;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("displayss");
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

// Table for books
$(function(){
  $.ajax({
    url: "/viewBooks",
    type: 'GET',
    dataType: 'json',
    success: function(result){
      for(var x=0; x<result.length; x++){
        var dataTable = $('#bookstable').DataTable();
        dataTable.clear();
    
        for (var x = 0; x < result.length; x++) {
          var bookDesc = result[x].bookDesc;
          var truncatedDesc = bookDesc;
          if (bookDesc.length > 30) {
            truncatedDesc = bookDesc.substring(0, 30) + '...';
          }
          
          var rowData = [
            '<div class="btn-group">' +
            '<button class="btn btn-success viewBtn" title="View book" data-toggle="modal" data-target="#viewbooksModal" data-id="' + result[x].ISBN + '"><i class="fa fa-eye" style="font-size:24px;"></i></button>' +
            '</div>',
            '<div class="btn-group">' +
            '<button class="btn btn-info editBtn" title="Edit book" data-toggle="modal" data-target="#editbooksModal" data-id="' + result[x].ISBN + '"><i class="fa fa-edit" style="font-size:24px;"></i></button>' +
            '</div>',
            '<div class="btn-group">' +
            '<button class="btn btn-danger deleteBtn" title="Delete book" data-id="' + result[x].ISBN + '"><i class="fa fa-trash-o" style="font-size:24px;"></i></button>' ,
            result[x].ISBN,
            '<img src="/book-imgs/' + result[x].bookImg + '" style="height:100px;width:100px;">',
            result[x].bookTitle,
            '<div class="book-desc">' + truncatedDesc + '</div>',
            result[x].bookCat,
            result[x].publisher, // 7
            result[x].yearPublished,
            result[x].date_added,
            result[x].popularity, //12
            result[x].replacementCost, //13
            result[x].author_fullname, //14
            result[x].stocks, //15
            '</div>'
          ];
        
          dataTable.row.add(rowData);
        }        
        dataTable.draw();
      }
      //view book
      $(document).on('click', '.viewBtn', function () { 
        var id = $(this).data('id'); //isbn
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
          type: "POST",
          url: "/getBookDetails",
          data: { id : id, _token: csrfToken },
          dataType: "json",
          success: function(response1) {
            // console.log(response1)
            html1 = "";
            // console.log('id isbn', id)
            // console.log(response1[0].bookTitle)
            // console.log(response1[0].bookImg)

            for (var i = 0; i < response1.length; i++) {
              html1 += '<div class="row" >'+
                '<div class="col-sm-4" >'+  
                  '<img style="width:269px;height:400px;" src="/book-imgs/' + response1[i].bookImg + '">'+
                '</div>'+
                '<div class="col-sm-8" style="padding-left:30px;">'+
                  '<strong>ISBN: </strong>'+response1[i].bookISBN+'<br>'+
                  '<strong>Book Description </strong>'+'<br>'+response1[i].bookDesc+'<br>'+
                  '<strong>Author/s: </strong>'+response1[i].author_fullname+'<br>'+
                  '<strong>Category: </strong>'+response1[i].bookCat+'<br>'+
                  '<strong>Publisher: </strong>'+response1[i].publisher+'<br>'+
                  '<strong>Publication Year : </strong>'+response1[i].yearPublished+'<br>'+'<strong>Replacement Cost: </strong>'+response1[i].replacementCost+'<br>'
                  +'<strong>In stock: </strong>'+response1[i].stocks+'<br>'+
                '</div>'+
              '</div>';    
            }
          $(".modalcntn").html(html1);
          }
        })
      });

      //add or edit categories
      $.ajax({
        type: "GET",
        url: "/getBookCategories",
        dataType: "json",
        success: function (response12) {
          html3 = "";
          for(var x=0; x<response12.length; x++){
            console.log(response12)
            // html3 += '<a class="dropdown-item bookcategorydrop" data-id="' + response12[x].bookCat + '">'+ response12[x].bookCat+' </a> ';
            html3 += '<option value="'+ response12[x].bookCat +'">'+ response12[x].bookCat+'</option>';
          }
          $("#ebookCat").append(html3);
          $("#bookCatss").append(html3);
        }
      });

      // delete
      $(document).on('click', '.deleteBtn', function () { 
        var id = $(this).data('id');
        console.log(id)
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

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
              $.ajax({
                type: 'POST',
                url: '/deleteBook',
                data: { id: id,_token: csrfToken }, 
                success: function(response35) {
                  if(response35.messageType === "success"){
                    Swal.fire({
                      position: 'center',
                      icon: 'success',
                      title: 'Book deleted successfully!',
                      showConfirmButton: true,
                      timer: 1500
                    })
                    setTimeout(() => {
                      location.reload();
                    }, 1500);              
                  }else{
                    alert(response35)
                  }
                  },
                  error: function(xhr, status, error) {
                    console.log(xhr.responseText); 
                  }
                });          
            }
          })
      });

      // edit
      $(document).on('click', '.editBtn', function () { 
        var id = $(this).data('id'); 
        console.log(id)
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
          type: "POST",
          url: "/getBookDetails",
          data: { id : id, _token: csrfToken },
          dataType: "json",
          success: function(response15) {
            console.log(response15)
            html15 = "";
            // console.log('id isbn', id)
            // console.log(response1[0].bookTitle)
            // console.log(response1[0].bookImg)

            for (var i = 0; i < response15.length; i++) {
              html15 += '<img style="width:269px;height:400px;" src="/book-imgs/' + response15[i].bookImg + '">';
            }
          $("#ebookImg").html(html15);
          }
        })

        var btn = this;
        const row = btn.closest('tr');
          var isbn = row.cells[3].textContent;
          var bookimg = row.cells[4].textContent;
          var title = row.cells[5].textContent;
          var desc = row.cells[6].textContent;
          var cat = row.cells[7].textContent;
          // console.log('cat:'+cat)
          var pub = row.cells[8].textContent;
          var yearpub = row.cells[9].textContent;
          var rc = row.cells[12].textContent;
          var stock = row.cells[14].textContent;
          var authorfn = row.cells[13].textContent;

          // $('#fname').val(id);
          $('#eisbn').val(isbn)
          $('#ebookTitle').val(title)
          $('#ebookDesc').val(desc)
          $('#ebookCat').val(cat)
          $('#epublisher').val(pub)
          $('#eyearPublished').val(yearpub)
          $('#ereplacementCost').val(rc)
          $('#estocks').val(stock)
          $('#eauthor_fullname').val(authorfn)

        $('#edit-form').submit(function(event) {
          event.preventDefault();
          var formData1 = new FormData(this);
          var csrfToken = $('meta[name="csrf-token"]').attr('content');
          formData1.append('_token', csrfToken);

          $.ajax({
            type: 'POST',
            url: '/updateBook',
            data: formData1,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
              if(response.messageType == "success"){
                Swal.fire({
                  position: 'center',
                  icon: 'success',
                  title: 'Book updated successfully',
                  showConfirmButton: true,
                  timer: 1500
                })   
              setTimeout(() => {
                location.reload();
              }, 1500);   
              }else{
                alert(response.message); 
              }
              console.log(response)
              // location.reload();
            },
            error: function(xhr, status, error) {
              console.log(xhr.responseText); 
              // location.reload();
            }
          });          
        });
      });
    }
  });		
  $('#myFormaddbook').submit(function(event) {
    event.preventDefault();
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    var formData = new FormData(this);
    formData.append('_token', csrfToken);

    $.ajax({
      type: 'POST',
      url: '/addBook',
      data: formData,
      contentType: false,
      processData: false,
      success: function(response) {
        if(response.messageType == "success"){
          Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Book added successfully',
            showConfirmButton: true,
            timer: 1500
          })
          setTimeout(() => {
              location.reload();
            }, 1500);               
        }else{
          alert(response)
        }
      },
      error: function(xhr, status, error) {
        console.log(xhr.responseText); 
      }
    });
  });
});