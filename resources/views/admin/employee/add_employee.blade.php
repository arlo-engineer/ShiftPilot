<x-admin-layout>
    <div class="mt-5">
        <div class="max-w-5xl mx-auto px-6">
            <div>
                <a href="{{ route('admin.employees.index') }}" class="flex">
                    <img src="{{ asset('img/calendar-left-arrow.png') }}" alt="" class="w-3.5">
                    <p class="text-sm text-my-main-color pl-1">戻る</p>
                </a>
            </div>
            <h2 class="font-bold tracking-wider mt-8">
                スタッフ情報
            </h2>

            <div class="mt-2 text-sm">
                <form method="POST" action="{{ route('admin.employees.store') }}">
                    @csrf
                    <div class="border-t py-4 flex items-center">
                        <div class="w-40">
                            <label for="name" class="font-bold">氏名</label>
                            <span class="text-white bg-my-accent-color text-xs rounded px-2 py-1 font-bold ml-2">必須</span>
                        </div>
                        <div class="sm:w-2/5 w-full text-sm">
                            <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="" class="border-gray-300 rounded w-full">
                        </div>
                    </div>
                    <div class="border-t py-4 flex items-center">
                        <div class="w-40">
                            <label for="email" class="font-bold">メールアドレス</label>
                            <span class="text-white bg-my-accent-color text-xs rounded px-2 py-1 font-bold ml-2">必須</span>
                        </div>
                        <div class="sm:w-2/5 w-full text-sm">
                            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="" class="border-gray-300 rounded w-full">
                        </div>
                    </div>

                    <div class="border-t py-4 flex items-center">
                        <div class="w-40"><label class="font-bold">スキル</label></div>
                        <div class="flex items-center me-4">
                            <input id="inline-radio" type="radio" value="一人前" name="skills" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="inline-radio" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">一人前</label>
                        </div>
                        <div class="flex items-center me-4">
                            <input id="inline-2-radio" type="radio" value="中堅" name="skills" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="inline-2-radio" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">中堅</label>
                        </div>
                        <div class="flex items-center me-4">
                            <input checked id="inline-checked-radio" type="radio" value="新米" name="skills" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="inline-checked-radio" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">新米</label>
                        </div>
                    </div>

                    <div class="border-t py-4 border-b flex items-top">
                        <div class="w-40"><label for="remarks" class="font-bold">メモ</label></div>
                        <textarea id="remarks" name="remarks" class="text-sm border-gray-300 rounded w-2/5 h-36 resize-none"></textarea>
                    </div>

                    <div>
                        <input type="submit" value="追加する" class="p-3 bg-my-main-color text-sm text-white rounded font-bold cursor-pointer mt-5">
                    </div>

                    @if ($errors->any())
                        <div id="validateError" class="pt-5 text-my-accent-color">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="validateError">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
