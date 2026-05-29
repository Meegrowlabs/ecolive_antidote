<?php
/**
 * Visual contact form (placeholder).
 *
 * This renders only when ECOLIVE_CONTACT_FORM is not defined. To make the
 * form actually send mail, install Contact Form 7, create a form, and define
 * its shortcode, e.g. in wp-config.php:
 *   define('ECOLIVE_CONTACT_FORM', '[contact-form-7 id="123" title="Contact"]');
 *
 * @package ecolive-organic
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
<form data-demo-form class="space-y-6">
  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="space-y-2"><label class="text-xs font-bold text-primary uppercase tracking-widest ml-1">Name</label><input name="name" autocomplete="name" required class="w-full px-6 py-4 rounded-lg bg-surface-container-low border border-outline-variant/20 focus:border-secondary focus:ring-0 transition-all" placeholder="John Doe" type="text"/></div>
    <div class="space-y-2"><label class="text-xs font-bold text-primary uppercase tracking-widest ml-1">Phone</label><input name="phone" autocomplete="tel" inputmode="tel" required class="w-full px-6 py-4 rounded-lg bg-surface-container-low border border-outline-variant/20 focus:border-secondary focus:ring-0 transition-all" placeholder="+91" type="tel"/></div>
  </div>
  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="space-y-2"><label class="text-xs font-bold text-primary uppercase tracking-widest ml-1">Email</label><input name="email" type="email" autocomplete="email" class="w-full px-6 py-4 rounded-lg bg-surface-container-low border border-outline-variant/20 focus:border-secondary focus:ring-0 transition-all" placeholder="john@company.com"/></div>
    <div class="space-y-2"><label class="text-xs font-bold text-primary uppercase tracking-widest ml-1">Site type</label><select name="site-type" required class="w-full px-6 py-4 rounded-lg bg-surface-container-low border border-outline-variant/20 focus:border-secondary focus:ring-0 transition-all"><option value="">Select one</option><option>Home / villa</option><option>Apartment / RWA</option><option>Institution</option><option>Commercial / industrial</option></select></div>
  </div>
  <div class="space-y-2"><label class="text-xs font-bold text-primary uppercase tracking-widest ml-1">What should we help with?</label><textarea name="message" rows="4" class="w-full px-6 py-4 rounded-lg bg-surface-container-low border border-outline-variant/20 focus:border-secondary focus:ring-0 transition-all" placeholder="Leakage, RO reject, RWH/GWR, STP reuse, audit, compliance or water balance"></textarea></div>
  <button type="submit" class="w-full btn-primary-gradient text-on-primary py-4 rounded-full font-bold text-lg hover:shadow-[0_15px_40px_rgba(24,28,27,0.18)] hover:-translate-y-1 transition-all active:scale-95">Request assessment</button>
  <p role="status" aria-live="polite" class="text-center text-sm font-semibold text-secondary hidden"></p>
</form>
