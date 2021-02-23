$(function(){

	  $('#textbox').emojiInit({
	    fontSize:20,
	        success : function(data){
	    },
	        error : function(data,msg){
	    }
	  });
	});

	var theChannel = 'the_guide'; 
	var theEntry = localStorage.getItem('username');
	var userAvatar = localStorage.getItem('avatar');
	var messageArea = document.getElementById('messages');
	var messageField = document.getElementById('message-area');
	var updatenameField = document.getElementById('namefield');
	var updateBtn = document.getElementById('updatename');
  let current_time;

	$(document).ready(function(){
	  // alert('hello');
		// if(!localStorage.getItem('username')){
		// 	$.ajax({
		// 		type:'GET',
		// 		url:'https://cors-anywhere.herokuapp.com/https://api.namefake.com/',
		// 		success:function(response){
		// 			var username =  JSON.parse(response);
		// 			var addGuestname = username.name + '@guest' + Math.floor(Math.random()*90000) + 10000;
		// 			// console.log(addGuestname)
		// 			localStorage.setItem('username', addGuestname);
		// 			localStorage.setItem('avatar', `https://ui-avatars.com/api/?name=${username.name}`);
	 //        		theEntry = localStorage.getItem('username');
	 //        		userAvatar = localStorage.getItem('avatar');
		// 		},
		// 		error:function(error){
		// 			console.log(error)
		// 		}
		// 	})
		// }
    $('#exampleModal').modal('show');
	})



	updateBtn.addEventListener('click', function(){
		// console.log(updatenameField.value);
		if(updatenameField.value !== ''){
			localStorage.removeItem('username');
			localStorage.setItem('username', updatenameField.value);
			localStorage.removeItem('avatar');
			localStorage.setItem('avatar', `https://ui-avatars.com/api/?name=${updatenameField.value}`);
			theEntry = localStorage.getItem('username');
	        userAvatar = localStorage.getItem('avatar');
      document.getElementById('closebtn').click();    
		}else {
        return     
    }
	})


  function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#previewImg').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

  $("#useravatar").change(function() {
  $("#previewImg").css("display", "block");
    readURL(this);
  });


$('#userUpload').submit(function(event){
    event.preventDefault();
    
    $(this).ajaxSubmit({
      data: $('#userUpload').serialize(),
      contentType: 'application/json',
      success: function(response){
        console.log(response)   
        localStorage.removeItem('avatar');
        localStorage.setItem('avatar', `https://enlyvo.com/live1/hlsplay/pubnub/uploads/${response}`);
        userAvatar = localStorage.getItem('avatar');
        document.getElementById('closebtn1').click()  
      }
  });
    return false;
  });


  var pubnub = new PubNub({
    // replace the key placeholders with your own PubNub publish and subscribe keys
    publishKey: 'pub-c-b683fff6-df8f-4b8f-846d-03279eb2c2f1',
    subscribeKey: 'sub-c-48fb2e12-54bc-11eb-bf6e-f20b4949e6d2',
    uuid: "theClientUUID"
  });

	var textbox = document.getElementById('textbox');

 	var inpTxt = document.getElementById('imagefile');
        function chooseimage(){
            inpTxt.click()
        }
	  textbox.addEventListener('keyup', function(e) {
	    if(e.keyCode === 13){
        current_time = moment().format("hh:mm a");
	      submitUpdate(theEntry, textbox.value,userAvatar,current_time)
          textbox.value = '';
	    }
	  })  

      pubnub.addListener({
        message:function(event){
        	 // console.log(event)
          displayMessage(event.message.entry,event.message.update,event.message.avatar,event.message.time)
        },
        presence:function(event){
          console.log(event)
        },
        status:function(event){
          console.log(event)
        },
        file:function(event){
            // console.log(event)
            displayFile(event.file.url,event.file.name,event.message.user,event.message.avatar,event.message.time);
        }
      });

      pubnub.subscribe({
        channels: ['the_guide'],
          withPresence: true
      });

    submitUpdate = function(entry,update,userAvatar){
             // console.log(entry,update,userAvatar)
        pubnub.publish({
          channel: theChannel,
           message : {'entry' : entry, 'update' : update, 'avatar':userAvatar,'time':current_time}
        },function(status,response) {
          if(status.error){
            console.log(status)
          }
        })
      }

    displayMessage = function(entryname,message,userAvatar,time){
      	// console.log(message,entryname)
        var appendvalue = `
        <div class="d-flex flex-row p-3"> <img src="${userAvatar}" width="30" height="30" style="border-radius: 50%;">
            <div class="chat ml-2 p-3" style="line-height:1px">
            		<p class="text-muted text-bold" style="font-size:10px">${entryname} <span style="margin-left:20px;">${time}</span></p>
            		<p>${message}</p>
            </div>
        </div>
        `;
        // messageArea.before(appendvalue);
        messageArea.innerHTML += appendvalue;
        messageArea.scrollTop = messageArea.scrollHeight;
      }

     inpTxt.addEventListener('change', function(){
     	var filename = inpTxt.files[0];
            // console.log(filename)
          if(filename.size > 1024*1024*5){
                 alert('Please choose image less than 5mb')
                 return
             }
             current_time = moment().format("hh:mm a");
              var result = pubnub.sendFile({
                channel: theChannel,
                file: filename,
                message: {'user':theEntry,'avatar':userAvatar,'time':current_time}
              });
      }) 

    displayFile = function(url,name,user,avatar,time){
        var appendImg = `
        <div class="d-flex flex-row p-3"> <img src="${avatar}" width="30" height="30" style="border-radius: 50%;">
            <div class="chat ml-2 p-3" style="line-height:1px">
            		<p class="text-muted text-bold" style="font-size:10px">${user} <span style="margin-left:20px;">${time}</span></p>
            		<p><img src="${url}" class="avtar1" alt="${name}" style="height:100px;width:100px;"></p>
            </div>
        </div>
        `;
        messageArea.innerHTML +=appendImg;
        messageArea.scrollTop = messageArea.scrollHeight;
    }   

