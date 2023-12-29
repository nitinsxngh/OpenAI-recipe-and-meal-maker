<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./index.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@500;700&display=swap">
  <script src="index.js"></script>
  <style>

    body {
      overflow-x: hidden;
      margin: 0;
      padding: 0;
      width: 100vw;
      height: 100vh;
      position: absolute;
      animation: slideIn 0.8s ease-out forwards;
      animation-delay: 0.1s;
    }

    @keyframes slideIn {
      from {
        transform: translateX(100vw);
      }
      to {
        transform: translateX(0);
      }
    }

    .label.selected {
      background-color: #3498db; /* Change to the desired background color */
      color: #fff; /* Change to the desired text color */
    }

    /* Add CSS for the drop-from-top animation */
    .label {
      opacity: 0;
      transform: translateY(-50px);
      transition: opacity 0.5s ease-in-out, transform 0.5s ease-in-out;
    }

  </style>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const options = document.querySelectorAll('.label');

      options.forEach((option, index) => {
        // Apply a delay to each option
        option.style.transitionDelay = `${0.1 * index}s`;

        option.addEventListener('click', function() {
          options.forEach(otherOption => {
            otherOption.classList.remove('selected');
          });

          this.classList.add('selected');
        });
      });

      // Get the "Next" button
      const nextButton = document.querySelector('.primary-btn-1');

      // Add a click event listener to the "Next" button
      if (nextButton) {
        nextButton.addEventListener('click', function (event) {
          // Extract data from the URL parameters
          const urlParams = new URLSearchParams(window.location.search);
          const continent = urlParams.get('continent');
          const country = urlParams.get('country');

          // Get the selected dietary preference
          const selectedOption = document.querySelector('.selected');

          // Check if a preference is selected
          if (!selectedOption) {
            alert('Please choose a dietary preference before proceeding.');
            return;
          }

          const dietaryPreference = selectedOption.textContent.toLowerCase();

          // Build the URL for the next step
          const nextPageUrl = `step-3.php?continent=${encodeURIComponent(continent)}&country=${encodeURIComponent(country)}&preference=${encodeURIComponent(dietaryPreference)}`;

          // Redirect to the next step
          window.location.href = nextPageUrl;
        });
      } else {
        console.error('Next button not found');
      }
    });
  </script>

</head>
<body>
  <div class="upload-container-2">
    <div class="frame-container">
      <div class="header-container">
      </div>
      <div style="height: 120px; width: 370px; margin: auto; position: absolute;">
       <?php include"animation.html"; ?>
       <b class="diet-preference-label" id="typewriter"></b>
      </div>
    </div>
    <div class="frame-1">
      <div class="frame-2">
        <div class="option-item-1 label">Vegetarian</div>
        <div class="option-item-2 label">Non-vegetarian</div>
        <div class="option-item-3 label">Eggetarian</div>
        <div class="option-item-4 label">Vegan</div>
        <div class="spacing-line"></div>
      </div>
      <div class="pad-container">
        <div class="secondary-container">
          <button class="primary-btn-2">
            <b class="back-txt" onclick="goBack()">Back</b>
          </button>
        </div>
        <div class="primary-container">
          <button class="primary-btn-1">
            <b class="back-txt">Next</b>
          </button>
        </div>
      </div>
    </div>
  </div>
</body>
</html>

<script>
    function goBack() {
      window.history.back();
    }
</script>

<script>
  const text = "Awesome! You've picked your country and continent. Now, Can I know are you";
  const delay = 40;
  const typewriterElement = document.getElementById("typewriter");
  const options = document.querySelectorAll('.label');

  function typeWriter() {
    let i = 0;
    function type() {
      if (i < text.length) {
        typewriterElement.innerHTML += text.charAt(i);
        i++;
        setTimeout(type, delay);
      } else {
        // Typewriter effect is complete, start the drop-from-top animation for options
        options.forEach((option, index) => {
          setTimeout(() => {
            option.style.opacity = "1";
            option.style.transform = "translateY(0)";
          }, 800 * index); // Adjust the delay for each option
        });
      }
    }
    type();
  }

  typeWriter();
</script>
