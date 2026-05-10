<?php if (isset($component)) { $__componentOriginalbc817d30aff94645282678110822d638 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbc817d30aff94645282678110822d638 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.public-shell','data' => ['title' => 'Contact — Opeshis OS']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('public-shell'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Contact — Opeshis OS']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>


<div class="pub-page-hero">
 <div class="pub-page-hero-inner">
 <span class="pub-tag">Get In Touch</span>
 <h1 class="pub-page-title">Contact<br>Our Team</h1>
 <p class="pub-page-desc">Have a question about deployment, licensing, or enterprise support? Our institutional team responds within one business day.</p>
 </div>
</div>

<section class="pub-section">
 <div class="pub-container">
 <div style="display:grid;gap:3rem;grid-template-columns:1fr;" >

 <div style="display:grid;gap:1.5rem;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));margin-bottom:1rem;">


 <div style="background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.07);border-radius:20px;padding:1.75rem;display:flex;flex-direction:column;gap:1rem;">
 <div style="width:42px;height:42px;background:rgba(99,102,241,.12);border:1px solid rgba(99,102,241,.2);border-radius:12px;display:flex;align-items:center;justify-content:center;">
 <svg width="18" height="18" fill="none" stroke="#818cf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81a19.79 19.79 0 01-3.07-8.68A2 2 0 012 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
 </div>
 <div>
 <div style="font-size:.6rem;font-weight:800;text-transform:uppercase;letter-spacing:.15em;color:rgba(255,255,255,.3);margin-bottom:.4rem;">Phone</div>
 <div style="font-size:.9rem;font-weight:700;color:#fff;">+237 6XX XXX XXX</div>
 <div style="font-size:.65rem;color:rgba(255,255,255,.3);margin-top:.25rem;">Mon–Fri, 8am–6pm WAT</div>
 </div>
 </div>


 <div style="background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.07);border-radius:20px;padding:1.75rem;display:flex;flex-direction:column;gap:1rem;">
 <div style="width:42px;height:42px;background:rgba(16,185,129,.1);border:1px solid rgba(16,185,129,.2);border-radius:12px;display:flex;align-items:center;justify-content:center;">
 <svg width="18" height="18" fill="none" stroke="#6ee7b7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
 </div>
 <div>
 <div style="font-size:.6rem;font-weight:800;text-transform:uppercase;letter-spacing:.15em;color:rgba(255,255,255,.3);margin-bottom:.4rem;">Email</div>
 <div style="font-size:.9rem;font-weight:700;color:#fff;">contact@opesware.com</div>
 <div style="font-size:.65rem;color:rgba(255,255,255,.3);margin-top:.25rem;">Response within 24 hours</div>
 </div>
 </div>


 <div style="background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.07);border-radius:20px;padding:1.75rem;display:flex;flex-direction:column;gap:1rem;">
 <div style="width:42px;height:42px;background:rgba(245,158,11,.1);border:1px solid rgba(245,158,11,.2);border-radius:12px;display:flex;align-items:center;justify-content:center;">
 <svg width="18" height="18" fill="none" stroke="#fcd34d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
 </div>
 <div>
 <div style="font-size:.6rem;font-weight:800;text-transform:uppercase;letter-spacing:.15em;color:rgba(255,255,255,.3);margin-bottom:.4rem;">Headquarters</div>
 <div style="font-size:.9rem;font-weight:700;color:#fff;">Douala, Cameroon</div>
 <div style="font-size:.65rem;color:rgba(255,255,255,.3);margin-top:.25rem;">Central Africa · WAT (UTC+1)</div>
 </div>
 </div>

 </div>


 <div style="background:rgba(255,255,255,.02);border:1px solid rgba(255,255,255,.07);border-radius:24px;padding:2.5rem;">
 <div style="margin-bottom:2rem;">
 <h2 style="font-size:1.4rem;font-weight:900;letter-spacing:-.03em;text-transform:uppercase;color:#fff;margin-bottom:.4rem;">Send a Message</h2>
 <p style="font-size:.75rem;color:rgba(255,255,255,.35);font-weight:400;">Tell us about your institution and requirements. Our enterprise team will follow up promptly.</p>
 </div>

 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
 <div style="background:rgba(16,185,129,.08);border:1px solid rgba(16,185,129,.25);border-radius:12px;padding:1rem 1.25rem;margin-bottom:1.5rem;display:flex;align-items:center;gap:.75rem;">
 <svg width="16" height="16" fill="none" stroke="#10b981" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
 <span style="font-size:.75rem;font-weight:700;color:#6ee7b7;text-transform:uppercase;letter-spacing:.06em;"><?php echo e(session('success')); ?></span>
 </div>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

 <form method="POST" action="<?php echo e(route('public.contact.submit')); ?>" style="display:grid;gap:1.25rem;">
 <?php echo csrf_field(); ?>
 <div style="display:grid;gap:1.25rem;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));">
 <div>
 <label style="display:block;font-size:.6rem;font-weight:800;letter-spacing:.15em;text-transform:uppercase;color:rgba(255,255,255,.3);margin-bottom:.5rem;">Full Name *</label>
 <input type="text" name="name" required value="<?php echo e(old('name')); ?>" placeholder="Dr. Jane Mbeki"
 style="width:100%;background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.08);border-radius:12px;padding:.8rem 1rem;font-size:.85rem;font-weight:500;color:#fff;font-family:'Inter',sans-serif;outline:none;transition:border-color .2s;"
 onfocus="this.style.borderColor='rgba(99,102,241,.5)'" onblur="this.style.borderColor='rgba(255,255,255,.08)'">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span style="font-size:.6rem;color:#f87171;font-weight:600;"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </div>
 <div>
 <label style="display:block;font-size:.6rem;font-weight:800;letter-spacing:.15em;text-transform:uppercase;color:rgba(255,255,255,.3);margin-bottom:.5rem;">Email Address *</label>
 <input type="email" name="email" required value="<?php echo e(old('email')); ?>" placeholder="name@institution.com"
 style="width:100%;background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.08);border-radius:12px;padding:.8rem 1rem;font-size:.85rem;font-weight:500;color:#fff;font-family:'Inter',sans-serif;outline:none;transition:border-color .2s;"
 onfocus="this.style.borderColor='rgba(99,102,241,.5)'" onblur="this.style.borderColor='rgba(255,255,255,.08)'">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span style="font-size:.6rem;color:#f87171;font-weight:600;"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </div>
 </div>

 <div style="display:grid;gap:1.25rem;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));">
 <div>
 <label style="display:block;font-size:.6rem;font-weight:800;letter-spacing:.15em;text-transform:uppercase;color:rgba(255,255,255,.3);margin-bottom:.5rem;">Institution / Organisation</label>
 <input type="text" name="institution" value="<?php echo e(old('institution')); ?>" placeholder="General Hospital, Yaoundé"
 style="width:100%;background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.08);border-radius:12px;padding:.8rem 1rem;font-size:.85rem;font-weight:500;color:#fff;font-family:'Inter',sans-serif;outline:none;transition:border-color .2s;"
 onfocus="this.style.borderColor='rgba(99,102,241,.5)'" onblur="this.style.borderColor='rgba(255,255,255,.08)'">
 </div>
 <div>
 <label style="display:block;font-size:.6rem;font-weight:800;letter-spacing:.15em;text-transform:uppercase;color:rgba(255,255,255,.3);margin-bottom:.5rem;">Subject</label>
 <select name="subject" style="width:100%;background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.08);border-radius:12px;padding:.8rem 1rem;font-size:.85rem;font-weight:500;color:rgba(255,255,255,.7);font-family:'Inter',sans-serif;outline:none;appearance:none;transition:border-color .2s;"
 onfocus="this.style.borderColor='rgba(99,102,241,.5)'" onblur="this.style.borderColor='rgba(255,255,255,.08)'">
 <option value="">Select a topic...</option>
 <option value="Enterprise Licensing">Enterprise Licensing</option>
 <option value="Technical Support">Technical Support</option>
 <option value="Deployment Inquiry">Deployment Inquiry</option>
 <option value="Partnership">Partnership Opportunity</option>
 <option value="Demo Request">Request a Demo</option>
 <option value="Other">Other</option>
 </select>
 </div>
 </div>

 <div>
 <label style="display:block;font-size:.6rem;font-weight:800;letter-spacing:.15em;text-transform:uppercase;color:rgba(255,255,255,.3);margin-bottom:.5rem;">Message *</label>
 <textarea name="message" required rows="5" placeholder="Describe your institution's needs, number of beds, departments, or any specific requirements..."
 style="width:100%;background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.08);border-radius:12px;padding:.8rem 1rem;font-size:.85rem;font-weight:500;color:#fff;font-family:'Inter',sans-serif;outline:none;resize:vertical;transition:border-color .2s;"
 onfocus="this.style.borderColor='rgba(99,102,241,.5)'" onblur="this.style.borderColor='rgba(255,255,255,.08)'"><?php echo e(old('message')); ?></textarea>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span style="font-size:.6rem;color:#f87171;font-weight:600;"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </div>

 <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;padding-top:.5rem;">
 <p style="font-size:.65rem;color:rgba(255,255,255,.25);font-weight:500;">* Required fields. We never share your information.</p>
 <button type="submit" style="display:inline-flex;align-items:center;gap:.6rem;padding:.9rem 2rem;background:linear-gradient(135deg,#6366f1,#4f46e5);border:none;border-radius:14px;font-size:.7rem;font-weight:800;letter-spacing:.15em;text-transform:uppercase;color:#fff;font-family:'Inter',sans-serif;cursor:pointer;transition:all .2s;box-shadow:0 4px 24px rgba(99,102,241,.35);"
 onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 36px rgba(99,102,241,.5)'"
 onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 4px 24px rgba(99,102,241,.35)'">
 Send Message
 <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
 </button>
 </div>
 </form>
 </div>

 </div>
 </div>
</section>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbc817d30aff94645282678110822d638)): ?>
<?php $attributes = $__attributesOriginalbc817d30aff94645282678110822d638; ?>
<?php unset($__attributesOriginalbc817d30aff94645282678110822d638); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbc817d30aff94645282678110822d638)): ?>
<?php $component = $__componentOriginalbc817d30aff94645282678110822d638; ?>
<?php unset($__componentOriginalbc817d30aff94645282678110822d638); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\opeshis\resources\views\public\contact.blade.php ENDPATH**/ ?>