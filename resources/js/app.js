import './bootstrap';

// Initialize Dropify for file upload styling (only when present)
document.addEventListener('DOMContentLoaded', function() {
    if (typeof $ !== 'undefined' && $.fn.dropify) {
        $('.dropify').dropify();
    }
});
