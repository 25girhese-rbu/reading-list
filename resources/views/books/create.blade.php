<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Book ✨</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-gradient-to-br from-pink-100 via-purple-100 to-indigo-100 text-purple-950 min-h-screen py-10 px-4">
    <div class="max-w-md mx-auto bg-white/80 backdrop-blur-md border border-pink-200/80 p-8 rounded-3xl shadow-xl shadow-pink-200/50">
        <h1 class="text-2xl font-bold text-pink-600 mb-1">Add New Book 📕</h1>
        <p class="text-xs font-medium text-purple-400 mb-6">Enter details below to expand your reading collection ✨</p>

        <form action="{{ route('books.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-bold text-purple-800 mb-1.5">Book Title</label>
                <input type="text" name="title" value="{{ old('title') }}" placeholder="e.g. The Alchemist" required 
                       class="w-full bg-pink-50/50 border border-pink-200 rounded-2xl p-3 text-sm text-purple-900 placeholder-purple-300 focus:outline-none focus:ring-2 focus:ring-pink-300">
                @error('title') <p class="text-rose-500 text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-bold text-purple-800 mb-1.5">Author</label>
                <input type="text" name="author" value="{{ old('author') }}" placeholder="e.g. Paulo Coelho" required 
                       class="w-full bg-pink-50/50 border border-pink-200 rounded-2xl p-3 text-sm text-purple-900 placeholder-purple-300 focus:outline-none focus:ring-2 focus:ring-pink-300">
                @error('author') <p class="text-rose-500 text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-bold text-purple-800 mb-1.5">Reading Status</label>
                <select name="status" class="w-full bg-pink-50/50 border border-pink-200 rounded-2xl p-3 text-sm text-purple-900 focus:outline-none focus:ring-2 focus:ring-pink-300 cursor-pointer">
                    <option value="to-read">To Read 🌸</option>
                    <option value="reading">Reading 📖</option>
                    <option value="finished">Finished 🎉</option>
                </select>
                @error('status') <p class="text-rose-500 text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center justify-end gap-3 pt-4">
                <a href="{{ route('books.index') }}" class="text-sm font-bold text-purple-400 hover:text-purple-600 transition px-3 py-2">Cancel</a>
                <button type="submit" class="bg-pink-400 hover:bg-pink-500 text-white font-bold text-sm px-6 py-3 rounded-2xl shadow-lg shadow-pink-300/60 transition transform hover:scale-105">
                    Save Book ✨
                </button>
            </div>
        </form>
    </div>
</body>
</html>