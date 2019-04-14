<?php
session_start();
foreach ($_POST as $key => $value) {
    $_SESSION[$key] = $value;
}
$form="";
$currentData="";
switch($_SESSION["progress"]){
    case 2:
        $form= 'Submit this data? <br>
                <button id="send"> Submit</button>';
        break;
    case 1:
       // $_SESSION["progress"] = 2;
       $form= '<form id="next" method="POST">
                <input name="progress" type="hidden" value=2 />
                Enter your major: <input type="text" name="major"/>
                Enter your zip: <input type="text" name="zip"/>
                <input id="button" type="submit" value="next" />
              </form>';
              break;
    default:
        //$_SESSION["progress"] = 1;
        $form= '<form id="next" method="POST">
                <input name="progress" type="hidden" value=1 />
                Enter your name: <input type="text" name="name"/>
                Enter your email: <input type="text" name="email"/>
                <input id="button" type="submit" value="next" />
              </form>';
              break;
}

if(isset( $_SESSION["progress"])){
     foreach ($_SESSION as $key => $value) {
         $currentData.="$key: $value <br>";

        }
        
}
echo json_encode(array(
    'form'=> $form,
    'currentData'=>$currentData
    ));
                ?>