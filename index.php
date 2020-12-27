<!DOCTYPE html>
<html lang="en-us" dir="ltr">
    
    <head>
        <title>Track Your Expenses</title>
        <link rel="icon" href="assets/title_icon.png" type="image/png">

        <?php include 'assets/head_includes.php'; ?>

    </head>

    <body>
        
        <!-- Whole page contenet -->
        <div class="container">

            <?php include "assets/modal.php"; ?>

            <?php include "content.php"; ?>

        </div> <!-- End of the primary container -->

        <?php include 'assets/scripts.php'; ?>
		<script>
			$(document).ready(function () {
				$('.btn-primary').click(function (e) {
                    e.preventDefault();
                    var name = $('#name').val();
                    var email = $('#email').val();
                    var message = $('#message').val();

				    $.ajax({
					    type: "POST",
					    url: "actions/showTable.php",
					    data: { "name": name, "email": email, "message": message },

                        success: function (data) {
                            $('.result').html(data);
                            $('.modal-body').html(data);
                            $('#contactform')[0].reset();
                        }
					});
				});

				
			});
		</script>
    
    </body>

    
</html>
