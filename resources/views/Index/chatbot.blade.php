<button id="chatbot-toggler" class="fixed bottom-5 right-5 p-2 bg-blue-500 text-white rounded-full shadow-lg z-50">
    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
        height="24" fill="none" viewBox="0 0 24 24">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M14.079 6.839a3 3 0 0 0-4.255.1M13 20h1.083A3.916 3.916 0 0 0 18 16.083V9A6 6 0 1 0 6 9v7m7 4v-1a1 1 0 0 0-1-1h-1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1Zm-7-4v-6H5a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h1Zm12-6h1a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2h-1v-6Z" />
    </svg>
</button>

<!-- Chatbox -->
<div id="chatbot"
    class="fixed bottom-16 right-5 w-96 shadow-lg rounded-lg opacity-0 pointer-events-none scale-50 transition-all transform origin-bottom-right z-40">
    <div class="flex justify-between items-center bg-gray-200 dark:bg-gray-700 p-3 rounded-t-lg">
        <h3 class="text-white font-semibold">Chatbot</h3>
        <button id="close-btn" class="text-white font-bold">x</button>
    </div>
    <div id="chatWindow" class="chatbox flex flex-col gap-4 p-4 h-80 overflow-y-auto no-scrollbar bg-gray-300 dark:bg-gray-800">
        <div class="flex gap-1">
            <div class="w-8 h-8 object-cover rounded-full">
                <svg class="size-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M14.079 6.839a3 3 0 0 0-4.255.1M13 20h1.083A3.916 3.916 0 0 0 18 16.083V9A6 6 0 1 0 6 9v7m7 4v-1a1 1 0 0 0-1-1h-1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1Zm-7-4v-6H5a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h1Zm12-6h1a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2h-1v-6Z" />
                </svg>
            </div>
            <div
                class="flex flex-col leading-3 max-w-36 p-2 border-gray-200 bg-gray-200 rounded dark:bg-gray-700">
                
                <p class="text-sm flex font-normal py-2.5 text-gray-900 dark:text-white leading-normal">
                    Hola sere tu asistente, pregunta cualquier cosa</p>
            </div>
        </div>
    </div>
    <div class="flex items-center px-3 py-2 gap-2  bg-gray-200 dark:bg-gray-700">
        <input id="chat-input"
            class="block p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Escribe tu mensaje..."></input>
        <button id="send-btn"
            class="inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100 dark:text-blue-500 dark:hover:bg-gray-600 hidden">
            <svg class="w-5 h-5 rotate-90 rtl:-rotate-90" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 18 20">
                <path
                    d="m17.914 18.594-8-18a1 1 0 0 0-1.828 0l-8 18a1 1 0 0 0 1.157 1.376L8 18.281V9a1 1 0 0 1 2 0v9.281l6.758 1.689a1 1 0 0 0 1.156-1.376Z" />
            </svg>
        </button>
    </div>
</div>
@vite('resources/js/chatbot.js')
