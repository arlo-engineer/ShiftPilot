import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

let clickedElement;
let clickedClass;

// カレンダーのセルをクリックしたときにモーダルを表示する
document.getElementById('calendar-contents').addEventListener('click', function(event) {
    clickedElement = event.target;
    clickedClass = clickedElement.className;
    if (clickedClass.includes('calendar-cell-day')) {
        // モーダルを表示する＝hiddenを削除
        document.getElementById('modal').classList.remove('hidden');
        // モーダルに勤務日を表示
        var calendarWorkDate = clickedElement.querySelector('.work-date').value;
        document.getElementById('modal-date').innerHTML = calendarWorkDate;
        // モーダルに出勤時間を表示
        var calendarStartTime = clickedElement.querySelector('.start-time').value;
        document.getElementById('modal-start-time').value = calendarStartTime;
        // モーダルに退勤時間を表示
        var calendarEndTime = clickedElement.querySelector('.end-time').value;
        document.getElementById('modal-end-time').value = calendarEndTime;
    }
});

// モーダルの閉じるボタンの実装
document.getElementById('modalClose').addEventListener('click', function() {
    document.getElementById('modal').classList.add('hidden');
});

// モーダルの仮登録ボタンの実装
document.getElementById('tmpRegister').addEventListener('click', function() {
    console.log(clickedElement);
    // モーダルを閉じる
    document.getElementById('modal').classList.add('hidden');
    // store_optionを1に変更する->DBに登録できるようにする
    clickedElement.querySelector('.store_option').value = 1;
    clickedElement.classList.add('tmp-register');
    // カレンダーに出勤時間を反映
    var modalStartTime = document.getElementById('modal-start-time').value;
    clickedElement.querySelector('.start-time').value = modalStartTime;
    // カレンダーに退勤時間を反映
    var modalEndTime = document.getElementById('modal-end-time').value;
    clickedElement.querySelector('.end-time').value = modalEndTime;
});
