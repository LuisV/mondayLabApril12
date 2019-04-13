<!DOCTYPE html>
<?php
session_start();
if(isset( $_POST["progress"] )){
    foreach ($_POST as $key => $value) {
    $_SESSION[$key] = $value;
    
    }
    header('Location: index.php');
}

?>
<html>
    <head>
        
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
       
        <style type="text/css">
          .main{
              width:80%;
              font-size: 20px;
              margin: auto;
          }
          form{
              display:flex;
              flex-direction: column;
          }
          #submit{
           margin-top:16px;
           width: 200px;   
          }
        </style>
    </head>
    <body>
        <div class="jumbotron">
            <h1>Sign up for the Otter Newsletter</h1>
        </div>
        <div class = "main">
        <div class="panel panel-default">
            <div class="panel-heading"> Enter your basic info</div>
            <div class="panel-body content">
                <?php
                switch($_SESSION["progress"]){
                    case 3:
                        echo 'Submit this data? <br>
                                <button id="send"> Submit</button>';
                        break;
                    case 2:
                        echo '<form method="POST">
                                <input name="progress" type="hidden" value=3 />
                                Enter your major: <input type="text" name="major"/>
                                Enter your zip: <input type="text" name="zip"/>
                                <input id="submit" type="submit" value="next" />
                              </form>';
                              break;
                    default:
                        echo '<form method="POST">
                                <input name="progress" type="hidden" value=2 />
                                Enter your name: <input type="text" name="name"/>
                                Enter your email: <input type="text" name="email"/>
                                <input id="submit" type="submit" value="next" />
                              </form>';
                              break;
                }
                ?>
        </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading"> Current data</div>
            <div class="panel-body content">
                
                <?php
                if(isset( $_SESSION["progress"])){
                     foreach ($_SESSION as $key => $value) {
                         echo "$key: $value <br>";
    
                        }
                        
                }
                ?>
            </div>
            </div>
        </div>
        
        
    </body>
    
    <script type='text/javascript'>
        <?php 
              $js_array = json_encode($_SESSION);
              echo "var arr = ". $js_array . ";\n";
        ?>
        $("#send").click( function(){
            
         $.ajax({
        type: "post",
        url: "API/sendData.php",
        dataType: "json",
        data: {
            "data": arr
            
        },
        success: function(data){
            let htmlString="<div class='panel-heading'> Newsletter</div>" +
            "<div class='panel-body content'>";
                data.forEach(function( user ){
                    htmlString+=" User ID: "+user.id+ "<br>";
                    htmlString+=" Name: "+user.name+ "<br>";
                    htmlString+=" Email: "+user.email+ "<br>";
                    htmlString+=" Major: "+user.major+ "<br>";
                    htmlString+=" Zip: "+user.zip+ "<br><br>";
                    
                })
                htmlString+=" </div>";
            $(".main").html(htmlString);   
        }
        });
           
        });
    </script>
</html>