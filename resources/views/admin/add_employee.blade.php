<x-admin-layout>
    <div class="mt-12">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="font-bold tracking-wider">
                スタッフ登録
            </h2>

            <div class="mt-2">
                <form method="POST" action="{{ route('admin.employees.store') }}">
                    @csrf
                    <div>
                        <label for="name">氏名</label>
                        <input type="text" id="name" name="name" placeholder="山田 太郎">
                    </div>
                    <div>
                        <label for="email">メールアドレス</label>
                        <input type="email" id="email" name="email" placeholder="test@test.com">
                    </div>
                    <div>
                        <label for="skills">スキル</label>
                        <input type="text" id="skills" name="skills" placeholder="1">
                    </div>
                    <div>
                        <input type="submit" value="追加する" class="p-3 bg-my-main-color text-sm text-white rounded font-bold">
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
