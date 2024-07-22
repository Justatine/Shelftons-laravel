function filterTable() {
    var input, filter, table, tr, td, i, j;
    input = document.getElementById("searchbook");
    filter = input.value.toUpperCase();
    table = document.getElementById("searchbooktable");
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
  
  $(function(){
    $.ajax({
        type: "GET",
        url: "/viewBooks",
        dataType: "json",
        success: function (result) {
            var row="";
            for(var x=0; x<result.length; x++){
                row = row + "<tr><td>" 
                + result[x].ISBN
                + '</td><td><img style="width:120px;height:120px;" src="/book-imgs/' + result[x].bookImg + '"></td><td>'
                + result[x].bookTitle
                + "</td><td hidden>" 
                + result[x].bookDesc 
                + "</td><td >" 
                + result[x].bookCat  
                + "</td><td >" 
                + result[x].publisher 
                + "</td><td hidden>" 
                + result[x].yearPublished 
                + "</td><td hidden>" 
                + result[x].replacementCost 
                + "</td><td >" 
                + result[x].author_fullname
                + "</td><td>"
                + '<button class="btn btn-success viewBtn" title="View book" data-toggle="modal" data-target="#viewbooksModal" data-id="' + result[x].ISBN + '"><i class="fa fa-eye" style="font-size:24px;"></i></button>'
                 + "</td></tr>";
            }                  
            $("tbody").append(row);
    
            $('.viewBtn').click(function () { 
            var id = $(this).data('id');
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
              type: "POST",
              url: "/getBookDetails",
              data: { id : id, _token: csrfToken },
              dataType: "json",
              success: function(response1) {
                // console.log(response1)
                var html1 = "";
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
                      '<strong>Publication Year : </strong>'+response1[i].yearPublished+'<br>'+
                      '<strong>Replacement Cost: </strong>'+response1[i].replacementCost+'<br>'+
                    '</div>'+
                  '</div>';    
                }
              $(".modalcntn").html(html1);
              }
            })
          });
    
        }
    });
    })