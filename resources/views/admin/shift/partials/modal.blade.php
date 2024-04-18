<!-- Modal container -->
<div id="modal" class="fixed top-0 left-0 w-full h-full bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
    <!-- Modal content -->
    <div class="bg-white rounded-lg p-8">
        <h1 id="modal-date" class="text-2xl font-bold mb-4">日付</h1>
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="mt-2">
                <label for="modal-start-time">出勤時間</label>
                {{-- カレンダー表示へのoutput側 --}}
                <input type="text" id="modal-start-time" class="input-start-time" value="">
                <br>
                <label for="modal-end-time">退勤時間</label>
                {{-- カレンダー表示へのoutput側 --}}
                <input type="text" id="modal-end-time" class="input-end-time" value="">
            </div>
        </div>
        <div class="px-4 py-3 sm:px-6 sm:flex sm:flex-row">
            <button id="tmpRegister" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700">
                仮登録
            </button>
            <button id="modalCancel" type="button" class="hidden mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700">
                キャンセル
            </button>
            <button id="modalClose" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700">
                閉じる
            </button>
        </div>
    </div>
</div>
