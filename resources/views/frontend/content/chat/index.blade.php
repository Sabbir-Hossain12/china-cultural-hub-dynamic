@extends('frontend.layout.master')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <style>
        body {
            background: linear-gradient(145deg, #f4f6fa, #e9ecef);
            font-family: 'Poppins', sans-serif;
        }

        /*#chat-container {*/
        /*    margin-top: 200px;*/
        /*    background-image: url('https://media4.giphy.com/media/v1.Y2lkPTc5MGI3NjExamkyY3pxcnh0cDhhbjc3ZmVvcGVyemd6aTBlM3J3amdrbHZ0OWgwaSZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/uSbkiCah4v38Wabk6L/giphy.gif');*/
        /*    background-size: cover;*/
        /*    background-repeat: no-repeat;*/
        /*    background-position: center;*/
        /*}*/

        /* Chat Container */
        #chat-container {
            margin: 30px auto 30px auto;
            width: 70%;
            max-width: 900px;
            height: 65vh;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
            padding: 1.5rem;
        }

        /* Chat Bubbles */
        .chat-message {
            margin: 1rem 0;
            display: flex;
            align-items: flex-start;
        }

        .chat-message.user {
            justify-content: flex-end;
        }

        .chat-bubble {
            max-width: 70%;
            padding: 0.9rem 1.3rem;
            border-radius: 1.25rem;
            line-height: 1.5;
            word-wrap: break-word;
            font-size: 1rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .chat-bubble.user {
            background:  #ee1c25;
            color: #fff;
            border-radius: 1rem 1rem 0 1rem;
        }

        .chat-bubble.bot {
            background-color: #f1f3f6;
            color: #333;
            border-radius: 1rem 1rem 1rem 0;
        }

        /* Input Area */
        #chat-input-container {
            width: 70%;
            max-width: 900px;
            background: #fff;
            border-radius: 15px;
            padding: 1.2rem;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            margin: 0 auto 60px auto;
        }

        #chat-input {
            flex: 1;
            height: 70px;
            color: #2f2f2f;
            padding: 0.8rem 1rem;
            border: 1px solid #ddd;
            border-radius: 1rem;
            outline: none;
            font-size: 1rem;
            resize: none;
            transition: 0.2s ease-in-out;
        }

        #chat-input:focus {
            border-color: #ee1c25;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
        }

        #send-button {
            margin-left: 0.8rem;
            background: #ee1c25;
            color: #fff;
            border: none;
            border-radius: 1rem;
            padding: 0.8rem 1rem;
            cursor: pointer;
            font-size: 1rem;
            transition: 0.3s ease-in-out;
        }

        #send-button:hover {
            background: linear-gradient(135deg, #0056d2, #003c9a);
            transform: scale(1.05);
        }

        /* Header Section */
        .assistant-header {
            text-align: center;
            margin-top: 150px;
            margin-bottom: 30px;
        }

        .assistant-header h1 {
            font-size: 2rem;
            font-weight: 600;
            color: #343a40;
        }

        .assistant-header p {
            color: #6c757d;
        }

        /* Scrollbar Styling */
        #chat-container::-webkit-scrollbar {
            width: 8px;
        }

        #chat-container::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 10px;
        }
    </style>

{{--    <div class="assistant-header">--}}
{{--        <img src="https://media4.giphy.com/media/v1.Y2lkPTc5MGI3NjExamkyY3pxcnh0cDhhbjc3ZmVvcGVyemd6aTBlM3J3amdrbHZ0OWgwaSZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/uSbkiCah4v38Wabk6L/giphy.gif"--}}
{{--             alt="AI Assistant Animation"--}}
{{--             class="rounded-circle shadow"--}}
{{--             width="150">--}}
{{--        <h1>🤖 Meet Your AI Assistant</h1>--}}
{{--        <p>Ask me anything — I’m here to help!</p>--}}
{{--    </div>--}}

    <div class="text-center" style="margin-top: 120px; margin-bottom: 20px" >
        <img src="https://media1.giphy.com/media/v1.Y2lkPTc5MGI3NjExcnBjdHBhaGs2OWFhYWZhNzIyMDZpdWJ3Z2x1b2QwcHhoMGoxN2RpZyZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/Bd53AmNhJUNKEtVShQ/giphy.gif"
             alt="AI Assistant Animation"
             class="rounded-circle shadow"
             width="150">
        <h2 class="mt-3">Hi! I'm your AI Assistant 🤖</h2>
    </div>

    <div id="chat-container" class="shadow-sm d-none"></div>

    <div id="chat-input-container" class="d-flex align-items-center">
        <textarea id="chat-input" placeholder="Type your message..." rows="1" class="form-control me-2"></textarea>
        <button id="send-button" class="btn">
            <svg width="28" height="28" viewBox="0 0 32 32" fill="none"
                 xmlns="http://www.w3.org/2000/svg" class="icon-2xl">
                <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M15.1918 8.90615C15.6381 8.45983 16.3618 8.45983 16.8081 8.90615L21.9509 14.049C22.3972 14.4953 22.3972 15.2189 21.9509 15.6652C21.5046 16.1116 20.781 16.1116 20.3347 15.6652L17.1428 12.4734V22.2857C17.1428 22.9169 16.6311 23.4286 15.9999 23.4286C15.3688 23.4286 14.8571 22.9169 14.8571 22.2857V12.4734L11.6652 15.6652C11.2189 16.1116 10.4953 16.1116 10.049 15.6652C9.60265 15.2189 9.60265 14.4953 10.049 14.049L15.1918 8.90615Z"
                      fill="currentColor"></path>
            </svg>
        </button>
    </div>

    <script>
        const chatContainer = document.getElementById('chat-container');
        const chatInput = document.getElementById('chat-input');
        const sendButton = document.getElementById('send-button');

        const appendMessage = (message, sender) => {
            const messageDiv = document.createElement('div');
            messageDiv.classList.add('chat-message', sender);
            const bubbleDiv = document.createElement('div');
            bubbleDiv.classList.add('chat-bubble', sender);
            bubbleDiv.textContent = message;
            messageDiv.appendChild(bubbleDiv);
            chatContainer.appendChild(messageDiv);
            chatContainer.scrollTop = chatContainer.scrollHeight;
        };

        const sendMessage = async () => {

            $('#chat-container').removeClass('d-none');
            const userMessage = chatInput.value.trim();
            if (!userMessage) return;

            appendMessage(userMessage, 'user');
            chatInput.value = '';

            try {
                const response = await axios.post('/chat', { prompt: userMessage });
                const botMessage = response.data.message || 'I’m not sure how to respond to that yet!';
                appendMessage(botMessage, 'bot');
            } catch (error) {
                appendMessage('⚠️ Connection error. Please try again.', 'bot');
                console.error(error);
            }
        };

        sendButton.addEventListener('click', sendMessage);
        chatInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendMessage();
            }
        });
    </script>
@endsection
