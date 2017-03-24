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
                 console.log(res)
                 if(res["success"] == 1){
                    alert("sucess");
                   // window.location.href = "../index";
                 }else{
                   alert("filuere");
                 }
            });
          
         
    });



});
