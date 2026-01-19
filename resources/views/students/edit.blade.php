<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Student</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        html.dark body { background-color: #0b1220; }
        html.dark .bg-white { background-color: #111827 !important; }
        html.dark .bg-gray-50 { background-color: #0b1220 !important; }
        html.dark .text-gray-900 { color: #f9fafb !important; }
        html.dark .text-gray-700,
        html.dark .text-gray-600,
        html.dark .text-gray-500 { color: #cbd5e1 !important; }
        html.dark .border-gray-300 { border-color: #374151 !important; }
        html.dark .border-red-200 { border-color: #7f1d1d !important; }
        html.dark .bg-red-50 { background-color: #2a0f14 !important; }
        html.dark .text-red-700 { color: #fca5a5 !important; }
        html.dark .text-red-800 { color: #fecaca !important; }
        html.dark .dropdown-item:hover { background-color: #1f2937 !important; }
        .dropdown-item:hover { background-color: #f3f4f6; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="max-w-3xl mx-auto p-4 sm:p-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Edit Student</h1>
                <p class="text-gray-600">Update an existing student record</p>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <button type="button" data-theme-toggle class="text-sm bg-white shadow px-3 py-2 rounded text-gray-700">Dark Mode</button>
                <a href="{{ route('students.index') }}" class="text-sm text-gray-700 hover:underline">Back to list</a>
            </div>
        </div>

        @if ($errors->any())
            <div class="mb-6 rounded border border-red-200 bg-red-50 p-4">
                <p class="font-semibold text-red-800">Please fix the following:</p>
                <ul class="list-disc ml-5 text-red-700">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white shadow rounded p-6">
            <form action="{{ route('students.update', $student) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-semibold text-gray-700">Roll No</label>
                    <input type="number" name="roll_number" min="1" value="{{ old('roll_number', $student->roll_number) }}"
                           class="mt-1 w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700">Name</label>
                    <input type="text" name="name" value="{{ old('name', $student->name) }}"
                           class="mt-1 w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700">Email</label>
                    <input type="email" name="email" value="{{ old('email', $student->email) }}"
                           class="mt-1 w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700">Course</label>
                    <div class="relative mt-1">
                        <input type="text" id="course_search" autocomplete="off" value="{{ old('course', $student->course) }}"
                               class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white text-gray-900"
                               placeholder="Search and select a course">
                        <input type="hidden" name="course" id="course_value" value="{{ old('course', $student->course) }}">

                        <div id="course_dropdown" class="absolute z-10 mt-1 w-full bg-white border border-gray-300 rounded shadow hidden max-h-56 overflow-auto"></div>
                    </div>
                    <p id="course_client_error" class="mt-1 text-sm text-red-700 hidden">Please select a course from the list.</p>
                </div>

                <div class="flex flex-wrap items-center gap-3">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded">Update</button>
                    <a href="{{ route('students.index') }}" class="text-gray-700 hover:underline">Cancel</a>
                </div>
            </form>
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

            var courses = @json(config('courses.list'));
            var input = document.getElementById('course_search');
            var hidden = document.getElementById('course_value');
            var dropdown = document.getElementById('course_dropdown');
            var clientError = document.getElementById('course_client_error');
            var form = document.querySelector('form');

            function openDropdown() {
                dropdown.classList.remove('hidden');
            }

            function closeDropdown() {
                dropdown.classList.add('hidden');
            }

            function renderList(query) {
                var q = (query || '').toLowerCase();
                var filtered = courses.filter(function (c) {
                    return c.toLowerCase().includes(q);
                }).slice(0, 50);

                dropdown.innerHTML = '';
                filtered.forEach(function (course) {
                    var item = document.createElement('button');
                    item.type = 'button';
                    item.className = 'dropdown-item w-full text-left px-3 py-2 text-sm text-gray-900';
                    item.textContent = course;
                    item.addEventListener('mousedown', function (e) {
                        e.preventDefault();
                    });
                    item.addEventListener('click', function () {
                        input.value = course;
                        hidden.value = course;
                        clientError.classList.add('hidden');
                        closeDropdown();
                    });
                    dropdown.appendChild(item);
                });

                if (filtered.length === 0) {
                    var empty = document.createElement('div');
                    empty.className = 'px-3 py-2 text-sm text-gray-500';
                    empty.textContent = 'No matching courses.';
                    dropdown.appendChild(empty);
                }
            }

            function syncHiddenValue() {
                var exact = courses.includes(input.value);
                hidden.value = exact ? input.value : '';
                if (exact) {
                    clientError.classList.add('hidden');
                }
            }

            input.addEventListener('focus', function () {
                renderList(input.value);
                openDropdown();
            });

            input.addEventListener('input', function () {
                renderList(input.value);
                openDropdown();
                syncHiddenValue();
            });

            document.addEventListener('click', function (e) {
                if (!dropdown.contains(e.target) && e.target !== input) {
                    closeDropdown();
                }
            });

            input.addEventListener('blur', function () {
                syncHiddenValue();
            });

            form.addEventListener('submit', function (e) {
                syncHiddenValue();
                if (!hidden.value) {
                    e.preventDefault();
                    clientError.classList.remove('hidden');
                    input.focus();
                }
            });
        })();
    </script>
</body>
</html>
