@extends('layout.app')

@section('title', 'Contact Support | EcoBite')

@section('content')
<div class="min-h-screen bg-[#F0FDF4] pb-0">

    <div class="bg-[#007821] text-white py-16 px-6 relative overflow-hidden border-b border-green-800">
        <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none">
            <div class="absolute -right-20 -top-20 w-96 h-96 rounded-full bg-white blur-3xl"></div>
            <div class="absolute -left-20 -bottom-20 w-64 h-64 rounded-full bg-[#4ade80] blur-3xl"></div>
        </div>
        
        <div class="max-w-4xl mx-auto text-center relative z-10">
            <h1 class="text-4xl font-bold mb-4">How can we help you?</h1>
            <p class="text-green-100 text-lg">
                Have a question about an order, a dietary concern, or technical issue? 
                Submit a ticket below.
            </p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 -mt-10 relative z-20">
        <div class="grid lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white rounded-2xl shadow-md p-8 border border-gray-100 h-full">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">Contact Info</h3>
                    
                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="bg-[#E6F4EA] w-10 h-10 rounded-full flex items-center justify-center text-[#007821] flex-shrink-0 mt-1">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-bold text-gray-900">University of Gujrat</p>
                                <p class="text-sm text-gray-500 leading-relaxed">
                                    Hafiz Hayat Campus,<br>
                                    Gujrat, Punjab, Pakistan
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="bg-[#E6F4EA] w-10 h-10 rounded-full flex items-center justify-center text-[#007821] flex-shrink-0 mt-1">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-bold text-gray-900">Email Us</p>
                                <p class="text-sm text-gray-500">support@ecobite.com</p>
                                <p class="text-sm text-gray-500">partners@ecobite.com</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="bg-[#E6F4EA] w-10 h-10 rounded-full flex items-center justify-center text-[#007821] flex-shrink-0 mt-1">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-bold text-gray-900">Call Support</p>
                                <p class="text-sm text-gray-500">+92 300 1234567</p>
                                <p class="text-xs text-gray-400 mt-1">Mon-Fri, 9am - 5pm</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-100">
                        <p class="text-xs font-bold text-gray-400 uppercase mb-3">Connect on Social</p>
                        <div class="flex space-x-4">
                            <a href="#" class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-blue-600 hover:text-white transition">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-pink-600 hover:text-white transition">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-blue-400 hover:text-white transition">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-lg p-8 md:p-10 border border-gray-100">
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Submit a Support Ticket</h2>
                    <p class="text-gray-500 text-sm mb-8">We usually respond within 24 hours.</p>

                    <form action="#" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Your Name</label>
                                <input type="text" name="name" placeholder="Muneeb Hassan" required 
                                       class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 focus:outline-none focus:border-[#007821] focus:ring-1 focus:ring-[#007821] transition">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Email Address</label>
                                <input type="email" name="email" placeholder="john@example.com" required 
                                       class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 focus:outline-none focus:border-[#007821] focus:ring-1 focus:ring-[#007821] transition">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Issue Category</label>
                            <div class="relative">
                                <select name="category" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 appearance-none focus:outline-none focus:border-[#007821] focus:ring-1 focus:ring-[#007821] transition text-gray-600">
                                    <option value="general">General Inquiry</option>
                                    <option value="refund">Order Issue (Refund/Missing Item)</option>
                                    <option value="bug">Technical Bug</option>
                                    <option value="partner">Supplier Partnership</option>
                                    <option value="feedback">Feedback / Suggestion</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-500">
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Message Details</label>
                            <textarea name="message" rows="5" placeholder="Describe your issue..." required 
                                      class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 focus:outline-none focus:border-[#007821] focus:ring-1 focus:ring-[#007821] transition resize-none"></textarea>
                        </div>

                        <button type="submit" class="bg-[#007821] text-white font-bold py-4 px-8 rounded-full hover:bg-[#009e2b] transition shadow-lg w-full md:w-auto transform active:scale-95">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <div class="max-w-4xl mx-auto px-6 mt-24 mb-24">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-10">Frequently Asked Questions</h2>
        
        <div class="grid md:grid-cols-2 gap-6 items-start" id="faq-container">
            <div class="faq-item bg-white border border-gray-200 rounded-xl p-6 hover:shadow-md transition cursor-pointer group h-fit">
                <div class="flex justify-between items-center">
                    <h4 class="font-bold text-gray-700 group-hover:text-[#007821]">Is the food safe to eat?</h4>
                    <div class="bg-gray-100 rounded-full w-8 h-8 flex items-center justify-center transition-transform duration-300 icon-container flex-shrink-0 ml-3 group-hover:text-[#007821]">
                        <i class="fas fa-plus text-sm"></i>
                    </div>
                </div>
                <div class="answer max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                    <p class="text-gray-500 text-sm mt-4 leading-relaxed border-t border-gray-100 pt-4">
                        Yes. We strictly enforce quality checks. Food listed is surplus (unsold), not expired or spoiled. All partner restaurants must adhere to our "Ecobite Freshness Standard".
                    </p>
                </div>
            </div>

            <div class="faq-item bg-white border border-gray-200 rounded-xl p-6 hover:shadow-md transition cursor-pointer group h-fit">
                <div class="flex justify-between items-center">
                    <h4 class="font-bold text-gray-700 group-hover:text-[#007821]">How do I pick up my order?</h4>
                    <div class="bg-gray-100 rounded-full w-8 h-8 flex items-center justify-center transition-transform duration-300 icon-container flex-shrink-0 ml-3 group-hover:text-[#007821]">
                        <i class="fas fa-plus text-sm"></i>
                    </div>
                </div>
                <div class="answer max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                    <p class="text-gray-500 text-sm mt-4 leading-relaxed border-t border-gray-100 pt-4">
                        After payment, you receive a digital "Eco-Code". Simply visit the restaurant during the specified "Pickup Window", show your code, and collect your meal.
                    </p>
                </div>
            </div>

            <div class="faq-item bg-white border border-gray-200 rounded-xl p-6 hover:shadow-md transition cursor-pointer group h-fit">
                <div class="flex justify-between items-center">
                    <h4 class="font-bold text-gray-700 group-hover:text-[#007821]">Can I get a refund?</h4>
                    <div class="bg-gray-100 rounded-full w-8 h-8 flex items-center justify-center transition-transform duration-300 icon-container flex-shrink-0 ml-3 group-hover:text-[#007821]">
                        <i class="fas fa-plus text-sm"></i>
                    </div>
                </div>
                <div class="answer max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                    <p class="text-gray-500 text-sm mt-4 leading-relaxed border-t border-gray-100 pt-4">
                        Refunds are available if the food quality does not meet standards or if the restaurant was closed upon your arrival. You must submit a "Ticket" (above) within 2 hours of pickup.
                    </p>
                </div>
            </div>

            <div class="faq-item bg-white border border-gray-200 rounded-xl p-6 hover:shadow-md transition cursor-pointer group h-fit">
                <div class="flex justify-between items-center">
                    <h4 class="font-bold text-gray-700 group-hover:text-[#007821]">Do you offer delivery?</h4>
                    <div class="bg-gray-100 rounded-full w-8 h-8 flex items-center justify-center transition-transform duration-300 icon-container flex-shrink-0 ml-3 group-hover:text-[#007821]">
                        <i class="fas fa-plus text-sm"></i>
                    </div>
                </div>
                <div class="answer max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                    <p class="text-gray-500 text-sm mt-4 leading-relaxed border-t border-gray-100 pt-4">
                        Currently, EcoBite is a pickup-only service. This helps us keep costs low and reduces the carbon footprint associated with delivery vehicles.
                    </p>
                </div>
            </div>

            <div class="faq-item bg-white border border-gray-200 rounded-xl p-6 hover:shadow-md transition cursor-pointer group h-fit">
                <div class="flex justify-between items-center">
                    <h4 class="font-bold text-gray-700 group-hover:text-[#007821]">How can my restaurant join?</h4>
                    <div class="bg-gray-100 rounded-full w-8 h-8 flex items-center justify-center transition-transform duration-300 icon-container flex-shrink-0 ml-3 group-hover:text-[#007821]">
                        <i class="fas fa-plus text-sm"></i>
                    </div>
                </div>
                <div class="answer max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                    <p class="text-gray-500 text-sm mt-4 leading-relaxed border-t border-gray-100 pt-4">
                        We love new partners! Select "Supplier Partnership" in the contact form above, or create a Business Account from the signup page to start listing surplus food.
                    </p>
                </div>
            </div>

            <div class="faq-item bg-white border border-gray-200 rounded-xl p-6 hover:shadow-md transition cursor-pointer group h-fit">
                <div class="flex justify-between items-center">
                    <h4 class="font-bold text-gray-700 group-hover:text-[#007821]">What payment methods?</h4>
                    <div class="bg-gray-100 rounded-full w-8 h-8 flex items-center justify-center transition-transform duration-300 icon-container flex-shrink-0 ml-3 group-hover:text-[#007821]">
                        <i class="fas fa-plus text-sm"></i>
                    </div>
                </div>
                <div class="answer max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                    <p class="text-gray-500 text-sm mt-4 leading-relaxed border-t border-gray-100 pt-4">
                        We accept all major credit/debit cards (Visa, Mastercard) as well as EasyPaisa and JazzCash for local convenience.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="w-full h-96 bg-gray-200 relative">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3372.463945922338!2d74.0620138!3d32.6393166!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391f0340c6a85f81%3A0xc665134703577583!2sUniversity%20of%20Gujrat!5e0!3m2!1sen!2s!4v1700000000000!5m2!1sen!2s" 
            width="100%" 
            height="100%" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy"
            class="filter grayscale hover:grayscale-0 transition duration-700">
        </iframe>

        <div class="absolute top-10 right-10 bg-white p-6 rounded-xl shadow-2xl max-w-xs hidden md:block">
            <h5 class="font-bold text-gray-800 text-lg mb-2">Ecobite HQ</h5>
            <p class="text-sm text-gray-500 mb-4">Come say hi! We are located inside the main UOG campus incubation center.</p>
            <a href="https://maps.app.goo.gl/uog" target="_blank" class="text-xs font-bold text-[#007821] uppercase hover:underline">
                Get Directions <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
    </div>

    <div class="bg-[#007821] py-12 text-center px-6">
        <h2 class="text-2xl md:text-3xl font-bold text-white mb-4">Still need help?</h2>
        <p class="text-green-100 mb-8 max-w-2xl mx-auto">
            If you couldn't find your answer in the FAQ or need urgent assistance regarding a food safety concern, please email our priority line directly.
        </p>
        <a href="mailto:urgent@ecobite.com" class="inline-block bg-white text-[#007821] font-bold py-3 px-8 rounded-full hover:bg-[#E6F4EA] hover:text-[#007821] transition shadow-lg transform active:scale-95">
            Email Priority Support
        </a>
    </div>

</div>

<script>
    document.querySelectorAll('.faq-item').forEach(item => {
        item.addEventListener('click', () => {
            const answer = item.querySelector('.answer');
            const icon = item.querySelector('.icon-container');
            const title = item.querySelector('h4');
            
            // Toggle current item
            if (answer.style.maxHeight) {
                // CLOSE
                answer.style.maxHeight = null; 
                icon.classList.remove('rotate-45', 'bg-[#007821]', 'text-white');
                icon.classList.add('bg-gray-100'); // Restore default
            } else {
                // OPTIONAL: Close all others first
                // document.querySelectorAll('.answer').forEach(el => el.style.maxHeight = null);
                // ... reset icons logic ...
                
                // OPEN
                answer.style.maxHeight = answer.scrollHeight + "px"; 
                
                // Apply Brand Color Active State
                icon.classList.remove('bg-gray-100');
                icon.classList.add('rotate-45', 'bg-[#007821]', 'text-white');
            }
        });
    });
</script>
@endsection