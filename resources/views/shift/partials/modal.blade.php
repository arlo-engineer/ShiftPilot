<!-- Modal container -->
<div id="modal" class="fixed top-0 left-0 w-full h-full bg-gray-800 bg-opacity-50 flex items-center justify-center z-20 hidden">
    <!-- Modal content -->
    <div id="modal-content" class="bg-white rounded-lg px-16 py-8">
        <h1 id="modal-date" class="text-2xl font-bold mb-4"></h1>
        <div class="bg-whit pt-5 pb-4 sm:pt-5 sm:pb-4">
            <div class="relative">
                <label for="modal-start-time" class="pr-2">出勤時間</label>
                <input type="time" id="modal-start-time" class="input-start-time bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="">
            </div>

            <div class="relative mt-4">
                <label for="modal-end-time" class="pr-2">退勤時間</label>
                <input type="time" id="modal-end-time" class="input-end-time bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="">
            </div>

            {{-- 備考欄は後ほど作成予定 --}}
            {{-- <div class="relative mt-4">
                <label for="modal-notes" class="pr-2">備考欄</label><br>
                <textarea name="notes" id="modal-notes" rows="5" class="resize-none bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
            </div> --}}
        </div>
        <div class="px-4 py-3 sm:px-6 sm:flex sm:flex-row">
            <button id="tmpRegister" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-user-main-color shadow-sm px-4 py-2 bg-user-main-color text-base text-white opacity-40 pointer-events-none">
                仮登録
            </button>
            <button id="tmpRegisterCancel" type="button" class="hidden mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base text-gray-700 whitespace-nowrap">
                キャンセル
            </button>
            <button id="registerCancel" type="button" class="hidden mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base text-gray-700 whitespace-nowrap">
                キャンセル
            </button>
            <button id="modalClose" type="button" class="mt-3 sm:ml-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base text-gray-700">
                閉じる
            </button>
        </div>
    </div>
</div>
