<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'JITO JEAP Demo' }}</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Custom Styles -->
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .custom-input {
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid #e2e8f0;
            transition: all 0.3s ease;
        }
        
        .custom-input:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        
        .btn-primary {
            background: linear-gradient(45deg, #667eea, #764ba2);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }
        
        .form-container {
            max-width: 500px;
            margin: 0 auto;
        }
        
        .input-group {
            margin-bottom: 1.5rem;
        }
        
        .label-text {
            color: #374151;
            font-weight: 600;
            margin-bottom: 0.5rem;
            display: block;
        }
    </style>
</head>
<body class="min-h-screen gradient-bg flex items-center justify-center p-4">
    
    <div class="form-container w-full">
        <!-- Main Form Card -->
        <div class="glass-effect rounded-3xl p-8 shadow-2xl">
            
            <!-- Header Section -->
            <div class="text-center mb-8">
                <div class="w-20 h-20 bg-white rounded-full mx-auto mb-4 flex items-center justify-center shadow-lg">
                    <svg class="w-10 h-10 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-white mb-2">JITO JEAP</h1>
                <p class="text-white/80">Demo Form Interface</p>
            </div>
            
            <!-- Form Section -->
            <form id="demoForm" method="POST" action="{{ route('demo.submit') }}">
                @csrf
                
                <!-- Name Input -->
                <div class="input-group">
                    <label for="name" class="label-text text-white">Full Name</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        class="custom-input w-full px-4 py-3 rounded-xl focus:outline-none"
                        placeholder="Enter your full name"
                        value="{{ old('name') }}"
                        required
                    >
                    @error('name')
                        <span class="text-red-300 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
                
                <!-- Email Input -->
                <div class="input-group">
                    <label for="email" class="label-text text-white">Email Address</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        class="custom-input w-full px-4 py-3 rounded-xl focus:outline-none"
                        placeholder="Enter your email"
                        value="{{ old('email') }}"
                        required
                    >
                    @error('email')
                        <span class="text-red-300 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
                
                <!-- Phone Input -->
                <div class="input-group">
                    <label for="phone" class="label-text text-white">Phone Number</label>
                    <input 
                        type="tel" 
                        id="phone" 
                        name="phone" 
                        class="custom-input w-full px-4 py-3 rounded-xl focus:outline-none"
                        placeholder="Enter your phone number"
                        value="{{ old('phone') }}"
                        required
                    >
                    @error('phone')
                        <span class="text-red-300 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
                
                <!-- Category Select -->
                <div class="input-group">
                    <label for="category" class="label-text text-white">Category</label>
                    <select 
                        id="category" 
                        name="category" 
                        class="custom-input w-full px-4 py-3 rounded-xl focus:outline-none"
                        required
                    >
                        <option value="">Select Category</option>
                        <option value="business" {{ old('category') == 'business' ? 'selected' : '' }}>Business</option>
                        <option value="personal" {{ old('category') == 'personal' ? 'selected' : '' }}>Personal</option>
                        <option value="education" {{ old('category') == 'education' ? 'selected' : '' }}>Education</option>
                        <option value="other" {{ old('category') == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('category')
                        <span class="text-red-300 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
                
                <!-- Message Textarea -->
                <div class="input-group">
                    <label for="message" class="label-text text-white">Message</label>
                    <textarea 
                        id="message" 
                        name="message" 
                        rows="4"
                        class="custom-input w-full px-4 py-3 rounded-xl focus:outline-none resize-none"
                        placeholder="Enter your message"
                        required
                    >{{ old('message') }}</textarea>
                    @error('message')
                        <span class="text-red-300 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
                
                <!-- Submit Button -->
                <div class="input-group">
                    <button 
                        type="submit" 
                        class="btn-primary w-full py-4 px-6 rounded-xl text-white font-semibold text-lg shadow-lg"
                    >
                        Submit Form
                    </button>
                </div>
                
            </form>
            
            <!-- Success Message -->
            @if(session('success'))
                <div class="mt-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-xl">
                    {{ session('success') }}
                </div>
            @endif
            
            <!-- Error Message -->
            @if(session('error'))
                <div class="mt-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-xl">
                    {{ session('error') }}
                </div>
            @endif
            
        </div>
        
        <!-- Footer -->
        <div class="text-center mt-6">
            <p class="text-white/60 text-sm">
                © 2024 JITO JEAP. Made with ❤️ by Raj
            </p>
        </div>
        
    </div>
    
    <!-- JavaScript for Form Enhancement -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('demoForm');
            const inputs = form.querySelectorAll('input, select, textarea');
            
            // Add focus effects
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('focused');
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('focused');
                });
            });
            
            // Form submission with AJAX (following Laravel API standards)
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const formData = new FormData(this);
                const jsonData = {};
                
                // Convert FormData to JSON (as per user preferences)
                for (let [key, value] of formData.entries()) {
                    jsonData[key] = value;
                }
                
                // Submit with proper headers
                fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(jsonData)
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Success:', data);
                    if (data.success) {
                        // Redirect or show success message
                        window.location.reload();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });
        });
    </script>
    
</body>
</html>