<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Reading List</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">My Reading List</h1>
            <a href="{{ route('books.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md text-sm hover:bg-blue-700">Add Book</a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 text-sm text-green-700 bg-green-100 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if($books->isEmpty())
            <p class="text-gray-500">No books added yet.</p>
        @else
            <ul class="divide-y divide-gray-200">
                @foreach($books as $book)
                    <li class="py-4 flex justify-between items-center">
                        <div>
                            <h2 class="font-semibold text-lg text-gray-900">{{ $book->title }}</h2>
                            <p class="text-sm text-gray-600">by {{ $book->author }}</p>
                        </div>
                        <span class="px-3 py-1 text-xs rounded-full 
                            {{ $book->status === 'finished' ? 'bg-green-100 text-green-800' : ($book->status === 'reading' ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800') }}">
                            {{ ucfirst($book->status) }}
                        </span>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</body>
</html>