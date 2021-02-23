<!DOCTYPE html>
<html>
<head>
	<title>PubNub Chat</title>
	<meta charset=utf-8>
	<meta name=description content="">
	<meta name=viewport content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<body>
<div class="container d-flex justify-content-center">
    <div class="card mt-4">
        <div class="message-area" id="message-area">
        	<div class="d-flex flex-row justify-content-between p-3 adiv text-white"> <i class="fa fa-chevron-left"></i> <span class="pb-3">Pubnub chat</span> <i class="fa fa-times"></i> </div>

        	<div class="messages" id="messages">
        		
        	</div>
       	
        </div>
        <div class="form-group px-3 d-flex">
        <input type="text" class="form-control" placeholder="Type your message" id="textbox"> 
        <input type="file" style="display: none;" id="imagefile" accept="image/*">
        <button style="border:none;outline: none;cursor: pointer;background-color: transparent;" id="choosefile" onclick="chooseimage()"><i class="fa fa-paperclip" style="font-size: 25px;color: #0000ffa6;"></i>
        </button>
        <div class="dropup">
	  <button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border:none;outline: none;cursor: pointer;background-color: transparent; font-size: 20px;">
	    <i class="fa fa-cog" aria-hidden="true"></i>
	  </button>
	  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
	    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModal">Change Chat Name</a>
      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModal1">Change Avatar</a>
	  </div>
	</div>
    	</div>
    </div>

<!-- user name modal -->
    <div class="modal fade" id="exampleModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Change User Name</h5>
      <!--   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> -->
      </div>
      <div class="modal-body">
          <div class="form-group">
            <label for="namefield">UserName</label>
            <input type="text" class="form-control" id="namefield" placeholder="enter your name..." autofocus="" required="">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closebtn" style="display: none;">Close</button>
        <button type="button" class="btn btn-primary" id="updatename">JoinChat</button>
      </div>
    </div>
  </div>
</div>

<!-- end of user name modal -->

<!-- user avatar modal -->
    <div class="modal fade" id="exampleModal1" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">User Image</h5>
    <!--     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> -->
      </div>
      <form method="POST" enctype="multipart/form-data" action="uploadfile.php" id="userUpload">
        <div class="modal-body">
          <div class="form-group">
            <label for="useravatar">Choose Image</label>
            <input type="file" class="form-control" id="useravatar" name="userpic" required="" accept="image/*">
            <img src="#" alt="user profile image" style="display: none;" id="previewImg" height="200px" width="200px" />
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closebtn1">Close</button>
        <button type="submit" class="btn btn-primary" id="updateprofilePic">Update</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- end of user avatar model -->

</div>

<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
<script src="https://cdn.pubnub.com/sdk/javascript/pubnub.4.29.11.js"></script>
<script type="text/javascript" src="jquery.emojiFace.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
<script src="./js/app.js"></script>
</body>
</html>