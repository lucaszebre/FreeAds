<!DOCTYPE html>
<html>
<head>
@vite(['resources/js/app.js'])
</head>
<body>
@if(session()->has('success'))
    <p>
        {{ session()->get('success') }}
    </p>
@endif

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif


<h1>Chat</h1>


@foreach($items as $item)
    <div id="messages">
        <span>{{ $item->user }} : {{ $item->content }}</span>
    </div>        
@endforeach

<form  action="{{ route('message.send') }}" method="post" >
    @csrf
    
    <table>
        
         <tr>
            <td>Message</td>
            <td><input type="text" id="messageInput" name="content" value=""></td>
        </tr>
        <tr>
            <td></td>ty
            <td>
            <button >Send</button>
            </td>
        </tr>
    </table>
</form>



<script type='module'>
    document.addEventListener('DOMContentLoaded', function () {
        Echo.channel(`channel_for_everyone`)
            .listen('GotMessage', (e) => {
                console.log(e.model);

                const messages = document.getElementById('messages');
                const messageElement = document.createElement('div');
                messageElement.innerHTML = `<strong>${e.user}:</strong> ${e.content}`;
                messages.appendChild(messageElement);
                messages.scrollTop = messages.scrollHeight; 
            });


            
    })

    function sendMessage() {
    console.log("hahah ici");
    const messageInput = document.getElementById('messageInput');
    const message = messageInput.value;
    messageInput.value = ''; 
    fetch(`/message`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            user:'kihura',
            content: message})
    }).catch(error => console.error('Error:', error));
}

</script>
</body>
</html>













