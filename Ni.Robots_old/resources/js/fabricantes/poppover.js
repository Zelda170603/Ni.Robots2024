document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('[data-popover-target]').forEach(button => {
        button.addEventListener('click', function() {
            const popoverId = this.getAttribute('data-popover-target');
            const popover = document.getElementById(popoverId);

            if (popover) {
                popover.classList.toggle('invisible');
                popover.classList.toggle('opacity-100');
                popover.classList.toggle('opacity-0');
            }
        });
    });

    document.addEventListener('click', function(event) {
        if (!event.target.matches('[data-popover-target]') && !event.target.closest(
                '[data-popover]')) {
            document.querySelectorAll('[data-popover]').forEach(popover => {
                popover.classList.add('invisible');
                popover.classList.remove('opacity-100');
                popover.classList.add('opacity-0');
            });
        }
    });
});