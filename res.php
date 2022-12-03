<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <div id="test"></div>

    <script>
        // const xmlhttp=new XMLHttpRequest();
        // let datar={};
        // xmlhttp.onload=function(){
        //     const data=JSON.parse(this.responseText);
        //     console.log(data);

        // }

        // xmlhttp.open("GET","testjson.php");
        // xmlhttp.send();
        const xmlhttp = new XMLHttpRequest();

        xmlhttp.onload = function() {
        const myObj = JSON.stringify(this.responseText);
        let data=JSON.parse(myObj)
        console.log(data.data);
        document.getElementById("test").innerHTML =data.data ;
        }
        xmlhttp.open("GET", "testjson.php");
        xmlhttp.send();
    </script>
</body>
</html>