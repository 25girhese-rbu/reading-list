<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Reading List ✨</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-gradient-to-br from-pink-100 via-purple-100 to-indigo-100 text-purple-950 min-h-screen py-10 px-4 sm:px-6">

    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8 bg-white/70 backdrop-blur-md p-6 rounded-3xl border border-pink-200/60 shadow-xl shadow-pink-200/50">
            <div>
                <h1 class="text-3xl font-extrabold tracking-tight text-pink-600 flex items-center gap-2">
                    🌸 My Reading Sanctuary ✨
                </h1>
                <p class="text-purple-400 text-sm mt-1 font-medium">Keep track of your favorite light novels, manga, and books! 📕</p>
            </div>
            <a href="{{ route('books.create') }}" class="inline-flex items-center justify-center bg-pink-400 hover:bg-pink-500 text-white font-bold px-5 py-3 rounded-2xl text-sm transition shadow-lg shadow-pink-300/60 hover:scale-105 transform duration-200">
                + Add New Book 🎀
            </a>
        </div>

        <!-- Success Alert -->
        @if(session('success'))
            <div class="mb-6 p-4 text-sm text-pink-700 bg-pink-100/80 border border-pink-300 rounded-2xl flex items-center shadow-sm">
                <span>✨ {{ session('success') }}</span>
            </div>
        @endif

        <!-- Filter Navigation Tabs -->
        <div class="flex flex-wrap gap-2 mb-6 bg-white/60 backdrop-blur-sm p-2 rounded-2xl border border-purple-200/50 shadow-sm">
            <a href="{{ route('books.index') }}" 
               class="px-4 py-2 rounded-xl text-sm font-semibold transition {{ !request('status') ? 'bg-pink-400 text-white shadow-md shadow-pink-300/50' : 'text-purple-500 hover:bg-pink-50 hover:text-pink-600' }}">
                All Books 📚
            </a>
            <a href="{{ route('books.index', ['status' => 'to-read']) }}" 
               class="px-4 py-2 rounded-xl text-sm font-semibold transition {{ request('status') === 'to-read' ? 'bg-purple-400 text-white shadow-md shadow-purple-300/50' : 'text-purple-500 hover:bg-purple-50 hover:text-purple-600' }}">
                To Read 🌸
            </a>
            <a href="{{ route('books.index', ['status' => 'reading']) }}" 
               class="px-4 py-2 rounded-xl text-sm font-semibold transition {{ request('status') === 'reading' ? 'bg-sky-400 text-white shadow-md shadow-sky-300/50' : 'text-purple-500 hover:bg-sky-50 hover:text-sky-600' }}">
                Reading 📖
            </a>
            <a href="{{ route('books.index', ['status' => 'finished']) }}" 
               class="px-4 py-2 rounded-xl text-sm font-semibold transition {{ request('status') === 'finished' ? 'bg-emerald-400 text-white shadow-md shadow-emerald-300/50' : 'text-purple-500 hover:bg-emerald-50 hover:text-emerald-600' }}">
                Finished 🎉
            </a>
        </div>

        <!-- Book Card Grid -->
        @if($books->isEmpty())
            <div class="bg-white/70 backdrop-blur-md border border-pink-200 rounded-3xl p-12 text-center shadow-md">
                <p class="text-purple-400 text-lg font-medium">No books in this view yet~ (⁠っ⁠.⁠Location⁠)⁠っ</p>
                <a href="{{ route('books.create') }}" class="text-pink-500 hover:text-pink-600 underline text-sm font-bold mt-2 inline-block">Click here to add one! ✨</a>
            </div>
        @else
            <div class="grid gap-5 sm:grid-cols-1 md:grid-cols-2">
                @foreach($books as $book)
                    <div class="bg-white/80 backdrop-blur-md border border-purple-100 hover:border-pink-300 rounded-3xl p-6 shadow-md hover:shadow-xl transition transform hover:-translate-y-1 duration-200 flex flex-col justify-between">
                        <div>
                            <div class="flex items-start justify-between gap-3">
                                <h2 class="font-bold text-xl text-purple-950 leading-snug">{{ $book->title }}</h2>
                                @php
                                    $badgeStyles = [
                                        'to-read' => 'bg-purple-100 text-purple-600 border-purple-200',
                                        'reading' => 'bg-sky-100 text-sky-600 border-sky-200',
                                        'finished' => 'bg-emerald-100 text-emerald-600 border-emerald-200',
                                    ];
                                    $badgeIcons = [
                                        'to-read' => '🌸 To Read',
                                        'reading' => '📖 Reading',
                                        'finished' => '🎉 Finished',
                                    ];
                                @endphp
                                <span class="px-3 py-1 text-xs font-bold rounded-full border shadow-sm whitespace-nowrap {{ $badgeStyles[$book->status] ?? '' }}">
                                    {{ $badgeIcons[$book->status] ?? ucfirst($book->status) }}
                                </span>
                            </div>
                            <p class="text-sm text-purple-400 font-medium mt-1">by <span class="text-pink-500 font-semibold">{{ $book->author }}</span></p>
                        </div>

                        <div class="flex items-center justify-between mt-6 pt-4 border-t border-purple-100">
                            <!-- Update Status Dropdown -->
                            <form action="{{ route('books.update', $book) }}" method="POST" class="flex items-center gap-2">
                                @csrf
                                @method('PATCH')
                                <select name="status" onchange="this.form.submit()" class="text-xs font-semibold bg-pink-50 text-pink-700 border border-pink-200 rounded-xl px-3 py-1.5 focus:ring-2 focus:ring-pink-300 cursor-pointer shadow-sm">
                                    <option value="to-read" {{ $book->status === 'to-read' ? 'selected' : '' }}>To Read 🌸</option>
                                    <option value="reading" {{ $book->status === 'reading' ? 'selected' : '' }}>Reading 📖</option>
                                    <option value="finished" {{ $book->status === 'finished' ? 'selected' : '' }}>Finished 🎉</option>
                                </select>
                            </form>

                            <!-- Delete Form Button -->
                            <form action="{{ route('books.destroy', $book) }}" method="POST" onsubmit="return confirm('Remove this book from your sanctuary? 🌸');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs font-bold text-rose-400 hover:text-rose-600 hover:bg-rose-50 px-3 py-1.5 rounded-xl transition">
                                    Delete 🎀
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</body>
</html>