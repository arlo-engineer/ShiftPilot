import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// // モーダルを開く->実装できたが、クリックすると背景は黒くなるが、モーダルは表示されないことがある。(改善予定)
// // idが"calendar"のテーブル要素を取得
// var calendar = document.getElementById('calendar');

// // idが"modal"の要素を取得
// var modal = document.getElementById('modal');

// // クリックイベントリスナーを追加
// calendar.addEventListener('click', function(event) {
//     // クリックされた要素のクラス名を取得し、スペースで分割
//     var clickedClass = event.target.className.split(' ');

//     // クリックされた要素の最初のクラス名を取得
//     var firstClickedClass = clickedClass[0];

//     // id="modal"内で、クリックされた要素のクラス名と同じidを持つ要素を取得
//     var modalElement = modal.querySelector('#' + firstClickedClass);

//     // クリックされた要素のクラス名と同じidを持つ要素が存在する場合にmodalを表示
//     if (modalElement) {
//         // "hidden"クラスを削除
//         modalElement.classList.remove('hidden');
//         modal.classList.remove('hidden');
//     }
// });

// // モーダルを閉じるまたは出退勤時間を仮登録
// // クリックイベントリスナーを追加
// modal.addEventListener('click', function(event) {
//     // クリックされた要素を取得
//     var clickedElement = event.target;
//     if (clickedElement.id == 'modalClose') {
//         // id="modal"の要素にclass="hidden"を付与
//         modal.classList.add('hidden');

//         // クリックされた要素の親要素の要素を取得
//         var parentElement = clickedElement.parentNode.parentNode;

//         // 親要素にclass="hidden"を付与
//         parentElement.classList.add('hidden');

//     } else if (clickedElement.id == 'tmpRegister') {
//         // id="modal"の要素にclass="hidden"を付与
//         modal.classList.add('hidden');

//         // クリックされた要素の親要素の要素を取得
//         var parentElement = clickedElement.parentNode.parentNode;

//         // 親要素の中からname="store_option[]"を持つinput要素を取得
//         var storeInput = parentElement.querySelector('input[name="store_option[]"]');

//         // input要素が存在するかを確認
//         if (storeInput) {
//             // valueを1に変更
//             storeInput.value = 1;
//         }

//         // 親要素にclass="hidden"を付与
//         parentElement.classList.add('hidden');

//         // クリックされた要素の親要素のid名を取得
//         var parentElementId = parentElement.id;

//         // .calendar-cell クラスを持つ要素を取得
//         var calendarElements = document.querySelectorAll('.calendar-cell');

//         // 各要素に対して処理
//         calendarElements.forEach(function(element) {
//             // クラスリストからクラス名の配列を取得
//             var classNames = element.classList;

//             if (classNames.contains(parentElementId)) {
//                 classNames.add('tmp-register');
//             }
//         });
//     }
// });

// // calendar表示の変更
// // ページが読み込まれた時のcalendarの表示
// window.addEventListener('DOMContentLoaded', function(){
//     // input-start-timeグループで指定
//     const inputBox = document.querySelectorAll('.input-start-time');
//     // console.log(inputBox[0]);

//     // for分で要素数分ループ処理
//     for (let i = 0; i < inputBox.length; i++) {
//         var inputBoxId = inputBox[i].id;
//         var inputBoxElement = modal.querySelector('#' + inputBoxId);

//         // id="modal"内で、クリックされた要素のid名とクラス名を持つ要素を取得
//         var calendarElement = calendar.querySelector('.' + inputBoxId);
//         calendarElement.innerHTML = inputBoxElement.value;
//         // console.log(inputBoxElement.value);
//     }
// });

// // ページが読み込まれた時のcalendarの表示
// window.addEventListener('DOMContentLoaded', function(){
//     // input-start-timeグループで指定
//     const inputBox = document.querySelectorAll('.input-end-time');
//     // console.log(inputBox[0]);

//     // for分で要素数分ループ処理
//     for (let i = 0; i < inputBox.length; i++) {
//         var inputBoxId = inputBox[i].id;
//         var inputBoxElement = modal.querySelector('#' + inputBoxId);

//         // id="modal"内で、クリックされた要素のid名とクラス名を持つ要素を取得
//         var calendarElement = calendar.querySelector('.' + inputBoxId);
//         calendarElement.innerHTML = inputBoxElement.value;
//     }
// });

// // start_timeの入力が変更された時のcalendar表示の変更
// modal.addEventListener("input", function() {
//     // input-start-timeグループで指定
//     const inputBox = document.querySelectorAll('.input-start-time');

//     // for分で要素数分ループ処理
//     for (let i = 0; i < inputBox.length; i++) {
//         var inputBoxId = inputBox[i].id;
//         var inputBoxElement = modal.querySelector('#' + inputBoxId);

//         // id="modal"内で、クリックされた要素のid名とクラス名を持つ要素を取得
//         var calendarElement = calendar.querySelector('.' + inputBoxId);
//         calendarElement.innerHTML = inputBoxElement.value;
//     }
// });

// // end_timeの入力が変更された時のcalendar表示の変更
// modal.addEventListener("input", function() {
//     // input-start-timeグループで指定
//     const inputBox = document.querySelectorAll('.input-end-time');

//     // for分で要素数分ループ処理
//     for (let i = 0; i < inputBox.length; i++) {
//         var inputBoxId = inputBox[i].id;
//         var inputBoxElement = modal.querySelector('#' + inputBoxId);

//         // id="modal"内で、クリックされた要素のid名とクラス名を持つ要素を取得
//         var calendarElement = calendar.querySelector('.' + inputBoxId);
//         calendarElement.innerHTML = inputBoxElement.value;
//     }
// });
