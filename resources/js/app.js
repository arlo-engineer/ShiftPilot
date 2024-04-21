import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

let clickedElement;
let clickedClass;
let modalClass = document.getElementById('modal').classList;

// カレンダーのセルをクリックしたときにモーダルを表示する
document.getElementById('calendar-contents').addEventListener('click', function(event) {
    clickedElement = event.target;
    clickedClass = clickedElement.className;
    if (clickedClass.includes('calendar-cell-day')) {
        // モーダルの仮登録ボタンとキャンセルボタンの切り替え
        if (clickedClass.includes('tmp-register')) {
            // キャンセルボタンの表示
            document.getElementById('tmpRegister').classList.add('hidden');
            document.getElementById('modalCancel').classList.remove('hidden');
        } else {
            // 仮登録ボタンの表示
            document.getElementById('tmpRegister').classList.remove('hidden');
            document.getElementById('modalCancel').classList.add('hidden');
        }
        // モーダルを表示する＝hiddenを削除
        modalClass.remove('hidden');
        // モーダルに勤務日を表示
        var calendarWorkDate = clickedElement.querySelector('.work-date').value;
        document.getElementById('modal-date').innerHTML = calendarWorkDate;
        // モーダルに出勤時間を表示
        var calendarStartTime = clickedElement.querySelector('.start-time').innerHTML;
        console.log(clickedElement);
        console.log(clickedElement.querySelector('.start-time'));
        document.getElementById('modal-start-time').value = calendarStartTime;
        // モーダルに退勤時間を表示
        var calendarEndTime = clickedElement.querySelector('.end-time').innerHTML;
        document.getElementById('modal-end-time').value = calendarEndTime;
    }
});

// モーダルの閉じるボタン
document.getElementById('modalClose').addEventListener('click', function() {
    modalClass.add('hidden');
});

// モーダル外をクリックした時にモーダルを閉じる
document.getElementById('modal').addEventListener('click', function(event) {
    if (event.target.closest('#modal-content') === null) {
        modalClass.add('hidden');
    }
});

// モーダルの仮登録ボタン
document.getElementById('tmpRegister').addEventListener('click', function() {
    // モーダルを閉じる
    modalClass.add('hidden');

    // store_optionを1に変更する->DBに登録できるようにする
    clickedElement.querySelector('.store_option').value = 1;
    clickedElement.classList.add('tmp-register');

    // カレンダーに出勤時間を反映
    var modalStartTime = document.getElementById('modal-start-time').value;
    clickedElement.querySelector('.input-start-time').value = modalStartTime;

    // カレンダーに退勤時間を反映
    var modalEndTime = document.getElementById('modal-end-time').value;
    clickedElement.querySelector('.input-end-time').value = modalEndTime;

    // 仮登録した出退勤時間をカレンダーに表示
    clickedElement.querySelector('.input-time').classList.remove('invisible');
});

// モーダルのキャンセルボタン
document.getElementById('modalCancel').addEventListener('click', function() {
    // モーダルを閉じる
    modalClass.add('hidden');
    // store_optionを0に変更する->DBに登録されないようにする
    clickedElement.querySelector('.store_option').value = 0;
    clickedElement.classList.remove('tmp-register');
    // カレンダーから仮登録時間を削除/隠す
    clickedElement.querySelector('.input-time').classList.add('invisible');
});
