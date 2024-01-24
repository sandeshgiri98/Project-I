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
        <img src="delete.png" >
        <h2 style="color:red">Delete</h2>
        <p>Are you sure you want to delete?</p>
        <div class="configure">
        <button type="btn" onclick="closePopup()">Yes</button>
        <button type="btn" onclick="closePopup()">No</button>
        </div>
        
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