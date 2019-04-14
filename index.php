<!DOCTYPE html>

<html>
    <head>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
        <link rel="stylesheet" href="./CSS/styles.css" type="text/css" />
        
    </head>
    <body>
        <div class="jumbotron">
            <h1>Sign up for the Otter Newsletter</h1>
        </div>
        <div class = "main">
        <div class="panel panel-default">
            <div class="panel-heading"> Enter your basic info</div>
            <div class="panel-body content" id ="form">
                <!-- Form data will go here -->
        </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading"> Current data</div>
            <div class="panel-body content" id="current" >
                 <!-- Session data will go here -->
            </div>
            </div>
        </div>
        <button id="view"> View Data?</button>
        
    </body>
    
    <script type='text/javascript'>
    //Function to call API to return form HTML and Session data HTML
    function displayNextForm(){
         $.ajax({
            type: "post",
            url: "API/getNextForm.php",
            dataType: "json",
            data: $("form").serialize(),
            success: function(data){
                console.log(data.currentData);
                $("#form").html(data.form);
                $("#current").html(data.currentData);
            },
            
            });
    }
    function viewList(){
        $.ajax({
        type: "post",
        url: "API/sendData.php",
        dataType: "json",
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
    }
    $(document).ready(function(e){
    //Call it as soon as page loads
    displayNextForm();
    
    //Needs to delegate the event from parent to child
    //Necessary due to `.click` or `submit` not working on dynamic elements
     $('#form').on('submit', '#next', function (e) {
         e.preventDefault();
     displayNextForm();
     }); 
    
   $('#form').on('click', '#send', function (e) {
         viewList();
           
    });
        
    $("#view").click( function(){
        viewList(); 
    });
});
    </script>
</html>