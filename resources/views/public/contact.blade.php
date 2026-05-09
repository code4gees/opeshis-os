<x-public-shell title="Contact — Opeshis OS">

<div class="pub-page-hero">
 <div class="pub-page-hero-inner">
 <span class="pub-tag">Get In Touch</span>
 <h1 class="pub-page-title">Contact<br>Our Team</h1>
 <p class="pub-page-desc">Have a question about deployment, licensing, or enterprise support? Our institutional team responds within one business day.</p>
 </div>
</div>

<section class="pub-section">
    <div class="pub-container">
        <div class="grid grid-cols-1 gap-12">
            {{-- Contact Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-4">

                {{-- Phone --}}
                <div class="bg-white/[0.03] border border-white/[0.07] rounded-[20px] p-7 flex flex-col gap-4">
                    <div class="w-[42px] h-[42px] bg-indigo-500/10 border border-indigo-500/20 rounded-xl flex items-center justify-center">
                        <svg width="18" height="18" fill="none" stroke="#818cf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81a19.79 19.79 0 01-3.07-8.68A2 2 0 012 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
                    </div>
                    <div>
                        <div class="text-[10px] font-extrabold uppercase tracking-[0.15em] text-white/30 mb-1.5">Phone</div>
                        <div class="text-[15px] font-bold text-white">+237 6XX XXX XXX</div>
                        <div class="text-[11px] text-white/30 mt-1">Mon–Fri, 8am–6pm WAT</div>
                    </div>
                </div>

                {{-- Email --}}
                <div class="bg-white/[0.03] border border-white/[0.07] rounded-[20px] p-7 flex flex-col gap-4">
                    <div class="w-[42px] h-[42px] bg-emerald-500/10 border border-emerald-500/20 rounded-xl flex items-center justify-center">
                        <svg width="18" height="18" fill="none" stroke="#6ee7b7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    </div>
                    <div>
                        <div class="text-[10px] font-extrabold uppercase tracking-[0.15em] text-white/30 mb-1.5">Email</div>
                        <div class="text-[15px] font-bold text-white">contact@opesware.com</div>
                        <div class="text-[11px] text-white/30 mt-1">Response within 24 hours</div>
                    </div>
                </div>

                {{-- Location --}}
                <div class="bg-white/[0.03] border border-white/[0.07] rounded-[20px] p-7 flex flex-col gap-4">
                    <div class="w-[42px] h-[42px] bg-amber-500/10 border border-amber-500/20 rounded-xl flex items-center justify-center">
                        <svg width="18" height="18" fill="none" stroke="#fcd34d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    </div>
                    <div>
                        <div class="text-[10px] font-extrabold uppercase tracking-[0.15em] text-white/30 mb-1.5">Headquarters</div>
                        <div class="text-[15px] font-bold text-white">Douala, Cameroon</div>
                        <div class="text-[11px] text-white/30 mt-1">Central Africa · WAT (UTC+1)</div>
                    </div>
                </div>

            </div>

            {{-- Contact Form --}}
            <div class="bg-white/[0.02] border border-white/[0.07] rounded-3xl p-10">
                <div class="mb-8">
                    <h2 class="text-2xl font-black tracking-tight uppercase text-white mb-1.5">Send a Message</h2>
                    <p class="text-[13px] text-white/35 font-normal">Tell us about your institution and requirements. Our enterprise team will follow up promptly.</p>
                </div>

                @if(session('success'))
                <div class="bg-emerald-500/10 border border-emerald-500/20 rounded-xl p-4 mb-6 flex items-center gap-3">
                    <svg width="16" height="16" fill="none" stroke="#10b981" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                    <span class="text-xs font-bold text-emerald-300 uppercase tracking-wider">{{ session('success') }}</span>
                </div>
                @endif

                <form method="POST" action="{{ route('public.contact.submit') }}" class="grid gap-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="block text-[10px] font-extrabold tracking-widest uppercase text-white/30">Full Name *</label>
                            <input type="text" name="name" required value="{{ old('name') }}" placeholder="Dr. Jane Mbeki"
                                class="cc-input w-full">
                            @error('name')<span class="text-[10px] text-rose-400 font-semibold">{{ $message }}</span>@enderror
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[10px] font-extrabold tracking-widest uppercase text-white/30">Email Address *</label>
                            <input type="email" name="email" required value="{{ old('email') }}" placeholder="name@institution.com"
                                class="cc-input w-full">
                            @error('email')<span class="text-[10px] text-rose-400 font-semibold">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="block text-[10px] font-extrabold tracking-widest uppercase text-white/30">Institution / Organisation</label>
                            <input type="text" name="institution" value="{{ old('institution') }}" placeholder="General Hospital, Yaoundé"
                                class="cc-input w-full">
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[10px] font-extrabold tracking-widest uppercase text-white/30">Subject</label>
                            <div class="relative">
                                <select name="subject" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-[14px] font-medium text-white/70 appearance-none focus:border-indigo-500/50 outline-none transition-all">
                                    <option value="" class="bg-[#1a1d24]">Select a topic...</option>
                                    <option value="Enterprise Licensing" class="bg-[#1a1d24]">Enterprise Licensing</option>
                                    <option value="Technical Support" class="bg-[#1a1d24]">Technical Support</option>
                                    <option value="Deployment Inquiry" class="bg-[#1a1d24]">Deployment Inquiry</option>
                                    <option value="Partnership" class="bg-[#1a1d24]">Partnership Opportunity</option>
                                    <option value="Demo Request" class="bg-[#1a1d24]">Request a Demo</option>
                                    <option value="Other" class="bg-[#1a1d24]">Other</option>
                                </select>
                                <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none opacity-40">
                                    <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7"/></svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-[10px] font-extrabold tracking-widest uppercase text-white/30">Message *</label>
                        <textarea name="message" required rows="5" placeholder="Describe your institution's needs..."
                            class="cc-input w-full resize-none">{{ old('message') }}</textarea>
                        @error('message')<span class="text-[10px] text-rose-400 font-semibold">{{ $message }}</span>@enderror
                    </div>

                    <div class="flex items-center justify-between flex-wrap gap-4 pt-2">
                        <p class="text-[11px] text-white/25 font-medium">* Required fields. We never share your information.</p>
                        <button type="submit" class="cc-button-primary inline-flex items-center gap-2">
                            Send Message
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</section>

</x-public-shell>
