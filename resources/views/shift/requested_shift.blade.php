<x-app-layout>
    <form method="POST" action="{{ route('submit-shift.store') }}">
        @csrf
        <div class="pt-8">
            <div class="max-w-5xl mx-auto px-2">
                @include('shift.partials.pagination')
                <div class="pt-6 w-full mx-auto text-my-text-color">
                    @include('shift.partials.calendar')
                </div>
            </div>
        </div>

        <div>
            @include('shift.partials.modal')
        </div>

        <div class="h-24"></div>

        <div class="shadow-custom bg-white flex justify-end w-full fixed -bottom-0 -right-0 py-4 pr-6 font-bold text-sm">
            <input type="submit" id="shiftDetermine" onclick="window.removeEventListener('beforeunload', leavePageConfirm);" class="bg-my-main-color text-white px-4 py-3 rounded" value="希望シフトを提出する">
        </div>
    </form>

    <script>
        // ページの読み込みを許可するかどうかを確認するポップアウトを表示する
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
</x-app-layout>
