<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat App</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{url('css/chat.css')}}">
</head>
<body>
<div class="container content">
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
        	<div class="card">
        		<div class="card-header">Chat</div>
        		<div class="card-body height3">
        			<ul class="chat-list" id="chat-section">
        			</ul>
        		</div>
        	</div>
			<div class="row mt-3 justify-content-between">
						<div class="col-lg-10">
							<input type="text" id="username" value="{{ $name }}" hidden>
							<input type="text" class="form-control" placeholder="Write message here...." id="chat_message">
						</div>
						<div class="col-lg-2 justify-content-center">
							<button class="btn btn-primary rounded w-100" onclick="broadcastMethod()">Send</button>
						</div>
					</div>
        </div>
    </div>
</div>
</body>
@vite('resources/js/app.js')
    <script>
        setTimeout(() => {
        window.Echo.channel('chatmessage').listen('chat',(data)=>{

			if(data.username==$("#username").val()){
        newMessage=`<li class="out">
        					<div class="chat-img">
        						<img alt="Avtar" src="https://bootdey.com/img/Content/avatar/avatar1.png">
        					</div>
        					<div class="chat-body">
        						<div class="chat-message">
        							<h5>${data.username}</h5>
        							<p>${data.message}</p>
        						</div>
        					</div>
        				</li>`;
			}
			else{
				newMessage=`<li class="in">
        					<div class="chat-img">
        						<img alt="Avtar" src="https://bootdey.com/img/Content/avatar/avatar1.png">
        					</div>
        					<div class="chat-body">
        						<div class="chat-message">
        							<h5>${data.username}</h5>
        							<p>${data.message}</p>
        						</div>
        					</div>
        				</li>`;

			}
		console.log(data);
		$("#chat-section").append(newMessage);
        })
    }, 200);
        function broadcastMethod(){
      $.ajax({
        headers:{
           'X-CSRF-TOKEN' : '{{csrf_token()}}'
        },
        url:'{{route('broadcast.chat')}}',
        type:'POST',
		data:{username : $("#username").val(), msg : $("#chat_message").val()},
        success : function(result){
            //  console.log(data);
            console.log(result);
        },
		error : function(error){
			console.log(error);
		}

      })
    }
    </script>
</html>