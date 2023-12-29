  document.addEventListener('DOMContentLoaded', function () {
    const currentStep = document.querySelector('.currentStep');

    if (currentStep) {
      // Trigger the transition by adding the "show" class after a short delay
      setTimeout(() => {
        currentStep.classList.add('show');
      }, 500); // Adjust the delay as needed
    }

    // Your existing JavaScript code...
  });