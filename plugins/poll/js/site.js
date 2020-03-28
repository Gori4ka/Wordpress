(function ($) {
    $(document).ready(function () {

        $('#datetimepicker1').datetimepicker({
            format: 'YYYY-MM-DD'
        });

        $('#datetimepicker2').datetimepicker({
            format: 'YYYY-MM-DD'
        });

        $('#plus').click(function () {
            $('.answers').append('<div class="form-group"><input type="text" name="answer[]" placeholder="Answer" class="form-control" /></div>')
        });

        $('#update').click(function () {
            $('.answers').append('<div class="form-group"><input type="text" name="new_answer[]" placeholder="Answer" class="form-control" /></div>')
        });

        $('.delete_icon').click(function () {
            var current_delete_icon = this;
            bootbox.confirm("Are you sure you want to delete?", function (result) {
                if (result) {
                    var data = {
                        action: 'delete_poll',
                        delete: parseInt($(current_delete_icon).attr('data-poll-id')),
                    };
                    $.post('/wp-admin/admin-ajax.php', data, function (response) {
                        if (response.status == 'ok') {
                            location.reload();
                        } else {
                            alert('Ooops! The poll wasn\'t deleted!');
                        }
                    });
                }
            });
        });

        $('.message_close_btn').click(function () {
            $(this).parent().addClass('closed');
        })

        $('#form_submit').on("click", function(e) {
          e.preventDefault();
          var answer = $("input[name='answer']:checked").val();
          if(answer!== 0 && answer){
            bootbox.prompt("Ձեր Էլ.փոստ", function(result){
              if(result){
                var data = {
                  action: 'submit_frontend_form',
                  poll_id: $('#_poll_id').val(),
                  answer: $("input[name='answer']:checked").val(),
                  user_email: result
                };
                $.post( "/wp-admin/admin-ajax.php", data, function(response) {
                     if(response.status == 'ok'){
                        location.reload();
                     }else{
                       bootbox.alert(response.message, function(){
                       });
                     }
                });
              }else{
                bootbox.alert("Էլ.Փոստը մուտքագրված չի", function(){
                });
              }
            });
          }else{
            bootbox.alert("Պատասխանը ընտրված չի", function(){
            });
          }
        });

        // var options = {
        //     type: "POST",
        //     url: "/wp-admin/admin-ajax.php",
        //     data: {
        //         action: 'submit_frontend_form',
        //     },
        //     success: function (data) {
        //         if (data.status == 'ok') {
        //           bootbox.alert(data.message, function(){
        //             location.reload();
        //           });
        //         } else {
        //           bootbox.alert(data.message);
        //         }
        //     }
        // };
        //$('.user_vote_poll').ajaxForm(options);
    });

})(jQuery);
