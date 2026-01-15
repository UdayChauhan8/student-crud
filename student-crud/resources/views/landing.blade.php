<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>

    <!-- Tailwind CSS CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">

    <style>
        /* Custom animations for professional feel */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Apply animations to elements */
        .hero-content { animation: fadeInUp 0.8s ease-out; }

        .feature-card {
            animation: fadeInUp 0.8s ease-out;
            animation-fill-mode: both;
            transition: all 0.3s ease;
        }

        .feature-card:nth-child(1) { animation-delay: 0.2s; }
        .feature-card:nth-child(2) { animation-delay: 0.4s; }
        .feature-card:nth-child(3) { animation-delay: 0.6s; }

        /* Smooth hover effects */
        .btn-primary { transition: all 0.3s ease; }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        /* Icon styling */
        .icon-circle {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
        }

        html.dark body { background-color: #0b1220; }
        html.dark .bg-white { background-color: #111827 !important; }
        html.dark .bg-gray-50 { background-color: #0b1220 !important; }
        html.dark .text-gray-900 { color: #f9fafb !important; }
        html.dark .text-gray-600,
        html.dark .text-gray-500 { color: #cbd5e1 !important; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4 sm:p-6">

    {{--
        LANDING PAGE
        Purpose: Entry point to the Student CRUD system
        Flow: User clicks "Manage Students" -> redirects to /students
    --}}

    <div class="container mx-auto max-w-6xl">

        <div class="flex justify-end mb-6">
            <button type="button" data-theme-toggle class="text-sm bg-white shadow px-4 py-2 rounded text-gray-700">
                Dark Mode
            </button>
        </div>

        {{-- Hero Section --}}
        <div class="hero-content text-center mb-16">

            {{-- Logo/Icon --}}
            <div class="mb-8">
                <div class="w-20 h-20 bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl mx-auto flex items-center justify-center shadow-lg">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
            </div>

            {{-- Main Title --}}
            <h1 class="text-3xl sm:text-5xl font-bold text-gray-900 mb-4">
                Student Management System
            </h1>

            {{-- Subtitle --}}
            <p class="text-base sm:text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
                A simple backend-driven system to manage student records efficiently.
                Built with Laravel for reliability and ease of use.
            </p>

            {{-- CTA Button - Links to students CRUD index --}}
            <a href="{{ route('students.index') }}"
               class="btn-primary inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 sm:px-8 sm:py-4 rounded-lg shadow-lg text-base sm:text-lg">
                Manage Students ->
            </a>

        </div>

        {{-- Features Section --}}
        <div class="grid gap-6 sm:gap-8 md:grid-cols-3 mt-12 sm:mt-16">

            {{-- Feature 1: Add Records --}}
            <a href="{{ route('students.create') }}" class="feature-card bg-white rounded-xl p-8 shadow-md block">
                <div class="icon-circle">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Add Student Records</h3>
                <p class="text-gray-600">
                    Quickly create new student entries with all necessary details in a simple form.
                </p>
            </a>

            {{-- Feature 2: Update Data --}}
            <a href="{{ route('students.quickEdit') }}" class="feature-card bg-white rounded-xl p-8 shadow-md block">
                <div class="icon-circle">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Update Data</h3>
                <p class="text-gray-600">
                    Edit existing student information anytime to keep records accurate and up-to-date.
                </p>
            </a>

            {{-- Feature 3: Remove Entries --}}
            <a href="{{ route('students.index') }}#students-table" class="feature-card bg-white rounded-xl p-8 shadow-md block">
                <div class="icon-circle">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Remove Outdated Entries</h3>
                <p class="text-gray-600">
                    Delete student records that are no longer needed to maintain a clean database.
                </p>
            </a>

        </div>

        {{-- Footer Note --}}
        <div class="text-center mt-16 text-gray-500 text-sm">
            <p>Built with Laravel - Simple - Efficient - Professional</p>
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
