$(document).ready(function () {
    // console.log(Cookies.get('usertype'));
    // console.log(Cookies.get('userid'));

    if (Cookies.get('usertype') == null) {
        // window.location.replace('../login/index.html');
        Swal.fire({
            icon: 'error',
            title: 'Please login first.',
            footer: '<a href="../../login/">Login here.</a>',
            timer: 2000
          })
          setTimeout(() => {
            window.location.href = "/login";
          }, 2000);      
    }else if(Cookies.get('usertype') != "Admin"){
        if(Cookies.get('usertype') === "Patron"){
            window.location.href = "/user/index";
        }else if(Cookies.get('usertype') === "Librarian"){
            window.location.href = "/librarian/index";
        }
    }

    $('#out').click(function () {
        Cookies.remove('usertype');
        Cookies.remove('userid');
        // window.location.replace('../');
        window.location.href = "/";
    });
    
});