<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./index.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@500;700&display=swap">
  <script src="index.js"></script>
  <style>

    .suggestions {
      position: absolute;
      width: 350px;
      background-color: #fff;
      z-index: 1;
      top: 130px;
      display: none;
    }

    .suggestion-item {
      padding: 10px;
      cursor: pointer;
      transition: background-color 0.3s ease; /* Add a smooth transition for background color change */
    }

    .suggestion-item:hover {
      background-color: #f0f0f0;
    }

    .bottom-div.fadeOut {
     opacity: 0;
     transition: opacity 0.3s ease-out; /* Adjust the transition duration as needed */
    }

    /* Add CSS for the drop-from-top animation */
    .label {
      opacity: 0;
      transform: translateY(-50px);
      transition: opacity 0.5s ease-in-out, transform 0.5s ease-in-out;
    }

    .selected {
      background-color: #3498db; /* Set your desired background color */
      color: #fff; /* Set your desired text color */
    }

    .bottom-div {
      height: 400px;
      width: 100%;
      position: fixed;
      background-color: #f1f1f1;
      bottom: 0;
      left: 0;
      border-top-left-radius: 40px;
      border-top-right-radius: 40px;
      transition: transform 0.3s ease-out; /* Add a smooth transition */
      transform: translateY(400px); /* Start off-screen */
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }

    .bottom-div input[type="text"] {
      width: 330px;
      padding: 22.5px;
      margin: 20px auto 225px auto;
      border-radius: 30px;
      border: none;
      outline: none;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }


    /* Styles for the suggestion container */
    .suggestion-medical-condition {
      max-height: 200px; /* Set a max height for the suggestion container */
      overflow-y: auto; /* Enable vertical scrolling if the suggestions exceed the max height */
    }

    /* Optional: Style for scrollbar */
    .suggestion-medical-condition::-webkit-scrollbar {
      width: 8px;
    }

    .suggestion-medical-condition::-webkit-scrollbar-thumb {
      background-color: #ccc;
      border-radius: 4px;
    }

    .suggestion-medical-condition::-webkit-scrollbar-track {
      background-color: #f1f1f1;
    }
  </style>
<script>
document.addEventListener('DOMContentLoaded', function () {
  const options = document.querySelectorAll('.label');
  const bottomDiv = document.querySelector('.bottom-div');
  const searchInput = document.querySelector('input[name="search-medical-condition"]');
  const medicalConditionNameInput = document.getElementById('medical-condition-name');
  const suggestionsContainer = document.createElement('div');
  suggestionsContainer.classList.add('suggestions');
  bottomDiv.appendChild(suggestionsContainer);

  // Fetch medical conditions from JSON file
  fetch('medical-condition.json')
    .then(response => {
      if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
      }
      return response.json();
    })
    .then(data => {
      const medicalConditions = data.map(item => item.disease);

      searchInput.addEventListener('input', function () {
        const inputValue = this.value.toLowerCase();
        const filteredConditions = medicalConditions.filter(condition =>
          condition.toLowerCase().includes(inputValue)
        );

        displaySuggestions(filteredConditions);
      });
    })
    .catch(error => console.error('Error fetching medical conditions:', error));

  function displaySuggestions(conditions) {
    // Clear previous suggestions
    suggestionsContainer.innerHTML = '';

    // Display new suggestions
    if (searchInput.value.length > 2) {
      const filteredConditions = conditions.filter(condition => condition.length > 2).slice(0, 5);

      filteredConditions.forEach(condition => {
        const suggestionItem = createSuggestionItem(condition);
        suggestionsContainer.appendChild(suggestionItem);
      });

      // Append suggestions to the "suggestion-medical-condition" div
      const suggestionMedicalConditionDiv = document.querySelector('.suggestion-medical-condition');
      suggestionMedicalConditionDiv.innerHTML = '';
      filteredConditions.forEach(condition => {
        const suggestionItem = createSuggestionItem(condition);
        suggestionMedicalConditionDiv.appendChild(suggestionItem);
      });

      // Show suggestions container
      suggestionsContainer.style.display = 'block';
    } else {
      // Hide suggestions container if search input is empty or less than 3 characters
      suggestionsContainer.style.display = 'none';
    }
  }

  function createSuggestionItem(condition) {
    const suggestionItem = document.createElement('div');
    suggestionItem.classList.add('suggestion-item');
    suggestionItem.textContent = condition;

    suggestionItem.addEventListener('click', function () {
      // Set the selected suggestion as the input value
      searchInput.value = condition;

      // Change the text of the "Search" option to the selected medical condition name
      document.getElementById('search-pad').textContent = condition;

      // Clear suggestions
      suggestionsContainer.innerHTML = '';
      document.querySelector('.suggestion-medical-condition').innerHTML = '';

      // Hide the bottom-div
      bottomDiv.classList.add('fadeOut');
      setTimeout(() => {
        bottomDiv.style.display = 'none';
      }, 1000); // Assuming the transition duration is 0.3s
    });

    return suggestionItem;
  }

  options.forEach(option => {
    option.addEventListener('click', function () {
      // Ignore the "Search" option
      if (this.classList.contains('ignore')) {
        return;
      }

      options.forEach(otherOption => {
        otherOption.classList.remove('selected');
      });

      this.classList.add('selected');
    });
  });

  // Get the "Next" button
  const nextButton = document.querySelector('.primary-btn-1');

  if (nextButton) {
    nextButton.addEventListener('click', function () {
      const urlParams = new URLSearchParams(window.location.search);
      const continent = urlParams.get('continent');
      const country = urlParams.get('country');
      const preference = urlParams.get('preference');

      const selectedOption = document.querySelector('.selected');
      let medicalCondition;

      if (selectedOption && !selectedOption.classList.contains('ignore')) {
        medicalCondition = selectedOption.textContent.trim().toLowerCase();
      } else {
        const inputValue = searchInput.value.trim().toLowerCase();

        if (inputValue.length < 3) {
          alert('Please enter at least 3 characters for the medical condition.');
          return;
        }

        medicalCondition = inputValue;
      }

      // Extract the value from the "medical-condition-name" input field
      const majorMedicalCondition = encodeURIComponent(medicalConditionNameInput.value.trim().toLowerCase());

      // Debugging: Log the selected medical condition and major medical condition
      console.log('Selected Medical Condition:', medicalCondition);
      console.log('Major Medical Condition:', majorMedicalCondition);

      const nextPageUrl = `step-4.php?continent=${encodeURIComponent(continent)}&country=${encodeURIComponent(country)}&preference=${encodeURIComponent(preference)}&medical-condition=${encodeURIComponent(medicalCondition)}&major-medical-condition=${majorMedicalCondition}`;

      console.log('Next Page URL:', nextPageUrl);

      window.location.href = nextPageUrl;
    });
  } else {
    console.error('Next button not found');
  }

  // Function to animate the bottom div
  function animateBottomDiv() {
    bottomDiv.style.transform = 'translateY(0)';
  }

  // Add a click event listener to the element with the ID 'search-pad'
  const searchPad = document.getElementById('search-pad');
  if (searchPad) {
    searchPad.addEventListener('click', function () {
      // Toggle the visibility of the bottom div
      bottomDiv.classList.toggle('show');

      // If the bottom div is visible, delay the animation for better visibility
      if (bottomDiv.classList.contains('show')) {
        setTimeout(animateBottomDiv, 500); // Delay for 500 milliseconds (adjust as needed)
      }
    });
  } else {
    console.error('Element with ID "search-pad" not found');
  }
});

</script>
</head>

<body>
  <div class="upload-container-2">
    <div class="frame-container">
      <div class="header-container">
        <!--
        <img style="display: none;" class="header-icon" alt="" src="./public/header-bar.svg" />
        <b class="step-counter" id="stepCounter"><span class="currentStep">3</span>/4</b>
        <b class="cancel-btn">Cancel</b>
        --->
      </div>
      <div style="height: 120px; width: 370px; margin: auto; position: absolute;">
       <?php include"animation.html"; ?>
       <b class="diet-preference-label" id="typewriter"></b>
      </div>
    </div>
    <div class="frame-1">
      <div class="frame-2">
        <div class="option-item-1 label">Dibateic</div>
        <div class="option-item-2 label">Non-Dibateic</div>
        <div id="search-pad" class="option-item-4 label ignore">Search</div>
        <div class="spacing-line"></div>
      </div>
      <div class="pad-container">
        <div class="secondary-container">
          <button class="primary-btn-2" onclick="goBack()">
            <b class="back-txt">Back</b>
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

  <div class="bottom-div">
    <!-- Content of the bottom div -->
    <input type="text" id="medical-condition-name" name="search-medical-condition" placeholder="Type your search..." />
    <div style="display: none;" class="suggestion-medical-condition"></div>
  </div>
</body>

</html>

<script>
    function goBack() {
      window.history.back();
    }
</script>


<script>
  const text = "Your health is a priority for me. So do you have any significant medical conditions to share with me";
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
