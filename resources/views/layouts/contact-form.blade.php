<h1 class="text-2xl font-bold mb-4">お問い合わせ</h1>
@if(session('success'))
    <div class="bg-green-500 text-white p-2 rounded mb-4">
        {{ session('success') }}
    </div>
@endif
<form action="{{ route('contact.store') }}" method="POST" class="space-y-4">
    @csrf
    <div>
        <label for="name" class="block text-sm font-medium text-gray-700 required">名前</label>
        <input type="text" id="name" name="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('name', auth()->user()->name ?? '') }}">
        @error('name')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>
    <div>
        <label for="email" class="block text-sm font-medium text-gray-700 required">メールアドレス</label>
        <input type="email" id="email" name="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('email', auth()->user()->email ?? '') }}">
        @error('email')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>
    <div>
        <label for="phone" class="block text-sm font-medium text-gray-700">電話番号</label>
        <input type="text" id="phone" name="phone" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('phone') }}" placeholder="000-0000-0000">
        @error('phone')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>
    <div>
        <label for="company" class="block text-sm font-medium text-gray-700">会社名</label>
        <input type="text" id="company" name="company" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('company', $companyName ?? '') }}">
        @error('company')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>
    <div>
        <label for="category" class="block text-sm font-medium text-gray-700 required">お問い合わせカテゴリ</label>
        <select id="category" name="category" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            <option value="">カテゴリを選択してください</option>
            <option value="一般的な問い合わせ">一般的な問い合わせ</option>
            <option value="バグ報告">バグ報告</option>
            <option value="機能リクエスト">機能リクエスト</option>
            <option value="サポートリクエスト">サポートリクエスト</option>
            <option value="その他">その他</option>
        </select>
        @error('category')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>
    <div>
        <label for="detail" class="block text-sm font-medium text-gray-700 required">お問い合わせ内容</label>
        <textarea id="detail" name="detail" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm resize-none" rows="4">{{ old('detail') }}</textarea>
        @error('message')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>
    <div>
        <button type="submit" class="bg-gray-700 text-white px-4 py-2 rounded-md">送信</button>
    </div>
</form>
