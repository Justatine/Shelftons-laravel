$(function () {
  $.ajax({
    url: "/schedules",
    type: "GET",
    dataType: "json",
    success: function (result) {
      for (var x = 0; x < result.length; x++) {
        var dataTable = $("#schedules").DataTable();
        dataTable.clear();

        for (var x = 0; x < result.length; x++) {
        var borrowedStatus = (result[x].borrowStatus != 'Pending') ? '<p>Currently borrowed</p>' : '<p>Pending</p>';
        var returnstatus = (result[x].borrowStatus != 'Returned') && result[x].borrowStatus != 'Pending' ? '<p style="color:red;">Not available</p>' : '<p style="color:green;">Available</p>';
        
        var date = new Date(result[x].returnSchedule);
        var options = { 
          year: 'numeric', 
          month: 'long', 
          day: 'numeric' 
        };
        
        var formattedDate = date.toLocaleDateString('en-US', options);
        console.log(formattedDate);

          var rowData = [
            '<img src="/book-imgs/' +result[x].bookImg +'" style="height:100px;width:100px;">',
            result[x].bookTitle,
            result[x].author_fullname,
            result[x].firstname +' '+ result[x].middlename +' '+ result[x].lastname,
            borrowedStatus,
            formattedDate,
            returnstatus,
          ];
          dataTable.row.add(rowData);
        }
        dataTable.draw();
      }
    },
  });
});
