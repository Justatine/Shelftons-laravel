$(function() {
    $.ajax({
        type: "get",
        url: "/getUsers", // Update this to match your Laravel API route
        dataType: "json",
        success: function(response) {
            // console.log(response);
            var count = response.count;
            var row = '<p style="font-size: 100px;"><strong>' + count + '</strong></p>';
            $("#numberofusers").html(row);
        }
    });    

    $.ajax({
        type: "get",
        url: "/getBooks", // Update this to match your Laravel API route
        dataType: "json",
        success: function(response) {
            // console.log(response);
            var count = response.count;
            var row1 = '<p style="font-size: 100px;"><strong>' + count + '</strong></p>';
            $("#numberofbooks").html(row1);
        }
    });

    $.ajax({
        type: "get",
        url: "/getTransactions", // Update this to match your Laravel API route
        dataType: "json",
        success: function(response) {
            // console.log(response);
            var count = response.count;
            var row2 = '<p style="font-size: 100px;"><strong>' + count + '</strong></p>';
            $("#numberofborrows").html(row2);
        }
    });

    $(document).ready(function() {
        setInterval(runningTime, 1000);
        });
        function runningTime() {
          $.ajax({
          url: '/runTime',
          success: function(data) {
            $('#runningTime').html(data);
          },
          });
      }

        var currentDate = new Date();
        var formattedDate = currentDate.toLocaleString('en-PH', {year: 'numeric', month: 'long', day: 'numeric' }); 
        var formattedDay = currentDate.toLocaleString('en-PH', {weekday: 'long',});
        document.getElementById('currentDate').textContent = formattedDate;
        document.getElementById('day').textContent = formattedDay;

});
