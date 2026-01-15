<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Students</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        html.dark body { background-color: #0b1220; }
        html.dark .bg-white { background-color: #111827 !important; }
        html.dark .bg-gray-50 { background-color: #0b1220 !important; }
        html.dark .text-gray-900 { color: #f9fafb !important; }
        html.dark .text-gray-700,
        html.dark .text-gray-600,
        html.dark .text-gray-500 { color: #cbd5e1 !important; }
        html.dark .divide-gray-200 { border-color: #1f2937 !important; }
        html.dark .border-gray-300 { border-color: #374151 !important; }
        html.dark .border-red-200 { border-color: #7f1d1d !important; }
        html.dark .bg-red-50 { background-color: #2a0f14 !important; }
        html.dark .text-red-700 { color: #fca5a5 !important; }
        html.dark .text-red-800 { color: #fecaca !important; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="max-w-6xl mx-auto p-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Students</h1>
                <p class="text-gray-600">Simple Laravel CRUD (MVC)</p>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <button type="button" data-theme-toggle class="text-sm bg-white shadow px-3 py-2 rounded text-gray-700">Dark Mode</button>
                <a href="{{ url('/') }}" class="text-sm text-gray-700 hover:underline">Home</a>
                <a href="{{ route('students.create') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded">Create Student</a>
            </div>
        </div>

        @if ($errors->any())
            <div class="mb-6 rounded border border-red-200 bg-red-50 p-4">
                <p class="font-semibold text-red-800">Validation errors:</p>
                <ul class="list-disc ml-5 text-red-700">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div id="students-table" class="bg-white shadow rounded overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">S.No</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Course</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($students as $student)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $student->id }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $student->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $student->email }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $student->course }}</td>
                            <td class="px-6 py-4 text-sm">
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('students.edit', $student) }}" class="text-blue-600 hover:underline">Edit</a>

                                    <form action="{{ route('students.destroy', $student) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    @if ($students->count() === 0)
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                                No students found. Click "Create Student" to add your first record.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
            </div>
        </div>
    </div>

    <script>
        (function () {
            var root = document.documentElement;
            var stored = localStorage.getItem('theme');
            if (stored === 'dark') {
                root.classList.add('dark');
            }

            function setLabel() {
                var isDark = root.classList.contains('dark');
                document.querySelectorAll('[data-theme-toggle]').forEach(function (btn) {
                    btn.textContent = isDark ? 'Light Mode' : 'Dark Mode';
                });
            }

            setLabel();

            document.querySelectorAll('[data-theme-toggle]').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    root.classList.toggle('dark');
                    localStorage.setItem('theme', root.classList.contains('dark') ? 'dark' : 'light');
                    setLabel();
                });
            });
        })();
    </script>
</body>
</html>
