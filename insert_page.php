<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div style="margin-right:auto;margin-left:auto;width:500px;text-align:center;">
            <form id="insert_form">
                <h3>Insert Data</h3>   
                <input type="text" name="name_input" placeholder="Name" required><br><br> 
                <input type="text" name="surname_input" placeholder="Surname" required><br><br> 
                <input type="number" name="age_input" placeholder="Age" required><br><br> 
                <button type="submit">Insert</button><br><br>
                <div id="response_div">Response Will Come Here</div>
            </form>
        </div>
        <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
        <script>
            /////////////////////////////////// Form ajax submission code below ////////////////////////////////////
            $('#insert_form').on('submit', function() {
                var formData = new FormData(this);
                var headers_obj = {"Authorization":"Bearer <?php echo '1234567890' /*@$_COOKIE['jwt_token_website'];*/ ?>"};
                $.ajax({
                    url: "api/insert.php",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers:headers_obj,
                    success: function(data) {
                        console.log(data);
                        if (data.response == 'success') {
                            document.getElementById('response_div').innerHTML=`Message - ${data.message}. Data inserted at serial number - ${data.s_no}.`;
                        }
                        if (data.response == 'failure') {
                            document.getElementById('response_div').innerHTML=data.message;
                        }
                    },
                    error: function() {
                        alert('Some Error Occured.');
                    }
                });
                return false;
            });
            /////////////////////////////////// Form ajax submission code above ////////////////////////////////////   
        </script>
    </body>
</html>
