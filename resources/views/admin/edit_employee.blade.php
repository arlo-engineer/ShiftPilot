<x-admin-layout>
    <div class="mt-12">
        <div class="max-w-5xl mx-auto px-6">
            <h2 class="font-bold tracking-wider mt-8">
                スタッフ情報
            </h2>

            <div class="mt-2">
                <form method="POST" action="{{ route('admin.employees.update', ['id' => $employee->companyMembership->id]) }}">
                    @csrf
                    <div class="border-t py-4 flex items-center">
                        <div class="w-36"><label for="name" class="font-bold">氏名</label></div>
                        <div class="sm:w-2/5 w-full text-sm">
                            <input type="text" id="name" name="name" value="{{ $employee->name }}" class="border-gray-300 rounded w-full pointer-events-none bg-gray-200">
                        </div>
                    </div>
                    <div class="border-t py-4 flex items-center">
                        <div class="w-36"><label for="email" class="font-bold">メールアドレス</label></div>
                        <div class="sm:w-2/5 w-full text-sm">
                            <input type="email" id="email" name="email" value="{{ $employee->email }}" class="border-gray-300 rounded w-full pointer-events-none bg-gray-200">
                        </div>
                    </div>

                    <div class="border-t py-4 flex items-center">
                        <div class="w-36"><label class="font-bold">スキル</label></div>
                        <div class="flex items-center me-4">
                            @if ($employee->companyMembership->skills == '一人前')
                            <input checked id="inline-radio" type="radio" value="一人前" name="skills" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            @else
                            <input id="inline-radio" type="radio" value="一人前" name="skills" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            @endif
                            <label for="inline-radio" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">一人前</label>
                        </div>
                        <div class="flex items-center me-4">
                            @if ($employee->companyMembership->skills == '中堅')
                            <input checked id="inline-2-radio" type="radio" value="中堅" name="skills" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            @else
                            <input id="inline-2-radio" type="radio" value="中堅" name="skills" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            @endif
                            <label for="inline-2-radio" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">中堅</label>
                        </div>
                        <div class="flex items-center me-4">
                            @if ($employee->companyMembership->skills == '新米')
                            <input checked id="inline-checked-radio" type="radio" value="新米" name="skills" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            @else
                            <input id="inline-checked-radio" type="radio" value="新米" name="skills" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            @endif
                            <label for="inline-checked-radio" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">新米</label>
                        </div>
                    </div>

                    <div class="border-t py-4 border-b flex items-top">
                        <div class="w-36"><label for="remarks" class="font-bold">メモ</label></div>
                        <textarea id="remarks" name="remarks" class="text-sm border-gray-300 rounded w-2/5 h-36 resize-none">{{ $employee->companyMembership->remarks }}</textarea>
                    </div>

                    <div class="flex flex-row-reverse items-center mt-5">
                            <div class="flex ml-auto">
                                <input type="submit" value="保存する" class="cursor-pointer p-3 bg-my-main-color text-sm text-white rounded font-bold">
                                <a href="{{ route('admin.employees.index') }}" class="ml-5 cursor-pointer p-3 text-sm rounded border">キャンセル</a>
                            </div>

                        </form>

                        <form method="POST" action="{{ route('admin.employees.destroy', ['id' => $employee->companyMembership->id]) }}">
                            @csrf
                            <input type="submit" value="スタッフを退職させる" class="text-sm text-my-main-color cursor-pointer flex justify-end">
                        </form>
                    </div>
            </div>
        </div>
    </div>
</x-admin-layout>
