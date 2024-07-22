$(document).ready(function () {
    if (Cookies.get('usertype') == null) {
        Swal.fire({
            icon: 'error',
            title: 'Please login first.',
            footer: '<a href="../../login/">Login here.</a>',
            timer: 2000
          })
          setTimeout(() => {
            // location.replace('../../login/');
            window.location.href = "/login";
          }, 2000);    
        // window.location.replace('../login/index.html');

    }else if(Cookies.get('usertype') != "Librarian"){
        if(Cookies.get('usertype') === "Patron"){
            window.location.href = "/user/index";

        }else if(Cookies.get('usertype') === "Admin"){
            window.location.href = "/admin/index";
        }    
    }
    // console.log(Cookies.get('usertype'));
    // console.log(Cookies.get('userid'));

    $('#out').click(function () {
        Cookies.remove('usertype');
        Cookies.remove('userid');
        window.location.href = "/";
    });
    
});