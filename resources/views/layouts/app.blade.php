<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Journal App</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            safelist: [
                'bg-indigo-50', 'text-indigo-600',
                'bg-blue-50', 'text-blue-600',
                'bg-pink-50', 'text-pink-600',
                'bg-emerald-50', 'text-emerald-600',
                'bg-amber-50', 'text-amber-600',
                'bg-slate-50', 'text-slate-600'
            ]
        }
    </script>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body class="bg-white text-[#333] font-sans antialiased flex h-screen overflow-hidden">

    <aside class="w-64 bg-white border-r border-slate-200 h-full p-6 flex flex-col justify-between">
        <div>
            <h1 class="text-2xl font-bold  tracking-tight mb-8">Daily Draft</h1>
            
            <a onclick="window.location.replace('/entries/create')" class="cursor-pointer block w-full bg-[#e22161] hover:bg-[#ce0d4d] text-white text-center font-semibold py-3 rounded-xl shadow-sm transition mb-8">
                + New Entry
            </a>

            <nav class="space-y-2">
                <a href="/entries" 
                class="flex items-center px-3 py-2 rounded-lg transition font-medium 
                {{ request()->is('entries') && !request()->has('is_favorite') ? 'text-[#e22161] bg-pink-50' : 'text-slate-600 hover:text-[#e22161] hover:bg-pink-50' }}">
                    <i class="ph ph-books mr-3 text-xl"></i> All Entries
                </a>

                <a href="/entries?is_favorite=1" 
                class="flex items-center px-3 py-2 rounded-lg transition font-medium 
                {{ request()->get('is_favorite') == '1' ? 'text-[#e22161] bg-pink-50' : 'text-slate-600 hover:text-[#e22161] hover:bg-pink-50' }}">
                    <i class="ph ph-star mr-3 text-xl"></i> Favorites
                </a>

                <a href="/entries/trash" 
                class="flex items-center px-3 py-2 rounded-lg transition font-medium 
                {{ request()->is('entries/trash') ? 'text-[#e22161] bg-pink-50' : 'text-slate-600 hover:text-[#e22161] hover:bg-pink-50' }}">
                    <i class="ph ph-trash mr-3 text-xl"></i> Trash Bin
                </a>
            </nav>
        </div>
        
    </aside>

    <main class="flex-1 h-full overflow-y-auto p-10">
        <div class="max-w-3xl mx-auto">
            @yield('content')
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>

        window.addEventListener("pageshow", function (event) {
        // If the page is loaded from cache (back button)
        if (event.persisted || (window.performance && window.performance.navigation.type === 2)) {
            window.location.reload();
        }
        });
        // This MUST be outside of any other functions to be "Global"
        // Themed Confirm Action Logic
        function confirmAction(button, message, color = '#e22161') { 
            Swal.fire({
                title: 'Are you sure?',
                text: message,
                icon: 'warning',
                iconColor: '#e22161', 
                showCancelButton: true,
                confirmButtonColor: color,
                cancelButtonColor: '#94a3b8', // Soft slate gray for the cancel button
                confirmButtonText: 'Yes, proceed',
                cancelButtonText: 'Cancel',
                background: '#ffffff',
                color: '#333333',
                customClass: {
                    popup: 'rounded-2xl border border-pink-100 shadow-2xl shadow-pink-200/40', 
                    confirmButton: 'rounded-xl font-bold px-6',
                    cancelButton: 'rounded-xl font-bold px-6'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    let form = button.nextElementSibling;
                    while (form && form.tagName !== 'FORM') {
                        form = form.nextElementSibling;
                    }
                    if (form) {
                        form.submit();
                    } else {
                        console.error("Form not found for this button!");
                    }
                }
            });
        }

        // Success Toast Logic
        @if(session('success'))
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            });
            Toast.fire({
                icon: 'success',
                title: "{{ session('success') }}"
            });
        @endif
    </script>
</body>
</html>