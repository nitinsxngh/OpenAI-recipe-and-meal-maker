<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore</title>

</head>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #ffffff;
        margin: 0;
        padding: 0;
        border: 0;
    }

    h1 {
        text-align: center;
    }

    h2 {
        margin-top: 10px;
    }

     .genie-data {
      height: 120px; width: 370px; margin: auto; position: absolute;
      }

     .genie-text {
        font-size: 18px; position: absolute; width: 260px; top: 70px; margin-left: 120px;
     }

    .container {
        width: 370px; /* Adjust the max-width as needed for larger screens */
        margin: 0 auto;
        padding: 2px;
    }

    .output {
        padding: 2px;
        margin-top: 180px;
    }

    /* Apply styles to the product card container */
    #productCardContainer {
        border-radius: 8px;
        padding: 10px;
        margin: 10px;
        width: 140px; /* Adjust the width as needed */
    }

    /* Style the meal image icon */
    .meal-image-icon {
        width: 100%;
        height: auto;
        border-radius: 8px;
    }

    /* Style the like icon and box */
    .like-box {
        display: flex;
        justify-content: flex-end;
        margin-top: -30px;
    }

    .like-icon {
        width: 24px;
        height: auto;
    }

    /* Style the meal name */
    .meal-name {
        display: block;
        font-size: 16px;
        margin-top: 8px;
        font-weight: bold;
    }

    /* Style the meal type */
    .meal-type {
        margin-top: 8px;
    }

    .breakfast {
        background-color: #f8d7da;
        color: #721c24;
        padding: 4px 8px;
        border-radius: 4px;
        display: inline-block;
        margin: 5px 0px;
    }

    /* Style the subtitle */
    .subtitle {
        display: flex;
        align-items: center;
        margin-top: 8px;
        font-size: 13px;
    }

    /* Style the type and dot in the subtitle */
    .type {
        margin-right: 4px;
        color: #555;
    }

    .dot {
        width: 4px;
        height: 4px;
        background-color: #555;
        border-radius: 50%;
        margin-right: 4px;
    }

    .meals-columns {
        display: flex;
        flex-wrap: wrap;
        justify-content: center; /* Add this to center the items horizontally */
        align-items: center; /* Add this to center the items vertically */
        margin: auto;
    }

    .meals-left-column,
    .meals-right-column {
        width: 100%; /* Full width initially */
        margin-bottom: 10px;
    }

    .meals-right-column {
        margin-left: 0; /* No left margin initially */
    }

    .meals {
        border-radius: 5px;
        box-sizing: border-box;
    }

    .product-card {
        margin-top: 20px;
        background-color: #fff;
        padding: 16px;
        border-radius: 8px;
        cursor: pointer;
    }

    /* Media query for screens larger than 600px */
    @media (min-width: 600px) {

      .genie-data {
        height: 120px;
        width: 370px;
        margin: auto;
        position: absolute;
        left: 118px;
      }

        .genie-text {
        font-size: 18px; position: absolute; width: 100%; top: 70px; margin-left: 120px;
        }

       .container {
        width: 100%; /* Adjust the max-width as needed for larger screens */
        margin: 0 auto;
        padding: 2px;
       }


        .meals-left-column,
        .meals-right-column {
            width: calc(50% - 10px); /* Two columns with margin */
            margin-right: 10px;
        }

        .meals-right-column {
            margin-left: 10px;
        }

        /* Apply styles to the product card container */
        #productCardContainer {
            width: 200px; /* Adjust the width as needed */
        }
    }

    /* Loader styles */
    .loader-container {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.8);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    .loader {
        border: 8px solid #f3f3f3;
        border-top: 8px solid #3498db;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Animation styles */
    @keyframes typewriter {
        from {
            width: 0;
            opacity: 0;
        }
        to {
            width: 140px;
            opacity: 1;
        }
    }

    @keyframes fade {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    .typewriter-fade-animation {
        animation: typewriter 1s steps(40) 1s 1 normal both, fade 1s ease-in-out;
    }



</style>



<body>

    <!-- Loader container -->
    <div class="loader-container" id="loaderContainer">
        <div class="loader"></div>
    </div>

    <div class="container">
        <div class="genie-data" style="">
          <?php include"animation.html"; ?>
          <b class="genie-text" style="" class="diet-preference-label" id="typewriter"></b>
        </div>
<div class="output">
    <?php
    if ($_SERVER["REQUEST_METHOD"] === "GET") {
        // Extract URL parameters
        $continent = $_GET["continent"] ?? "";
        $country = $_GET["country"] ?? "";
        $preference = $_GET["preference"] ?? "";
        $medicalCondition = $_GET["medical-condition"] ?? "";
        $majorMedicalCondition = $_GET["major-medical-condition"] ?? "";
        $cookingType = $_GET["cooking"] ?? "";
        $tasteType = $_GET["taste"] ?? "";
        $checkedIngredients = $_GET["checkedIngredients"] ?? "";

        // Construct GPT-3 prompt based on parameters
        $prompt = "Find 4 dishes with the following parameters and ingredients:
                    - Continent: $continent
                    - Country: $country
                    - Dietary Preference: $preference
                    - Diabetic Status: $medicalCondition
                    - Any Major Medical Condition: $majorMedicalCondition
                    - Cooking Type: $cookingType
                    - Taste Type: $tasteType
                    - Checked Ingredients: $checkedIngredients";

        $openai_api_key = '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'; // Replace with your GPT-3 API key
        $openai_endpoint = 'https://api.openai.com/v1/completions';
        $openai_data = array(
            'model' => 'text-davinci-002',
            'prompt' => $prompt,
            'max_tokens' => 150,
        );

        $openai_headers = array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $openai_api_key,
        );

        $ch = curl_init($openai_endpoint);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($openai_data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $openai_headers);

        $openai_response = curl_exec($ch);
        curl_close($ch);

        if ($openai_response === false) {
            echo "OpenAI API request failed.";
        } else {
            $mealsSuggestions = json_decode($openai_response, true);

            if (isset($mealsSuggestions['choices'])) {
                $mealsText = $mealsSuggestions['choices'][0]['text'];
                $mealsArray = explode("\n", $mealsText);

                echo '<div class="meals-columns">';
                $column = 1;

                foreach ($mealsArray as $index => $meals) {
                    $mealsArray = explode(",", $meals);

                    foreach ($mealsArray as $meal) {
                        $meal = trim(preg_replace('/^\d+[.,]*\s*|\d+\)\s*/', '', $meal));

                        if (!empty($meal)) {
                            $columnClass = ($column % 2 == 0) ? 'meals-right-column' : 'meals-left-column';
                            ?>

                            <div class="product-card typewriter-animation" id="productCardContainer" data-meal-name="<?php echo urlencode($meal); ?>">
                                <div class="meal-type">
                                    <div class="breakfast">AI Generated</div>
                                </div>

                                <!-- Use Edamam API to get detailed information and image -->
                                <?php
                                $edamam_app_id = '5ac82c8c'; // Replace with your Edamam API App ID
                                $edamam_app_key = 'b07fcb77e26b20c8a825710d5e2bef27'; // Replace with your Edamam API App Key
                                $meal_name = urlencode($meal);
                                $edamam_meal_endpoint = "https://api.edamam.com/api/recipes/v2?type=public&q=$meal_name&app_id=$edamam_app_id&app_key=$edamam_app_key";
                                $edamam_response = file_get_contents($edamam_meal_endpoint);
                                $edamam_data = json_decode($edamam_response, true);

                                if (!empty($edamam_data['hits'])) {
                                    $recipe = $edamam_data['hits'][0]['recipe'];
                                    $image_url = $recipe['image'];
                                    ?>
                                    <img class="meal-image-icon" src="<?php echo $image_url; ?>" alt="<?php echo $recipe['label']; ?>" />
                                    <?php
                                }
                                ?>

                                <div class="like-box">
                                    <img class="like-icon" alt="" src="./public/like.svg" />
                                </div>

                                <!-- Output the meals in the corresponding column -->
                                <div class="meals <?php echo $columnClass; ?>">
                                    <b class="meal-name"><?php echo $meal; ?></b>
                                </div>

                                <div class="subtitle">
                                    <div class="type">Food</div>
                                    <div class="dot"></div>
                                    <div class="type">&gt;60 mins</div>
                                </div>
                            </div>

                            <?php
                            $column = ($column == 1) ? 2 : 1;
                        }
                    }
                }

                echo '</div>';
            } else {
                echo "OpenAI API response does not contain 'choices' data.";
            }
        }
    } else {
        echo "Invalid request method.";
    }
    ?>
</div>

    </div>

</body>
</html>

    <script>
        // Hide loader when the page has fully loaded
        window.addEventListener('load', function () {
            var loaderContainer = document.getElementById('loaderContainer');
            loaderContainer.style.display = 'none';
        });
    </script>


    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Add click event listener to all product cards
        var productCards = document.querySelectorAll('.product-card');

        productCards.forEach(function (card) {
            card.addEventListener('click', function () {
                // Get the meal name from the data attribute
                var mealName = card.getAttribute('data-meal-name');

                // Redirect to meal.php with the meal-name parameter
                window.location.href = 'meal.php?meal-name=' + mealName;
            });
        });

        // Hide loader when the page has fully loaded
        var loaderContainer = document.getElementById('loaderContainer');
        loaderContainer.style.display = 'none';
    });
</script>


  <script>
    const text = "As per the choosen ingridients, here I have created few meals you can choose from.";
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
