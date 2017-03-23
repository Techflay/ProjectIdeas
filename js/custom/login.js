$(window).load(function() {
    
    $("#submitLogin").on("click",function(){

         var email = $("#email").val();
         var password = $("#password").val();
        $.ajax({
              type: "GET",
              url: "login.php",
              dataType: "json",
              data: "email="+email+"&password="+password
            }).done(function(res) { 
                 if(res["success"] == 1){
                    alert(res['message']);
                   // window.location.href = "../index";
                 }else{
                   alert(res['message']);
                 }
            });
          
         
    });



});
