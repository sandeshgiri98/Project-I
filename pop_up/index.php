<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
       <button type="submit" class="btn" onclick="openPopup()">Submit</button> 
       <div class="popup" id="popup">
        <img src="tick.png" >
        <h2>Deleted</h2>
        <p>Your file has been successfully deleted.</p>
        <button type="btn" onclick="closePopup()">OK</button>
       </div>
    </div>
    <script>
        let popup=document.getElementById("popup");
        function openPopup(){
            popup.classList.add("open-popup");
        }
       
        function closePopup(){
            popup.classList.remove("open-popup");
        }
    </script>
</body>
</html>