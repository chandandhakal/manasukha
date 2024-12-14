@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="hero bg-gradient-to-r from-blue-500 to-purple-600 text-white py-20">
        <div class="container mx-auto px-6">
            <div class="max-w-3xl">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Your Journey to Mental Wellness Starts Here</h1>
                <p class="text-xl mb-8">Find support, connect with others, and take steps towards better mental health.</p>
                <a href="{{ route('signup.form') }}" class="bg-white text-blue-600 px-8 py-3 rounded-full font-semibold hover:bg-blue-50 transition">Get Started</a>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12">Our Services</h2>
            
            <!-- Services Tabs -->
            <div class="max-w-4xl mx-auto">
                <div class="flex flex-wrap justify-center mb-8">
                    <button class="tab-button active px-6 py-2 mx-2 rounded-full" data-tab="consultation">
                        Consultation
                    </button>
                    <button class="tab-button px-6 py-2 mx-2 rounded-full" data-tab="community">
                        Community
                    </button>
                    <button class="tab-button px-6 py-2 mx-2 rounded-full" data-tab="activities">
                        Activities
                    </button>
                </div>

                <!-- Tab Contents -->
                <div class="tab-content active" id="consultation">
                    <div class="bg-white p-8 rounded-lg shadow-md">
                        <h3 class="text-2xl font-semibold mb-4">Professional Consultation</h3>
                        <p class="text-gray-600 mb-6">Connect with licensed therapists and mental health professionals for personalized support and guidance.</p>
                        <ul class="list-disc list-inside text-gray-600 mb-6">
                            <li>One-on-one video sessions</li>
                            <li>Secure messaging</li>
                            <li>Flexible scheduling</li>
                            <li>Expert guidance</li>
                        </ul>
                        <a href="#" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition">Book a Session</a>
                    </div>
                </div>

                <div class="tab-content hidden" id="community">
                    <div class="bg-white p-8 rounded-lg shadow-md">
                        <h3 class="text-2xl font-semibold mb-4">Supportive Community</h3>
                        <p class="text-gray-600 mb-6">Join our caring community of individuals who understand and support each other through shared experiences.</p>
                        <ul class="list-disc list-inside text-gray-600 mb-6">
                            <li>Support groups</li>
                            <li>Discussion forums</li>
                            <li>Peer support</li>
                            <li>Safe space for sharing</li>
                        </ul>
                        <a href="#" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition">Join Community</a>
                    </div>
                </div>

                <div class="tab-content hidden" id="activities">
                    <div class="bg-white p-8 rounded-lg shadow-md">
                        <h3 class="text-2xl font-semibold mb-4">Wellness Activities</h3>
                        <p class="text-gray-600 mb-6">Engage in therapeutic activities designed to promote mental wellness and personal growth.</p>
                        <ul class="list-disc list-inside text-gray-600 mb-6">
                            <li>Guided meditation</li>
                            <li>Journaling exercises</li>
                            <li>Mood tracking</li>
                            <li>Wellness challenges</li>
                        </ul>
                        <a href="#" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition">Explore Activities</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    .tab-button {
        background-color: #f3f4f6;
        transition: all 0.3s ease;
    }
    
    .tab-button.active {
        background-color: #2563eb;
        color: white;
    }
    
    .tab-content {
        display: none;
    }
    
    .tab-content.active {
        display: block;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabs = document.querySelectorAll('.tab-button');
        const contents = document.querySelectorAll('.tab-content');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                // Remove active class from all tabs and contents
                tabs.forEach(t => t.classList.remove('active'));
                contents.forEach(c => c.classList.remove('active'));

                // Add active class to clicked tab and corresponding content
                tab.classList.add('active');
                document.getElementById(tab.dataset.tab).classList.add('active');
            });
        });
    });
</script>
@endpush
