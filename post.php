<?php
 require_once ('db/conn.php');


//  if($post->add("hiii","dommy data")){
//     echo "add";
// }else{
//     echo "noon";
// }
if(isset($_POST['tt'])){
    
    if($post->add($_POST['tt'],$_POST['cc'],$_POST['rr'])){
            echo "add";
        }else{
            echo "noon";
        }
}

?>
<form action="" method="post">

<input type="text" step="0.01" name="tt">
<input type="text" step="0.01" name="cc">
<input type="number" step="0.01" name="rr">
<button>tt</button>
</form>
