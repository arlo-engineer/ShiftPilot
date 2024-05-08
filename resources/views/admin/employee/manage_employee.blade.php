<x-admin-layout>
    <div class="mt-12">
        <div class="max-w-5xl mx-auto px-6">
            <h2 class="font-bold tracking-wider">
                スタッフ管理
            </h2>
            <p class="text-sm">合計: {{ count($employees) }}人</p>

            <div class="w-full mt-2 mx-auto overflow-auto text-my-text-color text-sm">
                <table class="w-full text-left whitespace-no-wrap border-separate border-spacing-0">
                    <thead>
                        <tr class="text-center">
                            <th class="sticky top-0 -left-0 px-4 py-3 bg-gray-100 border-t border-b border-gray-300 whitespace-nowrap">氏名</th>
                            <th class="sticky top-0 -left-0 px-4 py-3 bg-gray-100 border-t border-b border-gray-300 whitespace-nowrap">メールアドレス</th>
                            <th class="sticky top-0 -left-0 px-4 py-3 bg-gray-100 border-t border-b border-gray-300 whitespace-nowrap">スキル</th>
                            <th class="sticky top-0 -left-0 px-4 py-3 bg-gray-100 border-t border-b border-gray-300 sm:min-w-[300px]">メモ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                        <tr>
                            <td class="px-4 py-3 border-b border-gray-300 whitespace-nowrap"><a href="{{ route('admin.employees.edit', ['id'=>$employee->companyMembership->id]) }}" class="text-[#1558d6] hover:underline">{{ $employee->name }}</a></td>
                            <td class="px-4 py-3 border-b border-gray-300 whitespace-nowrap">{{ $employee->email }}</td>
                            <td class="px-4 py-3 border-b border-gray-300 whitespace-nowrap">{{ $employee->companyMembership->skills }}</td>
                            <td class="px-4 py-3 border-b border-gray-300 sm:min-w-[300px] sm:whitespace-normal whitespace-nowrap">{{ $employee->companyMembership->remarks }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="h-24"></div>

        <div class="shadow-custom bg-white flex justify-end w-full fixed -bottom-0 -left-0 py-7 pr-6 font-bold text-sm">
            <a href="{{ route('admin.employees.create') }}" class="text-admin-main-color">
                <p>スタッフを追加する</p>
            </a>
        </div>
    </div>
</x-admin-layout>
