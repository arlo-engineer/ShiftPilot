<x-admin-layout>
    <div class="mt-12">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="font-bold tracking-wider">
                スタッフ情報
            </h2>

            <div class="mt-2">
                <form method="POST" action="{{ route('admin.employees.update', ['id' => $employee->companyMembership->id]) }}">
                    @csrf
                    <div>
                        <label for="name">氏名</label>
                        @if ($errors->has('name'))
                            @foreach ($errors->get('name') as $message)
                            {{ $message }}<br>
                            @endforeach
                        @endif
                        <input type="text" id="name" name="name" value="{{ $employee->name }}">
                    </div>
                    <div>
                        <label for="email">メールアドレス</label>
                        <input type="email" id="email" name="email" value="{{ $employee->email }}">
                    </div>

                    <div class="flex">
                        <div class="flex items-center me-4">
                            <input id="inline-radio" type="radio" value="一人前" name="skills" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="inline-radio" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">1. 一人前</label>
                        </div>
                        <div class="flex items-center me-4">
                            <input id="inline-2-radio" type="radio" value="中堅" name="skills" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="inline-2-radio" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">2. 中堅</label>
                        </div>
                        <div class="flex items-center me-4">
                            <input checked id="inline-checked-radio" type="radio" value="新米" name="skills" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="inline-checked-radio" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">3. 新米</label>
                        </div>
                    </div>

                    <a href="" class="text-sm text-my-main-color">スタッフを退職させる</a>
                    <div>
                        <input type="submit" value="保存する" class="cursor-pointer p-3 bg-my-main-color text-sm text-white rounded font-bold">
                    </div>
                    <div class="mt-5">
                        <a href="{{ route('admin.employees.index') }}" class="cursor-pointer p-3 text-sm rounded border">キャンセル</a>
                    </div>

                </form>
                @if ($errors->any())
                    <div>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-admin-layout>
