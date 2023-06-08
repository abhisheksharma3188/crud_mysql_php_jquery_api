<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div style="margin-right:auto;margin-left:auto;width:500px;text-align:center;">
            <form id="fetch_form">
                <h3>Fetch Data</h3>   
                <input type="number" name="s_no_1_input" placeholder="Start S.No" required><br><br> 
                <input type="number" name="s_no_2_input" placeholder="End S.No" required><br><br> 
                <button type="submit">Fetch</button><br><br>
                <div id="response_div">Response Will Come Here</div>
            </form>
        </div>
        <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
        <script>
            /////////////////////////////////// Form ajax submission code below ////////////////////////////////////
            $('#fetch_form').on('submit', function() {
                var formData = new FormData(this);
                var headers_obj = {"Authorization":"Bearer <?php echo '1234567890' /*@$_COOKIE['jwt_token_website'];*/ ?>"};
                $.ajax({
                    url: "api/fetch.php",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers:headers_obj,
                    success: function(data) {
                        console.log(data);
                        var code='';
                        if(data.length>0){
                            code=`<center>
                                  <table border="1">
                                  <tr>
                                      <td>S.No</td>
                                      <td>Name</td>
                                      <td>Surname</td>
                                      <td>Age</td>
                                  </tr>`;
                            for(i=0;i<data.length;i++){
                                code=code+`<tr>
                                               <td>${data[i].s_no}</td>
                                               <td>${data[i].name}</td>
                                               <td>${data[i].surname}</td>
                                               <td>${data[i].age}</td>
                                           </tr>`;
                            }
                            code=code+`</table>
                                       </center>`;
                            document.getElementById('response_div').innerHTML=code;
                        }else{
                            code='No data to fetch.';
                            document.getElementById('response_div').innerHTML=code;
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
