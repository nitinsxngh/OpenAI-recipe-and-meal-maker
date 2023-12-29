<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Generator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        h1 {
            text-align: center;
        }

        .recipe {
    padding: 10px;
    border-top-left-radius: 60px;
    border-top-right-radius: 60px;
    position: relative;
    background-color: #ffffff;
    top: -100px;
    width: 94%;
    margin: auto;
    opacity: 0;
    animation: slideIn 1.5s forwards;
        }

        /* Define the slideIn animation */
        @keyframes slideIn {
            from {
                transform: translateY(100%); /* Start from 100% below the normal position */
                opacity: 0; /* Start with opacity 0 (fully transparent) */
            }
            to {
                transform: translateY(0); /* End at the normal position (0% from the top) */
                opacity: 1; /* End with opacity 1 (fully visible) */
            }
        }



        h2 {
            margin-top: 10px;
            text-align: center;
            padding: 20px;
        }

        .ingredients, .instructions {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #f4f4f4;
            border-radius: 10px;
        }

        .meal-image {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            margin-bottom: 20px;
        }

        ol {
            list-style-type: decimal;
            margin: 0;
            padding-left: 20px;
        }

        li {
            margin-bottom: 10px;
        }

        .loader {
            border: 8px solid #f3f3f3;
            border-top: 8px solid #3498db;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: none; /* Initially hide the loader */
        }

        /* Define the spin animation for the loader */
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

    </style>
</head>
<body>

    <div class="container">

        <?php
        if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["meal-name"])) {
            $selectedDish = urlencode($_GET["meal-name"]);
            $prompt = "Create a detailed recipe for making '$selectedDish' including ingredients list and step-by-step instructions.";

            // Request to Edamam API to get meal image
            $edamam_app_id = '5ac82c8c'; // Replace with your Edamam app ID
            $edamam_app_key = 'b07fcb77e26b20c8a825710d5e2bef27'; // Replace with your Edamam app key
            $edamam_endpoint = "https://api.edamam.com/api/recipes/v2?type=public&q=$selectedDish&app_id=$edamam_app_id&app_key=$edamam_app_key";

            $edamam_response = file_get_contents($edamam_endpoint);

            if ($edamam_response === false) {
                $error_message = error_get_last()['message'];
                echo "Error fetching meal image from Edamam API: $error_message";
            } else {
                $edamam_data = json_decode($edamam_response, true);
                $meal_image = isset($edamam_data['hits'][0]['recipe']['image']) ? $edamam_data['hits'][0]['recipe']['image'] : '';

                if (!empty($meal_image)) {
                    echo '<img class="meal-image" src="' . $meal_image . '" alt="' . $selectedDish . '">';
                } else {
                    echo "No image available for $selectedDish.";
                }
            }
        ?>

        <div class="recipe">
            <?php
            // Continue with OpenAI API for recipe instructions
            $api_key = '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'; // Replace with your GPT-3 API key
            $endpoint = 'https://api.openai.com/v1/completions';
            $data = array(
                'model' => 'text-davinci-002',
                'prompt' => $prompt,
                'max_tokens' => 800,
            );

            $headers = array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $api_key,
            );

            $ch = curl_init($endpoint);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $response = curl_exec($ch);
            curl_close($ch);

            if ($response === false) {
                echo "API request failed.";
            } else {
                $recipe = json_decode($response, true);

                if (isset($recipe['choices'])) {
                    $recipeText = $recipe['choices'][0]['text'];
                    $decodedDish = urldecode($selectedDish);
                    echo "<h2>Recipe for $decodedDish</h2>";

                    // Separate ingredients and instructions
                    $sections = explode("Instructions:", $recipeText);

                    if (count($sections) >= 2) {
                        // Process Ingredients
                        $ingredientsList = explode("\n", trim($sections[0]));
                        $ingredientsList = array_map('trim', $ingredientsList);
                        $ingredientsList = array_filter($ingredientsList, 'strlen'); // Remove empty elements
                        $ingredientsList = array_map(function ($ingredient) {
                            return ltrim($ingredient, '-');
                        }, $ingredientsList); // Remove hyphen at the beginning of each line

                        echo '<div class="ingredients"><h3>Ingredients</h3><ul>';
                        foreach ($ingredientsList as $ingredient) {
                            echo '<li>' . $ingredient . '</li>';
                        }
                        echo '</ul></div>';

                        // Process Instructions
                        $instructions = trim($sections[1]);
                        $instructions = preg_replace('/^[0-9]+\. /m', '', $instructions); // Remove numbers before instructions
                        $instructions = preg_replace('/^- /m', '', $instructions); // Remove hyphen at the beginning of each line

                        echo '<div class="instructions"><h3>Instructions</h3>';
                        echo '<ol>';
                        // Split instructions into steps
                        $steps = explode("\n", $instructions);
                        $steps = array_map('trim', $steps);
                        $steps = array_filter($steps, 'strlen'); // Remove empty elements
                        foreach ($steps as $step) {
                            echo '<li>' . $step . '</li>';
                        }
                        echo '</ol></div>';
                    } else {
                        echo "No ingredients or instructions found.";
                    }
                } else {
                    echo "API response does not contain 'choices' data.";
                }
            }
            } else {
                echo "Invalid request";
            }
            ?>
        </div>
    </div>
</body>
</html>

    <script>
        // Display the loader when the page is loading
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelector(".loader").style.display = "block";
        });
    </script>
