<x-admin-layout>
    <form id="shiftForm" method="POST" action="{{ route('admin.shift.store') }}">
        @csrf
        <div class="pt-8">
            <div class="max-full mx-auto px-2">
                @include('admin.shift.partials.calendar')
            </div>
        </div>

        <div>
            @include('admin.shift.partials.modal')
        </div>

        <div class="h-24"></div>

        <div class="shadow-custom bg-white flex justify-end w-full fixed -bottom-0 -right-0 py-4 pr-6 font-bold text-sm">
            <input type="button" id="shiftDetermine" onclick="sendFormDataAsJSONAsync()" class="bg-admin-main-color text-white px-4 py-3 rounded cursor-pointer" value="下書きを確定する">
        </div>
    </form>

    <script>
        // Form DataをJSON形式にしてバックエンドへ送信する関数
        function sendFormDataAsJSONAsync() {
            console.log('sendFormDataAsJSONAsync関数が呼ばれました。')
            // エンドポイントURLの取得
            const url = '{{ route('admin.shift.store') }}';
            // CSRFトークンをmetaタグから取得
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            // フォームデータを収集
            const form = document.getElementById("shiftForm");
            const formData = new FormData(form);
            const data = Object.fromEntries(formData.entries());

            // ネストされた構造の生成関数->外だしOK
            function setDeepValue(obj, path, value) {
            const keys = path.match(/[^\[\]]+/g); // キーを分割
            let lastKey = keys.pop();
            let deepObj = obj;

            keys.forEach((key, i) => {
                if (!deepObj[key]) {
                deepObj[key] = isNaN(Number(keys[i + 1])) ? {} : [];
                }
                deepObj = deepObj[key];
            });

            deepObj[lastKey] = value;
            }

            const processedData = {};

            for (const [key, value] of Object.entries(data)) {
                setDeepValue(processedData, key, value);
            }

            const body = {
                data: processedData  // JSON文字列として送信
            };

            axios
            .post(url, body, {
                headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken
                }
            })
            .then((response) => {
                console.log("Success:", response.data);
                window.removeEventListener('beforeunload', leavePageConfirm)
                window.location.reload();
            })
            .catch((error) => {
                console.error("Error:", error.message);
            });
            return false;
        };

        // ページの読み込みを許可するか確認するポップアウトを表示
        const leavePageConfirm = function(event) {
            var storeOptions = calendar.querySelectorAll(".store_option");
            for (var i = 0; i < storeOptions.length; i++) {
                if (storeOptions[i].value == "1" || storeOptions[i].value == "2") {
                    event.preventDefault();
                    break;
                }
            }
        }

        window.addEventListener('beforeunload', leavePageConfirm);

    </script>

</x-admin-layout>
