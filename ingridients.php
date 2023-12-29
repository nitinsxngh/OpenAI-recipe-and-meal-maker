<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
        /* general styles */
        html,
        body {
            font-family: "Roboto", sans-serif;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 24px;
            position: relative;
        }

        /* to dos styles */
        .ingredients {
            width: 340px;
            background-color: #fff;
            border-radius: 5px;
            color: #3e5481;
            padding-top: 100px;
            padding-bottom: 200px;
        }

        .ingredientsContainer {
            margin-top: 180px;
        }

        .ingredients-entry {
            position: relative;
            margin-bottom: 20px;
            border: 1px solid #e1e1e1;
            padding: 20px;
            border-radius: 30px;
        }

        .ingredients-entry:nth-of-type(1) {
            margin-top: 30px;
        }

        .ingredients-entry:nth-of-type(4) {
            margin-bottom: 30px;
        }

        .day {
            font-weight: 600;
            font-size: 24px;
            line-height: 30px;
            margin: 20px 0 0;
        }

        .date {
            font-size: 14px;
            line-height: 18px;
            margin: 0 30px 0 30px;
            padding-bottom: 20px;
        }

        /* default checkbox styles */
        input[type="checkbox"] {
            position: absolute;
            right: 9000px;
        }

        input[type="checkbox"] + .label-text {
            position: relative;
            color: #497081;
            cursor: pointer;
            font-size: 13px;
            line-height: 14px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.5s ease-in-out;

            &::after {
                content: "";
                border-radius: 50%;
                border: 1px solid #497081;
                width: 16px;
                height: 16px;
                transform: scale(1);
                transition: all 0.5s ease-in-out 0.4s;
            }

            .checkmark {
                position: absolute;
                top: 4px;
                right: 2px;
                stroke: #c8d4d9;
                fill: none;
                stroke-width: 1.5;
                stroke-dasharray: 30 30;
                stroke-dashoffset: 30;
                transition: all 0.5s ease-in-out;
            }
        }

        /* checked checkbox styles */
        input[type="checkbox"]:checked + .label-text {
            color: #c8d4d9;

            &::after {
                border: 1px solid transparent;
                transform: scale(1.2);
                transition: all 0.5s ease-in-out;
            }

            .checkmark {
                stroke-dashoffset: 0;
                transition: all 0.5s ease-in-out 0.4s;
            }
        }

        /* Hide first two ingredients-entry elements */
        .ingredients-entry:nth-child(-n+2) {
            display: none;
        }

        .pad {
            height: 170px;
            width: 90%;
            margin: auto;
            background-color: #f1f1f1;
            position: fixed;
            bottom: 25px;
            border-radius: 20px;
            display: flex;
            flex-direction: column; /* Stack buttons vertically */
            justify-content: center; /* Center the buttons vertically */
            align-items: center;
        }

        .pad button {
            margin-bottom: 10px; /* Add some space between the buttons */
            padding: 10px 40px;
            font-size: 16px;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out;
        }

        .pad button#button1 {
            background-color: #3498db;
            color: #fff;
        }

        .pad button#button2 {
            background-color: #2ecc71;
            color: #fff;
        }

        .pad button:hover {
            background-color: #2c3e50;
        }

.wrap{
    position: absolute;
    /* margin: auto; */
    width: 60px;
    height: 180px;
    left: 18px;
    top: 0px !important;
}

    </style>
</head>
<body>
    <div class="ingredients">
        <div style="height: 120px; width: 370px; margin: auto; position: absolute;">
          <?php include"animation.html"; ?>
          <b style="font-size: 18px; position: absolute; width: 260px; margin-left: 120px;" class="diet-preference-label" id="typewriter"></b>
        </div>
        <!--<p class="date">As per your conversation, here are the suggested ingredients you can use:</p>-->
        <div id="ingredientsContainer" class="ingredientsContainer"></div>
    </div>

    <div class="pad" style="">
<!-- First Button -->
<button id="button1" onclick="generateMeals(1)">Generate Meals</button>

        <!-- Second Button -->
        <button id="button2" onclick="generateMealPlan(2)">Generate Meal Plan</button>
    </div>

    <script>
// Function to generate a random string
function generateRandomString(length) {
    const characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
    let result = '';
    for (let i = 0; i < length; i++) {
        result += characters.charAt(Math.floor(Math.random() * characters.length));
    }
    return result;
}

// Function to extract parameter values from the URL
function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}

// Function to log ingredients on the console and send data to the server
function logIngredientsAndSendToServer() {
    // Extract all ingredients and their respective IDs
    const allIngredients = document.querySelectorAll('.ingredients-entry');

    // Create an array to store ingredient information
    const ingredientsArray = [];

    // Loop through each ingredient, exclude the first two elements, and store its ID and text in the array
    for (let i = 2; i < allIngredients.length; i++) {
        const ingredient = allIngredients[i];
        const checkbox = ingredient.querySelector('input[type="checkbox"]');
        const label = ingredient.querySelector('.label-text');

        const ingredientInfo = {
            id: checkbox.id,
            name: label.textContent.trim().replace(/^\d+\.\s*/, ''), // Remove numbering
        };

        ingredientsArray.push(ingredientInfo);
    }

    // Extracting parameter values
    const selectedContinent = getParameterByName('continent');
    const selectedCountry = getParameterByName('country');
    const selectedDiet = getParameterByName('preference');
    const selectedDiabeticStatus = getParameterByName('medical-condition');
    const selectedMajorMedicalCondition = getParameterByName('major-medical-condition');
    const selectedCookingType = getParameterByName('cooking');
    const selectedTasteType = getParameterByName('taste');

    // Additional data to be sent to the server
    const additionalData = {
        selectedContinent,
        selectedCountry,
        selectedDiet,
        selectedDiabeticStatus,
        selectedMajorMedicalCondition,
        selectedCookingType,
        selectedTasteType,
    };

    // Log the array and additional data to the console
    console.log("Ingredients Array:", ingredientsArray);
    console.log("Additional Data:", additionalData);

    // Use AJAX to send data to the server
    const xhr = new XMLHttpRequest();
    const url = 'server/serv-ingredients.php'; // Replace with the actual server-side PHP script URL

    // Set up the request
    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-Type', 'application/json');

    // Convert the array and additional data to JSON and send it in the request body
    xhr.send(JSON.stringify({ ingredients: ingredientsArray, ...additionalData }));

    // Log a message when the data is successfully sent
    xhr.onload = function () {
        if (xhr.status === 200) {
            console.log('Data sent successfully to the server.');
        } else {
            console.error('Error sending data to the server.');
        }
    };
}

// Call the function to log ingredients and send data to the server after they are loaded
logIngredientsAndSendToServer();



// Extracting parameter values
const selectedContinent = getParameterByName('continent');
const selectedCountry = getParameterByName('country');
const selectedDiet = getParameterByName('preference');
const selectedDiabeticStatus = getParameterByName('medical-condition');
const selectedMajorMedicalCondition = getParameterByName('major-medical-condition');
const selectedCookingType = getParameterByName('cooking');
const selectedTasteType = getParameterByName('taste');

// Constructing the prompt for ChatGPT API
const prompt = `Find 10 best ingredients name for a dish that suits the following preferences remove spices and basic ingredients:
    - Continent: ${selectedContinent}
    - Country: ${selectedCountry}
    - Dietary Preference: ${selectedDiet}
    - Diabetic Status: ${selectedDiabeticStatus}
    - Any Major Medical Condition: ${selectedMajorMedicalCondition}
    - Cooking Type: ${selectedCookingType}
    - Taste Type: ${selectedTasteType}`;

// Define your API endpoint
const apiEndpoint = 'https://api.openai.com/v1/completions';

// Define other parameters like API key and max tokens
const apiKey = 'OPEN_AI-API';
const maxTokens = 100;

// Fetch ingredients from the ChatGPT API
fetch(apiEndpoint, {
    method: "POST",
    headers: {
        "Authorization": `Bearer ${apiKey}`,
        "Content-Type": "application/json",
    },
    body: JSON.stringify({
        model: "text-davinci-003",
        prompt,
        max_tokens: maxTokens,
    }),
})
    .then(response => response.json())
    .then(data => {
        // Displaying ingredients in the HTML
        const ingredientsContainer = document.getElementById('ingredientsContainer');

        // Split the text into lines
        const ingredientsArray = data.choices[0].text.split('\n');

        // Create a div for each ingredient
        ingredientsArray.forEach(ingredientText => {
            const randomId = generateRandomString(6); // Generate a random string for ID
            const ingredientDiv = document.createElement('div');
            ingredientDiv.className = 'ingredients-entry'; // Use the existing class
            ingredientDiv.innerHTML = `
                <input type="checkbox" name="check" id="${randomId}">
                <label for="${randomId}" class="label-text">${ingredientText.trim()}
                    <svg width="15px" height="10px" class="checkmark">
                        <polyline points="1,5 6,9 14,1" />
                    </svg>
                </label>
            `;

            // Add event listener to the checkbox
            const checkbox = ingredientDiv.querySelector('input[type="checkbox"]');
            checkbox.addEventListener('change', () => {
                // Log a message to the console when the checkbox is checked or unchecked
                console.log(`Checkbox with ID ${checkbox.id} is ${checkbox.checked ? 'checked' : 'unchecked'}`);
            });

            ingredientsContainer.appendChild(ingredientDiv);
        });

        // Call the function to log ingredients after they are loaded
        //logIngredients();
        logIngredientsAndSendToServer();

    })
    .catch(error => console.error('Error:', error));

    </script>

<script type="text/javascript">
    
// Function to generate meals and redirect
function generateMeals(buttonId) {
    // Extracting parameter values
    const selectedContinent = getParameterByName('continent');
    const selectedCountry = getParameterByName('country');
    const selectedDiet = getParameterByName('preference');
    const selectedDiabeticStatus = getParameterByName('medical-condition');
    const selectedMajorMedicalCondition = getParameterByName('major-medical-condition');
    const selectedCookingType = getParameterByName('cooking');
    const selectedTasteType = getParameterByName('taste');

    // Extract all checked ingredients
    const checkedIngredients = document.querySelectorAll('.ingredients-entry input[type="checkbox"]:checked');

    // Create an array to store checked ingredient names
    const checkedIngredientsArray = Array.from(checkedIngredients).map(checkbox => {
        const label = checkbox.closest('.ingredients-entry').querySelector('.label-text');
        return label.textContent.trim().replace(/^\d+\.\s*/, ''); // Remove numbering
    });

    // Construct the URL with parameters
    const url = `explore.php?continent=${selectedContinent}&country=${selectedCountry}&preference=${selectedDiet}&medical-condition=${selectedDiabeticStatus}&major-medical-condition=${selectedMajorMedicalCondition}&cooking=${selectedCookingType}&taste=${selectedTasteType}&checkedIngredients=${checkedIngredientsArray.join(',')}`;

    // Log the data to the console
    console.log("Redirecting to:", url);

    // Redirect to the explore.php page with parameters
    window.location.href = url;
}

</script>

  <script>
    const text = "As per your conversation, here are the suggested ingredients you can use:";
    const delay = 40;
    const typewriterElement = document.getElementById("typewriter");

    function typeWriter() {
      let i = 0;
      function type() {
        if (i < text.length) {
          typewriterElement.innerHTML += text.charAt(i);
          i++;
          setTimeout(type, delay);
        } else {
          // Typewriter effect is complete, delay the drop-from-top animation by 1 second
          setTimeout(() => {

          }, 1000);
        }
      }
      type();
    }

    typeWriter();
  </script>

</body>
</html>
