function filterTable() {
  var input, filter, table, tr, td, i, j;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("display");
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
//lost tbale
$(function () {
  $.ajax({
    url: "/getLostBooksFromArchive",
    type: "GET",
    dataType: "json",
    success: function (result) {
      console.log("yeah")
      var row = "";
      for (var x = 0; x < result.length; x++) {
        row =
          row +
          "<tr><td hidden>" +
          result[x].archiveID +
          "</td><td>" +
          result[x].borrowID +
          "</td><td>" +
          result[x].userID +
          "</td><td>" +
          result[x].ISBN +
          "</td><td>" +
          result[x].borrowDate +
          "</td><td hidden>" +
          result[x].returnDate +
          "</td><td>" +
          result[x].bookStatus +
          "</td><td>" +
          result[x].status_when_lost +
          "</td><td>" +
          result[x].fine +
          "</td><td>";
        if (result[x].status_when_lost === "Paid") {
          row =
            row +
            '<button class="btn btn-success" disabled data-id="' +
            result[x].archiveID +
            '">Done</button>';
        } else {
          row =
            row +
            '<button class="btn btn-warning paid" data-id="' +
            result[x].archiveID +
            '">Paid</button>';
        }
        +"</td></tr>";
      }
      $("#lostBooks").append(row);

// paid
$(".paid").click(function () {
  var id = $(this).data("id");

  console.log(id);
  var btn = this;
  const row = btn.closest("tr");
  var archiveid = row.cells[0].textContent;

  console.log(archiveid);

  // Get the CSRF token from the meta tag
  var csrfToken = $('meta[name="csrf-token"]').attr('content');

  $.ajax({
      type: "POST",
      url: "/updateStatusWhenLost",
      data: {
          archive_id_paid: archiveid,
          _token: csrfToken, // Include the CSRF token in the data
      },
      dataType: "json",
      success: function (response) {
          if (response.messageType == "success") {
              // alert(response.message);
              Swal.fire({
                  position: "center",
                  icon: "success",
                  title: response.message,
                  showConfirmButton: false,
                  timer: 1500,
              });
              setTimeout(() => {
                  location.reload();
              }, 2000);
          } else {
              // alert(response.message);
          }
          console.log(response);
          setTimeout(() => {
              location.reload();
          }, 2000);
      },
      error: function (xhr, status, error) {
          console.log("failed");
          setTimeout(() => {
              location.reload();
          }, 2000);
      },
  });
});
    },
  });
});

//archive tbale
$(function () {
  $.ajax({
    url: "/getReturnedBooks",
    type: "GET",
    dataType: "json",
    success: function (result) {
      console.log(result.data);
      var row = "";
      
      // Check if result.data is an array
      if (Array.isArray(result.data)) {
        // Iterate over each item in the array
        $.each(result.data, function (index, item) {
          row +=
            "<tr><td>" +
            item.borrowID +
            "</td><td>" +
            item.userID +
            "</td><td>" +
            item.ISBN +
            "</td><td>" +
            item.borrowDate +
            "</td><td>" +
            item.returnDate +
            "</td><td>" +
            item.bookStatus +
            "</td></tr>";
        });
      } else {
        // Handle the case where result.data is not an array
        console.error("Invalid data format");
      }
  
      $("#returnedBooks").append(row);
    },
    error: function (xhr, status, error) {
      console.error("Error fetching data:", error);
    }
  });
  
});

//admin side
$(function () {
  $.ajax({
    url: "/archive",
    type: "GET",
    dataType: "json",
    success: function (result) {
      for (var x = 0; x < result.length; x++) {
        var dataTable = $("#borrowertable").DataTable();
        dataTable.clear();
      
        for (var x = 0; x < result.length; x++) {
          var disableLostButton =
            result[x].returnDate !== null && result[x].returnStatus === "Returned"
              ? "disabled"
              : "";
      
          var rowData = [
            result[x].borrowID, //0
            result[x].userID, //1
            result[x].borrowISBN, //2
            result[x].borrowDate, //3
            result[x].returnSchedule, //4
            result[x].returnDate, //5
            result[x].borrowStatus, //6
            result[x].returnStatus, //7
            result[x].fine, //8
            '<div class="btn-group">' +
              '<button class="btn btn-info update" data-toggle="modal" data-target="#exampleModal" data-id="' +
              result[x].borrowID +
              '"><i class="fa fa-edit" style="font-size: 24px;"></i></button>' +
              "</div>",
            '<div class="btn-group">' +
              '<button class="btn btn-danger delete" data-id="' +
              result[x].borrowID +
              '"' +
              (result[x].borrowStatus !== "Cancelled" ? " disabled" : "") +
              '><i class="fa fa-trash-o" style="font-size: 24px;"></i></button>' +
              "</div>",
            '<div class="btn-group">' +
              '<button class="btn btn-success archive" data-id="' +
              result[x].borrowID +
              '"' +
              (result[x].returnStatus !== "Returned"
                ? " disabled"
                : "" && result[x].borrowStatus !== "Approved"
                ? " disabled"
                : "") +
              '><i class="fa fa-archive" style="font-size: 24px;"></i></button>' +
              "</div>",
            '<div class="btn-group">' +
              '<button class="btn btn-warning lostbookrec" data-id="' +
              result[x].borrowID +
              '"' +
              (result[x].borrowStatus !== "Approved" ? " disabled" : "") +
              ' ' +
              disableLostButton +  // Add the disabled attribute conditionally
              '><i class="fa fa-edit" style="font-size: 24px;"></i></button>' +
              "</div>",
          ];
      
          dataTable.row.add(rowData);
        }
        dataTable.draw();
      }      

      //delete
      $(document).on("click", ".delete", function () {
        var id = $(this).data("id");
        console.log('delete '+id);
        Swal.fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, delete it!",
        }).then((result) => {
          if (result.isConfirmed) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
              type: "POST",
              url: "/deleteBorrow",
              data: { id: id, _token: csrfToken },
              success: function (response) {
                if (response.messageType === "success") {
                  Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Record deleted successfully",
                    showConfirmButton: true,
                    timer: 1500,
                  });
                  setTimeout(() => {
                    location.reload();
                  }, 1500);
                } else {
                  alert(response);
                }
              },
              error: function (xhr, status, error) {
                console.log(xhr.responseText);
              },
            });
          } else {
            // Swal.fire("Changes are not saved", "", "info");
          }
        });
      });

      // return archive
      $(document).on("click", ".archive", function () {
        var id = $(this).data("id");

        var btn = this;
        const row = btn.closest("tr");
        var bid = row.cells[0].textContent;
        var uid = row.cells[1].textContent;
        var isbn = row.cells[2].textContent;
        var borrdate = row.cells[3].textContent;
        var retdate = row.cells[5].textContent;
        var retstat = row.cells[7].textContent;
        var fine = row.cells[8].textContent;

        Swal.fire({
          title: "Are you to archive this record?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, archive it!",
        }).then((result) => {
          if (result.isConfirmed) {
            // Get CSRF token from meta tag
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
              type: "POST",
              url: "/sendToArchive",
              data: {
                borrowID: bid,
                isbn: isbn,
                userid: uid,
                archive__borrowDate: borrdate,
                archive_returnDate: retdate,
                archive_returnStatus: retstat,
                archive_fine: fine,
                _token: csrfToken,  // Include CSRF token in the data
              },
              dataType: "json",
              success: function (response) {
                if (response.messageType == "success") {
                  Swal.fire({
                    position: "center",
                    icon: "success",
                    title: response.message,
                    showConfirmButton: true,
                    timer: 1500,
                  });
                  setTimeout(() => {
                    location.reload();
                  }, 2000);
                } else {
                  console.log(response.message);
                }
              },
              error: function (xhr, status, error) {
                console.log("Failed to send to archive.");
              },
            });
          }
        });
      });

      // lost
      $(document).on("click", ".lostbookrec", function () {
        var id = $(this).data("id");
        console.log(id);
        var btn = this;
        const row = btn.closest("tr");
        var bid = row.cells[0].textContent;
        var uid = row.cells[1].textContent;
        var isbn = row.cells[2].textContent;
        var borrdate = row.cells[3].textContent;
        var retdate = row.cells[5].textContent;
        var retstat = row.cells[7].textContent;
        var lostFine = row.cells[8].textContent;

        // console.log(bid, isbn, uid, borrdate, retdate, retstat, lostFine)

        Swal.fire({
          title: "Are you to mark this record lost?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, continue.",
        }).then((result) => {
          if (result.isConfirmed) {
            // Get the CSRF token from the meta tag
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            // console.log(bid+' -  '+isbn+' -  '+uid+' - '+borrdate+' - '+'0000-00-00 00:00:00'+' - '+retstat+' - '+lostFine)
            $.ajax({
              type: "POST",
              url: "/archiveLost",
              data: {
                lost_archive_borrowID: bid,
                lost_archive_isbn: isbn,
                lost_archive_userid: uid,
                lost_archive__borrowDate: borrdate,
                lost_archive__returnDate: borrdate,
                lost_archive_returnStatus: retstat,
                lost_archive_fine: lostFine,
                _token: csrfToken, // Include CSRF token in the data
              },
              dataType: "json",
              success: function (response) {
                if (response.messageType === "success") {
                  console.log(response.message)
                  Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Record added to lost",
                    showConfirmButton: true,
                    timer: 1500,
                  });
                  setTimeout(() => {
                    location.reload();
                  }, 2000);
                } else {
                  // alert(response.message);
                }
                // setTimeout(() => {
                //   location.reload();
                // }, 2000);
              },
              error: function (xhr, status, error) {
                console.log("failed");
                // setTimeout(() => {
                //   location.reload();
                // }, 2000);
              },
            });
          } else {
            // Swal.fire("Changes are not saved", "", "info");
          }
        });
      });

      // edit
      $(document).on("click", ".update", function () {
        var id = $(this).data("id");
        console.log(id);
        var btn = this;
        const row = btn.closest("tr");
        var bid = row.cells[0].textContent;
        var uid = row.cells[1].textContent;
        var isbn = row.cells[2].textContent;
        console.log(isbn)
        var borrdate = row.cells[3].textContent;
        var retsched = row.cells[4].textContent;
        var retdate = row.cells[5].textContent;
        var borrstat = row.cells[6].textContent;
        var retstat = row.cells[7].textContent;
        var fine = row.cells[8].textContent;
      
        $("#mborrowID").val(bid);
        $("#muserID").val(uid);
        $("#mISBN").val(isbn);
        $("#mborrowDate").val(borrdate);
        $("#mreturnSchedule").val(retsched);
        $("#mreturnDate").val(retdate);
        $("#mborrowStatus").val(borrstat);
        $("#mreturnStatus").val(retstat);
        $("#mfine").val(fine);
      
        // Get CSRF token from meta tag
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
      
        $("#edit-form").submit(function (event) {
          event.preventDefault();
          
          // Include CSRF token in the data
          var formData = {
            borrowID: bid,
            bookid: $("#mISBN").val(),
            returnSchedule: $("#mreturnSchedule").val(),
            returnDate: $("#mreturnDate").val(),
            borrowStatus: $("#mborrowStatus").val(),
            returnStatus: $("#mreturnStatus").val(),
            fine: $("#mfine").val(),
            _token: csrfToken  // Include CSRF token in the data
          };
      
          $.ajax({
            type: "POST",
            url: "/updateBorrow",
            data: formData,
            dataType: "json",
            success: function (response) {
              if (response.messageType == "success") {
                Swal.fire({
                  position: "center",
                  icon: "success",
                  title: "Borrow updated successfully",
                  showConfirmButton: true,
                  timer: 1500,
                });
                setTimeout(() => {
                  location.reload();
                }, 2000);
              } else {
                console.log(response.message);
              }
            },
            error: function (xhr, status, error) {
              console.log("Failed to update borrow.");
            },
          });
        });
      });
      
    },
  });
});