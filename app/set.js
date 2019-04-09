
$('.parameter').change(function(){
    var id = $(this).val();
    var row = $(this).attr("id");
    var action = "fetch_method";
    $.ajax({
    url:"app/instruments.php",
    method:"POST",
    data:{action:action,id:id},
    dataType:"text",
    success:function(data)
    {
        $('#method'+row).html(data);
    }
    });
});



$(document).on('submit', '#instrument_form',function(event){
    event.preventDefault();
        $.ajax({
            url:"app/instruments.php",
            method: "POST",
            data: new FormData(this),
            contentType:false,
            processData:false,
            success:function(data)
            {
                if (data == "success")
                {
  //              alert("Data Inserted");    
                    successNotifier("Data Inserted");
                window.open('test','_self');
                }
                else
                {
                    errorNotifier(data);
//                alert(data);   
                }
            }
        });
    });  



	  $(document).on('submit', '#login_form',function(event){
        event.preventDefault();
            $.ajax({
                url:"app/data.php",
                method: "POST",
                data: new FormData(this),
                contentType:false,
                processData:false,
                success:function(data)
                {
                    if (data == "success")
                    {
                    window.open('dashboard','_self');
                    }
                    else
                    {
                    errorNotifier(data);
                        //alert(data);   
                    }
                }
            });
        });  


	  $(document).on('submit', '#register_form',function(event){
        event.preventDefault();
            $.ajax({
                url:"app/data.php",
                method: "POST",
                data: new FormData(this),
                contentType:false,
                processData:false,
                success:function(data)
                {
                    if (data == "success")
                    {
                    window.open('home','_self');
                    }
                    else
                    {
                        errorNotifier(data);
                        //                  alert(data);   
                    }
                }
            });
        });  

	  $(document).on('submit', '#personal_form',function(event){
        event.preventDefault();
            $.ajax({
                url:"app/users.php",
                method: "POST",
                data: new FormData(this),
                contentType:false,
                processData:false,
                success:function(data)
                {
                    if (data == "success")
                    {
                    successNotifier("Update was successful");
                        //    alert("Update was successful");
                    }
                    else
                    {
                        errorNotifier(data);
//                    alert(data);   
                    }
                }
            });
        });  





  $('#add_users').click(function(){
        $('#users_form')[0].reset();
        $('#action').val("insert");
        $('#operation').val("Insert");
    });

	  
    $(document).on('submit', '#users_form',function(event){
        event.preventDefault();
            $.ajax({
                url:"app/users.php",
                method: "POST",
                data: new FormData(this),
                contentType:false,
                processData:false,
                success:function(data)
                {
                    if (data == "success")
                    {
  //                  alert("User enetered successfully");   
                        successNotifier("User entered successfully");
                    $('#usersModal').modal('hide');
                    $('#users_form')[0].reset();
                    $('#users_table').bootstrapTable('refresh', {url:'app/users.php?action=fetch'});
                   
                    }
                    else
                    {
                        errorNotifier(data);
//                    alert(data);
                    }
                }
            });
        }); 


    
  $(document).on('click', '.edit_user',function(){
         var id = $(this).attr("id");
         $.ajax({
            url:"app/users.php",
            method:"POST",
            data:{id:id, action:"fetch_single"},
            dataType:"json",
            success:function(data)
                 {
                $('#usersModal').modal('show');
                $('#name').val(data.name);
                $('#email').val(data.email);
                $('#gsm').val(data.gsm);
                $('#address').val(data.address);
                $('#id').val(id);
                
                $('.modal-title').text("Edit User");
                $('#action').val("update");
                $('#operation').val("Update");
                }
         });
     });


     $(document).on('click', '.delete_user', function(){
        var user_id = $(this).attr("id");
        if (confirm("Are you sure you want to delete this User?"))
        {
            $.ajax({
                url:"app/users.php",
                method:"POST",
                data:{id:user_id, action:'delete'},
                success:function(data)
                {
                    
                    
                if (data == 'success')
                {
                    $('#users_table').bootstrapTable('refresh', {url:'app/users.php?action=fetch'});
  //                  alert("Deleted");
                    successNotifier("Deleted");
                    $('#users_table').bootstrapTable('refresh', {url:'app/users.php?action=fetch'});
              
                }
                else
                {
                    errorNotifier(data);
//                 alert(data);   
                }
        
                }                

            });
        }
        else
        {
            return false;
        }
     });


$(document).on('submit', '#lab_form',function(event){
        event.preventDefault();
            $.ajax({
                url:"app/users.php",
                method: "POST",
                data: new FormData(this),
                contentType:false,
                processData:false,
                success:function(data)
                {
                    if (data == "success")
                    {
                   //    alert("Details updated successfully");   
                        successNotifier("Details updated successfully");
                    }
                    else
                    {
                        errorNotifier(data);
//                    alert(data);
                    }
                }
            });
        }); 



$(document).on('submit', '#test_form',function(event){
        event.preventDefault();
            $.ajax({
                url:"app/test.php",
                method: "POST",
                data: new FormData(this),
                contentType:false,
                processData:false,
                success:function(data)
                {
                    if (data == "success")
                    {
                   // alert("Details updated successfully");
                    successNotifier("Details updated successfully");   
                    $('#test_form')[0].reset();
                    $('#show').html('');
                    }
                    else
                    {
                   errorNotifier(data);
                        // alert(data);
                    }
                }
            });
        }); 




$(document).on('click', '.view',function(){

         var id = $(this).attr("id");
         $.ajax({
            url:"app/subs.php",
            method:"POST",
            data:{id:id, action:'fetch_single'},
            success:function(data)
                {
                $('#sampModal').modal('show');
                $('#result').html(data);
                }
      });
      });

$(document).on('click', '.active',function(){

         var cycle = $(this).attr("name");
         var select = $(this).attr("id");
         $('#loading').removeClass("hidden");
         $.ajax({
            url:"app/test.php",
            method:"POST",
            data:{cycle:cycle,select:select,action:'show'},
            success:function(data)
                {
                $('#loading').addClass("hidden");
                $('#show').html(data);
               $('#sampModal').modal('hide');
                }
      });
      });

$(document).on('click', '.view_report',function(){

         var cycle = $(this).attr("id");
         var year = $(this).attr("name");
         
         $.ajax({
            url:"app/report.php",
            method:"POST",
            data:{cycle:cycle,year:year,action:'show'},
            success:function(data)
                {

                $('#result').html(data);
               $('#reportModal').modal('show');
                }
      });
      });

$(document).on('click', '.download',function(){

         var cycle = $(this).attr("id");
         var year = $(this).attr("name");
         
         $.ajax({
            url:"app/report.php",
            method:"POST",
            data:{cycle:cycle,year:year,action:'download'},
            success:function(data)
                {
                $('#HTMLtoPDF').html(data);
                HTMLtoPDF();
                }
      });
      });


$(document).on('submit', '#sub_select',function(event){
        event.preventDefault();
         $.ajax({
            url:"app/test.php",
            data: new FormData(this),
            method:"POST",
                contentType:false,
                processData:false,
            success:function(data)
                {
                $('#sampModal').modal('show');
                $('#result').html(data);
                }
            
         });
      });

$(document).on('click', '.apply', function(){
        var user_id = $(this).attr("id");
        if (confirm("Are you sure you want to apply for this?"))
        {
            $.ajax({
                url:"app/subs.php",
                method:"POST",
                data:{id:user_id, action:'apply'},
                success:function(data)
                {
                    
                    
                if (data == 'success')
                {
                    $('#subs_table').bootstrapTable('refresh', {url:'app/subs.php?action=fetch'});
                    successNotifier("Applied");
                    // alert("Applied");
                    $('#subs_table').bootstrapTable('refresh', {url:'app/subs.php?action=fetch'});
              
                }
                else
                {
                    errorNotifier(data);
                // alert(data);   
                }
        
                }                

            });
        }
        else
        {
            return false;
        }
     });


$(document).on('click', '.unapply', function(){
        var user_id = $(this).attr("id");
        if (confirm("Are you sure you want to unapply for this?"))
        {
            $.ajax({
                url:"app/subs.php",
                method:"POST",
                data:{id:user_id, action:'unapply'},
                success:function(data)
                {
                    
                    
                if (data == 'success')
                {
                    $('#subs_table').bootstrapTable('refresh', {url:'app/subs.php?action=fetch'});
                    successNotifier("Unapplied");
                    // alert("Unapplied");
                    $('#subs_table').bootstrapTable('refresh', {url:'app/subs.php?action=fetch'});
              
                }
                else
                {
                 errorNotifier(data);   
                 //alert(data);   
                }
        
                }                

            });
        }
        else
        {
            return false;
        }
     });


$(document).on('submit', '#events_form',function(event){
        event.preventDefault();
            $.ajax({
                url:"app/events.php",
                method: "POST",
                data: new FormData(this),
                contentType:false,
                processData:false,
                success:function(data)
                {
                    if (data == "success")
                    {
                    $('#events_form')[0].reset();
                    successNotifier("Event Added");
                    window.open('limits', '_self');
                    }
                    else
                    {
                        errorNotifier(data);
                        //  alert(data);   
                    }
                }
            });
        });  


$(document).on('click', '.delete_cycle', function(){
        var user_id = $(this).attr("id");
        if (confirm("Are you sure you want to delete this event?"))
        {
            $.ajax({
                url:"app/events.php",
                method:"POST",
                data:{id:user_id, action:'delete'},
                success:function(data)
                {
                    
                    
                if (data == 'success')
                {
                    $('#events_table').bootstrapTable('refresh', {url:'app/events.php?action=fetch'});
                    successNotifier("Applied");
                    //                  alert("Applied");
                    $('#events_table').bootstrapTable('refresh', {url:'app/events.php?action=fetch'});
              
                }
                else
                {
                    errorNotifier(data);
//                 alert(data);   
                }
        
                }                

            });
        }
        else
        {
            return false;
        }
     });



$(document).on('click', '.view_team',function(){

         var name = $(this).attr("id");
         
         $.ajax({
            url:"app/labs.php",
            method:"POST",
            data:{name:name,action:'view_team'},
            success:function(data)
                {

                $('#result').html(data);
               $('#sampModal').modal('show');
                }
      });
      });


$(document).on('click', '.view_subs',function(){

         var name = $(this).attr("id");
         
         $.ajax({
            url:"app/labs.php",
            method:"POST",
            data:{name:name,action:'view_subs'},
            success:function(data)
                {

                $('#result').html(data);
               $('#sampModal').modal('show');
                }
      });
      });


$(document).on('click', '.delete_lab', function(){
        var name = $(this).attr("id");
        if (confirm("Are you sure you want to delete this Lab?"))
        {
            $.ajax({
                url:"app/users.php",
                method:"POST",
                data:{name:name, action:'delete_lab'},
                success:function(data)
                {
                    
                    
                if (data == 'success')
                {
                    $('#labs_table').bootstrapTable('refresh', {url:'app/labs.php?action=fetch'});
                    successNotifier("Deleted");
                    //alert("Deleted");
                    $('#labs_table').bootstrapTable('refresh', {url:'app/labs.php?action=fetch'});
              
                }
                else
                {
                    errorNotifier(data);
                   // alert(data);   
                }
        
                }                

            });
        }
        else
        {
            return false;
        }
     });















      // success message notifier ..
      function successNotifier(message = "Action Successful")
      {

          $('#msg').text(message);
          $('#color').removeClass('alert-danger').addClass('alert-success');
          $('#msgModal').modal('show');
          setTimeout(function(){
          $('#msgModal').modal('hide');
          }, 3000);
      }

      // error message notifier ..
      function errorNotifier(message = "An Error Occured, Try Again")
      {
          $('#msg').text(message);
          $('#color').removeClass('alert-success').addClass('alert-danger');
          $('#msgModal').modal('show');
          setTimeout(function(){
          $('#msgModal').modal('hide');
          }, 3000);
      }




      $(document).on('submit', '#lim_select',function(event){
        event.preventDefault();
         $.ajax({
            url:"app/limits.php",
            data: new FormData(this),
            method:"POST",
                contentType:false,
                processData:false,
            success:function(data)
                {
                $('#sampModal').modal('show');
                $('#result').html(data);
                }
            
         });
      });


      $(document).on('click', '.activer',function(){
        
                 var cycle = $(this).attr("name");
                 var select = $(this).attr("id");
                 $('#loading').removeClass("hidden");
                 $.ajax({
                    url:"app/limits.php",
                    method:"POST",
                    data:{cycle:cycle,select:select,action:'show'},
                    success:function(data)
                        {
                        $('#loading').addClass("hidden");
                        $('#show').html(data);
                       $('#sampModal').modal('hide');
                        }
              });
              });
        



      $(document).on('submit', '#limit_form',function(event){
        event.preventDefault();
            $.ajax({
                url:"app/limits.php",
                method: "POST",
                data: new FormData(this),
                contentType:false,
                processData:false,
                success:function(data)
                {
                    if (data == "success")
                    {
                   // alert("Details updated successfully");
                    successNotifier("Details updated successfully");  
                    $('#limit_form')[0].reset(); 
                    $('#show').html('');
                    }
                    else
                    {
                   errorNotifier(data);
                        // alert(data);
                    }
                }
            });
        }); 







/*    
        function successNotifier(message = "Action Successful")
        {
        $('.info-box p').text(message);
        $('.info-box').removeClass('bg-red').addClass('bg-green').slideDown().delay(3000).slideUp();
        }

        function errorNotifier(message = "Some Error Occured")
        {
        $('.info-box p').text(message);
        $('.info-box').removeClass('bg-green').addClass('bg-red').slideDown().delay(3000).slideUp();
        }

*/
      