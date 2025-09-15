document.addEventListener('DOMContentLoaded', function () {
    let currentStep = 1;
    const totalSteps = 3;
    const progressBar = document.getElementById('progress-bar');

    const prevBtn = document.getElementById('prev-btn');
    const nextBtn = document.getElementById('next-btn');
    const finishBtn = document.getElementById('finish-btn');

    function updateStepDisplay() {
        const stepWidth = 100 / totalSteps;
        const progressPercentage = (currentStep - 1) * stepWidth;
        progressBar.style.width = `${progressPercentage + stepWidth}%`;

        for (let i = 1; i <= totalSteps; i++) {
            const content = document.getElementById(`step-${i}-content`);
            const nav = document.getElementById(`step-${i}-nav`);
            const icon = document.getElementById(`step-${i}-icon`);

            if (i === currentStep) {
                content.style.display = 'flex';
                nav.querySelector('div').classList.add('bg-blue-200', 'dark:bg-blue-700');
                icon.classList.add('text-blue-600', 'dark:text-blue-300');
            } else {
                content.style.display = 'none';
                nav.querySelector('div').classList.remove('bg-blue-200', 'dark:bg-blue-700');
                icon.classList.remove('text-blue-600', 'dark:text-blue-300');
            }

            if (i <= currentStep) {
                nav.querySelector('div').classList.add('bg-blue-200', 'dark:bg-blue-700');
                icon.classList.add('text-blue-600', 'dark:text-blue-300');
            } else {
                nav.querySelector('div').classList.remove('bg-blue-200', 'dark:bg-blue-700');
                icon.classList.remove('text-blue-600', 'dark:text-blue-300');
            }
        }

        prevBtn.disabled = currentStep === 1;
        nextBtn.style.display = currentStep === totalSteps ? 'none' : 'inline-flex';
        finishBtn.style.display = currentStep === totalSteps ? 'inline-flex' : 'none';
    }

    nextBtn.addEventListener('click', () => {
        if (currentStep < totalSteps) {
            currentStep++;
            updateStepDisplay();
            window.scrollTo(0, 0); // Desplazarse al inicio
        }
    });

    prevBtn.addEventListener('click', () => {
        if (currentStep > 1) {
            currentStep--;
            updateStepDisplay();
            window.scrollTo(0, 0); // Desplazarse al inicio
        }
    });

    updateStepDisplay(); // Initial call to set up the stepper
});

