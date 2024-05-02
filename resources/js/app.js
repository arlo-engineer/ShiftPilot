import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

let navButtonElement = document.getElementById("navButton");
let nameColumnElements = document.getElementsByClassName("nameColumn");

// ハンバーガーメニューを開いたときにカレンダーの名前カラムが表に表示されないようにする
navButtonElement.addEventListener("click", function() {
    for (var i = 0; i < nameColumnElements.length; i++) {
        nameColumnElements[i].classList.toggle("sticky");
    }
})

// Y-m-d形式の年月日をY年m月n日と変換する関数
function formatDate(dateString) {
    const dateParts = dateString.split('-');
    const year = dateParts[0];
    const month = dateParts[1];
    const day = dateParts[2];

    // 月の数字から月の名前に変換するための配列
    const monthNames = [
        "1月", "2月", "3月", "4月", "5月", "6月",
        "7月", "8月", "9月", "10月", "11月", "12月"
    ];

    // 日付をフォーマットして返す
    return year + "年" + monthNames[parseInt(month) - 1] + day + "日";
}

// シフト作成ページ用
let clickedElement;
let clickedClass;
let modalClass
if (document.getElementById("modal")) {
    modalClass = document.getElementById("modal").classList;
}

// カレンダーのセルをクリックしたときにモーダルを表示する
if (document.getElementById("calendar-contents")) {
    document.getElementById("calendar-contents").addEventListener("click", function(event) {
        clickedElement = event.target;
        clickedClass = clickedElement.className;
        if (clickedClass.includes("calendar-cell-day")) {
            // モーダルの仮登録ボタンとキャンセルボタンの切り替え
            if (clickedClass.includes("tmp-register")) {
                // キャンセルボタンの表示
                document.getElementById("tmpRegister").classList.add("hidden");
                document.getElementById("tmpRegisterCancel").classList.remove("hidden");
                document.getElementById("registerCancel").classList.add("hidden");
            } else if (clickedClass.includes("register")) {
                // キャンセルボタンの表示
                document.getElementById("tmpRegister").classList.add("hidden");
                document.getElementById("tmpRegisterCancel").classList.add("hidden");
                document.getElementById("registerCancel").classList.remove("hidden");
            } else {
                // 仮登録ボタンの表示
                document.getElementById("tmpRegister").classList.remove("hidden");
                document.getElementById("tmpRegisterCancel").classList.add("hidden");
                document.getElementById("registerCancel").classList.add("hidden");
            }
            // モーダルを表示する＝hiddenを削除
            modalClass.remove("hidden");
            // モーダルに勤務日を表示
            var calendarWorkDate = clickedElement.querySelector(".work-date").value;
            var formatCalendarWorkDate = formatDate(calendarWorkDate);
            document.getElementById("modal-date").innerHTML = formatCalendarWorkDate;

            if (clickedElement.querySelector(".start-time") && clickedElement.querySelector(".end-time")) {
                // モーダルに出勤時間を表示
                var calendarStartTime = clickedElement.querySelector(".start-time").innerHTML;
                document.getElementById("modal-start-time").value = calendarStartTime;
                // モーダルに退勤時間を表示
                var calendarEndTime = clickedElement.querySelector(".end-time").innerHTML;
                document.getElementById("modal-end-time").value = calendarEndTime;
            }

            // モーダル上の出退勤時間が未入力の時、仮登録ボタンをクリックできないようにする
            if (document.getElementById("modal-start-time").value == "" || document.getElementById("modal-end-time").value == "") {
                document.getElementById("tmpRegister").classList.add("opacity-40", "pointer-events-none");
            } else {
                document.getElementById("tmpRegister").classList.remove("opacity-40", "pointer-events-none");
            }
        }
    });

    // モーダル上の出退勤時間が未入力の時、仮登録ボタンをクリックできないようにする
    document.getElementById("modal-start-time").addEventListener("change",function(){
        if (document.getElementById("modal-start-time").value == "" || document.getElementById("modal-end-time").value == "") {
            document.getElementById("tmpRegister").classList.add("opacity-40", "pointer-events-none");
        } else {
            document.getElementById("tmpRegister").classList.remove("opacity-40", "pointer-events-none");
        }
    });
    document.getElementById("modal-end-time").addEventListener("change",function(){
        if (document.getElementById("modal-start-time").value == "" || document.getElementById("modal-end-time").value == "") {
            document.getElementById("tmpRegister").classList.add("opacity-40", "pointer-events-none");
        } else {
            document.getElementById("tmpRegister").classList.remove("opacity-40", "pointer-events-none");
        }
    });

    // モーダルの閉じるボタン
    document.getElementById("modalClose").addEventListener("click", function() {
        modalClass.add("hidden");
        document.getElementById("modal-start-time").value = "";
        document.getElementById("modal-end-time").value = "";
    });

    // モーダル外をクリックした時にモーダルを閉じる
    document.getElementById("modal").addEventListener("click", function(event) {
        if (event.target.closest("#modal-content") === null) {
            modalClass.add("hidden");
            document.getElementById("modal-start-time").value = "";
            document.getElementById("modal-end-time").value = "";
        }
    });

    // モーダルの仮登録ボタン
    document.getElementById("tmpRegister").addEventListener("click", function() {
        // モーダルを閉じる
        modalClass.add("hidden");

        // store_optionを1に変更する->DBに登録できるようにする
        clickedElement.querySelector(".store_option").value = 1;
        clickedElement.classList.add("tmp-register");

        // カレンダーに出勤時間を反映
        var modalStartTime = document.getElementById("modal-start-time").value;
        clickedElement.querySelector(".input-start-time").value = modalStartTime;

        // カレンダーに退勤時間を反映
        var modalEndTime = document.getElementById("modal-end-time").value;
        clickedElement.querySelector(".input-end-time").value = modalEndTime;

        // 仮登録した出退勤時間をカレンダーに表示
        clickedElement.querySelector(".tmp-shift").classList.remove("invisible", "hidden");

        // モーダル内の出退勤時間を空にする
        document.getElementById("modal-start-time").value = "";
        document.getElementById("modal-end-time").value = "";

        if (clickedElement.querySelector(".created-shift")) {
            clickedElement.querySelector(".created-shift").classList.add("hidden");
        }
    });

    // モーダルの仮登録キャンセルボタン
    document.getElementById("tmpRegisterCancel").addEventListener("click", function() {
        // モーダルを閉じる
        modalClass.add("hidden");
        // store_optionを0に変更する->DBに登録されないようにする
        clickedElement.querySelector(".store_option").value = 0;
        clickedElement.classList.remove("tmp-register");
        // カレンダーから仮登録時間を削除/隠す
        clickedElement.querySelector(".tmp-shift").classList.add("invisible");
    });

    // モーダルの登録キャンセルボタン
    document.getElementById("registerCancel").addEventListener("click", function() {
        // モーダルを閉じる
        modalClass.add("hidden");
        // store_optionを2に変更する->DBから削除されるようにする
        clickedElement.querySelector(".store_option").value = 2;
        clickedElement.classList.remove("register");
        // カレンダーから仮登録時間を削除/隠す
        clickedElement.querySelector(".created-shift").classList.add("invisible");
    });
}


// シフト提出ページ用
// カレンダーのセルをクリックしたときにモーダルを表示する
if (document.getElementById("required-shift-contents")) {
    document.getElementById("required-shift-contents").addEventListener("click", function(event) {
        clickedElement = event.target;
        clickedClass = clickedElement.className;
        if (clickedClass.includes("required-shift-cell")) {
            // モーダルの仮登録ボタンとキャンセルボタンの切り替え
            if (clickedClass.includes("tmp-register")) {
                // キャンセルボタンの表示
                document.getElementById("tmpRegister").classList.add("hidden");
                document.getElementById("tmpRegisterCancel").classList.remove("hidden");
                document.getElementById("registerCancel").classList.add("hidden");
            } else if (clickedClass.includes("register")) {
                // キャンセルボタンの表示
                document.getElementById("tmpRegister").classList.add("hidden");
                document.getElementById("tmpRegisterCancel").classList.add("hidden");
                document.getElementById("registerCancel").classList.remove("hidden");
            } else {
                // 仮登録ボタンの表示
                document.getElementById("tmpRegister").classList.remove("hidden");
                document.getElementById("tmpRegisterCancel").classList.add("hidden");
                document.getElementById("registerCancel").classList.add("hidden");
            }
            // モーダルを表示する＝hiddenを削除
            modalClass.remove("hidden");

            // モーダルに勤務日を表示
            var calendarWorkDate = clickedElement.querySelector(".work-date").value;
            var formatCalendarWorkDate = formatDate(calendarWorkDate);
            document.getElementById("modal-date").innerHTML = formatCalendarWorkDate;

            if (clickedElement.querySelector(".input-start-time") && clickedElement.querySelector(".input-end-time")) {
                // モーダルに出勤時間を表示
                var calendarStartTime = clickedElement.querySelector(".input-start-time").value;
                document.getElementById("modal-start-time").value = calendarStartTime;
                // モーダルに退勤時間を表示
                var calendarEndTime = clickedElement.querySelector(".input-end-time").value;
                document.getElementById("modal-end-time").value = calendarEndTime;
            }

            // モーダル上の出退勤時間が未入力の時、仮登録ボタンをクリックできないようにする
            if (document.getElementById("modal-start-time").value == "" || document.getElementById("modal-end-time").value == "") {
                document.getElementById("tmpRegister").classList.add("opacity-40", "pointer-events-none");
            } else {
                document.getElementById("tmpRegister").classList.remove("opacity-40", "pointer-events-none");
            }
        }
    });

    // モーダル上の出退勤時間が未入力の時、仮登録ボタンをクリックできないようにする
    document.getElementById("modal-start-time").addEventListener("change",function(){
        if (document.getElementById("modal-start-time").value == "" || document.getElementById("modal-end-time").value == "") {
            document.getElementById("tmpRegister").classList.add("opacity-40", "pointer-events-none");
        } else {
            document.getElementById("tmpRegister").classList.remove("opacity-40", "pointer-events-none");
        }
    });
    document.getElementById("modal-end-time").addEventListener("change",function(){
        if (document.getElementById("modal-start-time").value == "" || document.getElementById("modal-end-time").value == "") {
            document.getElementById("tmpRegister").classList.add("opacity-40", "pointer-events-none");
        } else {
            document.getElementById("tmpRegister").classList.remove("opacity-40", "pointer-events-none");
        }
    });

    // モーダルの閉じるボタン
    document.getElementById("modalClose").addEventListener("click", function() {
        modalClass.add("hidden");
        document.getElementById("modal-start-time").value = "";
        document.getElementById("modal-end-time").value = "";
    });

    // モーダル外をクリックした時にモーダルを閉じる
    document.getElementById("modal").addEventListener("click", function(event) {
        if (event.target.closest("#modal-content") === null) {
            modalClass.add("hidden");
            document.getElementById("modal-start-time").value = "";
            document.getElementById("modal-end-time").value = "";
        }
    });

    // モーダルの仮登録ボタン
    document.getElementById("tmpRegister").addEventListener("click", function() {
        // モーダルを閉じる
        modalClass.add("hidden");

        // store_optionを1に変更する->DBに登録できるようにする
        clickedElement.querySelector(".store_option").value = 1;
        clickedElement.classList.add("tmp-register", "bg-stripe");
        clickedElement.querySelector(".input-start-time").classList.add("bg-transparent");

        // カレンダーに出勤時間を反映
        var modalStartTime = document.getElementById("modal-start-time").value;
        clickedElement.querySelector(".input-start-time").value = modalStartTime;

        // カレンダーに退勤時間を反映
        var modalEndTime = document.getElementById("modal-end-time").value;
        clickedElement.querySelector(".input-end-time").value = modalEndTime;

        // 仮登録した出退勤時間をカレンダーに表示
        clickedElement.querySelector(".tmp-shift").classList.remove("invisible");

        // モーダル内の出退勤時間を空にする
        document.getElementById("modal-start-time").value = "";
        document.getElementById("modal-end-time").value = "";
    });

    // モーダルの仮登録キャンセルボタン
    document.getElementById("tmpRegisterCancel").addEventListener("click", function() {
        // モーダルを閉じる
        modalClass.add("hidden");
        // store_optionを0に変更する->DBに登録されないようにする
        clickedElement.querySelector(".store_option").value = 0;
        clickedElement.classList.remove("tmp-register", "bg-stripe");
        // カレンダーから仮登録時間を削除/隠す
        clickedElement.querySelector(".tmp-shift").classList.add("invisible");
        // モーダル内の出退勤時間を空にする
        clickedElement.querySelector(".input-start-time").value = ""; // 設定で値を変更する？(要検討)
        clickedElement.querySelector(".input-end-time").value = ""; // 設定で値を変更する？(要検討)
    });

    // モーダルの登録キャンセルボタン
    document.getElementById("registerCancel").addEventListener("click", function() {
        // モーダルを閉じる
        modalClass.add("hidden");
        // store_optionを2に変更する->DBから削除されるようにする
        clickedElement.querySelector(".store_option").value = 2;
        clickedElement.classList.remove("register", "bg-my-accent-color-lighter");
        // カレンダーから出退勤時間を削除する
        clickedElement.querySelector(".input-start-time").value = "";
        clickedElement.querySelector(".input-end-time").value = "";
        // カレンダーから仮登録時間を削除/隠す
        clickedElement.querySelector(".required-shift").classList.add("invisible", "tmp-shift");
        clickedElement.querySelector(".required-shift").classList.remove("required-shift");
        // カレンダーセルの背景色を白にする
        // clickedClass.remove('bg-my-accent-color-lighter');
        clickedElement.classList.add('bg-white');
    });
}

