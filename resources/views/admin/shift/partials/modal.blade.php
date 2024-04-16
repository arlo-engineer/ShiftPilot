<div>
    <div id="modal" class="hidden fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                @foreach ($employees as $employee)
                    @php
                        // companyMembershipが空でないデータを抽出する
                        $nonEmptyCompanyMemberships = $shiftsWithMemberships->filter(function ($shift) {
                            return !empty($shift->companyMembership);
                        });

                        // 次月の1カ月間において、user_idを1に限定し、データを抽出する
                        $employeeId = $employee->id;
                        $desiredShifts = $nonEmptyCompanyMemberships->filter(function ($shift) use ($employeeId, $nextMonth) {
                            // user_idとemployeeIdが一致しているかをチェックし、work_dateが次月の場合のみを抽出
                            return $shift->companyMembership->user_id === $employeeId
                                && substr($shift->work_date, 0, 7) === $nextMonth;
                        });

                        // 存在する日付の配列を作成
                        $existingDates = $desiredShifts->pluck('work_date')->toArray();

                        // 存在しない日付の配列を生成
                        $missingDates = array_diff($nextMonthDatesArray, $existingDates);

                        // 日付の配列をマージしてソートする
                        $dates = array_merge($existingDates, $missingDates);
                        usort($dates, function ($a, $b) {
                            return strtotime($a) - strtotime($b);
                        });
                    @endphp

                    @foreach ($dates as $date)
                        <div id="modal-user-{{ $employee->id }}-date-{{ $date }}" class="modal-day hidden">
                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    日付: {{ $date }}
                                </h3>
                                <div class="mt-2">
                                    <input type="hidden" name="store_option[]" value="0">
                                    <input type="hidden" name="company_membership_id[]" value="{{ $employee->companyMembership->id }}">
                                    <input type="hidden" name="work_date[]" value="{{ $date }}">
                                    <label for="start-time-user-{{ $employee->id }}-date-{{ $date }}">出勤時間</label>
                                    {{-- カレンダー表示へのoutput側 --}}
                                    @php
                                        $start_time = $desiredShifts->firstWhere('work_date', $date)->start_time ?? '';
                                        $end_time = $desiredShifts->firstWhere('work_date', $date)->end_time ?? '';
                                    @endphp
                                    <input type="text" name="start_time[]" id="start-time-user-{{ $employee->id }}-date-{{ $date }}" class="input-start-time" value="{{ substr($start_time, 0, 5) }}">
                                    <br>
                                    <label for="end-time-user-{{ $employee->id }}-date-{{ $date }}">退勤時間</label>
                                    {{-- カレンダー表示へのoutput側 --}}
                                    <input type="text" name="end_time[]" id="end-time-user-{{ $employee->id }}-date-{{ $date }}" class="input-end-time" value="{{ substr($end_time, 0, 5) }}">
                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row">
                                <button id="tmpRegister" type="button" class="tmpRegister mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700">
                                    仮登録
                                </button>
                                <button id="modalClose" type="button" class="modalClose mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700">
                                    閉じる
                                </button>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>

        </div>
    </div>
</div>
