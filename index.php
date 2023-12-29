<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./index.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@500;700&display=swap">
    <script src="index.js"></script>
    <style>
        select {
            padding: 15px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 320px;
            margin-bottom: 10px;
            background-color: #fff;
            color: #333;
            cursor: pointer;
            margin-top: 20px;
        }

        select:focus {
            outline: none;
            border-color: #3498db;
        }

        option {
            background-color: #fff;
        }

        .container {
            align-items: center;
            justify-content: center;
            margin: 60px auto 0 auto;
            display: block;
            min-width: 231.5px;
            width: 100% !important;
            max-width: 483px;
            opacity: 0; /* Set initial opacity to 0 */
            transform: translateY(-50px); /* Move the element up by 50px */
            transition: opacity 1s, transform 1s; /* Set transition properties */
        }

        /* the code below is for the dropdown heading */
        .setting-description {
            background-color: #fafafa;
            border-radius: 15px 15px 0px 0px;
            min-width: 231.5px;
            width: 100% !important;
            max-width: 483px;
        }

        h10 {
            font-size: 12px;
            margin-left: 5px !important;
            letter-spacing: 0.8px;
            font-family: Arial !important;
        }

        .setting-description-text {
            padding-top: 18px !important;
            color: #81828b;
            font-family: Gilroy-Regular !important;
            text-align: left;
        }

        /* the code below is for the dropdown menu */
        .wrapper-dropdown {
            position: relative;
            display: inline-block;
            min-width: 231.5px;
            width: 100% !important;
            max-width: 483px;
            padding: 0px 0px 0px 0px;
            min-height: 44px;
            border-radius: 0px 0px 15px 15px;
            background: #fafafa;
            text-align: left;
            color: #000;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            margin-bottom: 20px;
            font-family: Arial;
            text-transform: capitalize;
        }

        .scrollable-menu {
            height: auto;
            max-height: 200px;
            overflow-x: hidden;
        }

        .arrow {
            margin-left: 10px;
            margin-right: 10px;
            float: right;
            rotate: 180deg;
            color: #3e5481;
        }

        .selected-display {
            margin-left: 20px;
            font-weight: bold;
            color: #3e5481;
        }

        svg {
            transition: all 0.3s;
        }

        .wrapper-dropdown::before {
            position: absolute;
            top: 50%;
            right: 16px;
            margin-top: -2px;
            border-width: 6px 6px 0 6px;
            border-style: solid;
            border-color: #fff transparent;
        }

        .rotated {
            transform: rotate(-180deg);
        }

        .wrapper-dropdown .dropdown {
            transition: 0.3s;
            text-transform: capitalize;
            position: absolute;
            top: 120%;
            right: 0;
            left: 0;
            margin: 0;
            padding: 0;
            list-style: none;
            z-index: 99;
            border-radius: 15px;
            box-shadow: inherit;
            background: inherit;
            -webkit-transform-origin: top;
            -moz-transform-origin: top;
            -ms-transform-origin: top;
            transform-origin: top;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            opacity: 0;
            visibility: hidden;
        }

        .wrapper-dropdown .dropdown li {
            padding: 0 15px;
            line-height: 45px;
            overflow: hidden;
            color: #3e5481;
        }

        .wrapper-dropdown .dropdown li:last-child {
            border-bottom: none;
        }

        .dropdown {
            padding: 0.5rem !important;
        }

        .wrapper-dropdown .dropdown li:hover {
            background-color: rgb(238, 238, 238);
            border-radius: 10px;
        }

        .wrapper-dropdown.active .dropdown {
            opacity: 1;
            visibility: visible;
            border-radius: 15px;
        }
    </style>
</head>

<body>


    <div class="upload-container-2">




        <div class="frame-container">
            <div class="header-container">
                <!--<img class="header-icon" alt="" src="./public/continent-img-big.png" /> -->
                <!--
                <b class="step-counter" id="stepCounter"><span class="currentStep">1</span>/4</b>
                <b class="cancel-btn">Cancel</b>
                -->
            </div>
            <div style="height: 120px; width: 370px; margin: auto; position: absolute;">
             <?php include"animation.html"; ?>
             <b class="diet-preference-label" id="typewriter"></b>
            </div>
        </div>

        <div class="frame-1">
            <div class="frame-2">
                <div class="center">
                    <div class="container">
                        <div class="setting-description">
                            <div class="setting-description-text" style="margin-left: 15px">
                                <h10>Choose</h10>
                            </div>
                        </div>
                        <div id="continent" class="wrapper-dropdown">
                            <span class="selected-display" id="destination">Continent</span>
                            <svg class="arrow" id="drp-arrow" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" xmlns="http://www.w3.org/2000/svg"
                                class="transition-all ml-auto rotate-180">
                                <path d="M7 14.5l5-5 5 5" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <ul class="dropdown"></ul>
                        </div>

                        <br>

                        <div class="setting-description">
                            <div class="setting-description-text" style="margin-left: 15px">
                                <h10>Choose</h10>
                            </div>
                        </div>
                        <div class="wrapper-dropdown" id="dropdown">
                            <span class="selected-display" id="destination">Country</span>
                            <svg class="arrow" id="drp-arrow" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" xmlns="http://www.w3.org/2000/svg"
                                class="transition-all ml-auto rotate-180">
                                <path d="M7 14.5l5-5 5 5" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <ul id="countries" class="dropdown"></ul>
                        </div>
                    </div>
                </div>
                <div style="display: none;" class="spacing-line"></div>
            </div>
            <div class="pad-container">
        <div class="primary-container" style="width: 330px;">
          <button class="primary-btn-1">
            <b class="back-txt">Start</b>
          </button>
        </div>
            </div>
        </div>
    </div>
</body>

</html>



<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        const continents = {
            all: ["All Countries"],
            asia: ["India", "China", "Japan", "South Korea"],
            europe: ["Germany", "France", "Spain", "Italy"],
            // Add more continents and countries here
        };

        function createDropdownItems(items, dropdown) {
            const dropdownList = dropdown.querySelector('.dropdown');
            if (!dropdownList) {
                console.error(`Dropdown list not found in element with ID: ${dropdown.id}`);
                return;
            }

            dropdownList.innerHTML = '';

            items.forEach(item => {
                const li = document.createElement('li');
                li.classList.add('item');
                li.textContent = item;
                li.addEventListener('click', () => {
                    dropdown.querySelector('.selected-display').textContent = item;
                });
                dropdownList.appendChild(li);
            });
        }

        const continentDropdown = document.getElementById('continent');
        if (continentDropdown) {
            createDropdownItems(Object.keys(continents), continentDropdown);
        } else {
            console.error('Element with ID "continent" not found');
        }

        const countriesDropdown = document.getElementById('dropdown');
        if (countriesDropdown) {
            createDropdownItems(continents.all, countriesDropdown);

            continentDropdown.addEventListener('click', (event) => {
                const selectedContinent = event.target.textContent.toLowerCase();
                const selectedCountries = continents[selectedContinent];
                createDropdownItems(selectedCountries || continents.all, countriesDropdown);
            });
        } else {
            console.error('Element with ID "dropdown" not found');
        }

        const selectedAll = document.querySelectorAll('.wrapper-dropdown');

        selectedAll.forEach(selected => {
            const optionsList = selected.querySelectorAll('.wrapper-dropdown li');

            selected.addEventListener('click', () => {
                let arrow = selected.children[1];

                if (selected.classList.contains('active')) {
                    handleDropdown(selected, arrow, false);
                } else {
                    let currentActive = document.querySelector('.wrapper-dropdown.active');

                    if (currentActive) {
                        let anotherArrow = currentActive.children[1];
                        handleDropdown(currentActive, anotherArrow, false);
                    }

                    handleDropdown(selected, arrow, true);
                }
            });

            for (let o of optionsList) {
                o.addEventListener('click', () => {
                    selected.querySelector('.selected-display').innerHTML = o.innerHTML;
                });
            }
        });

        window.addEventListener('click', function (e) {
            if (e.target.closest('.wrapper-dropdown') === null) {
                closeAllDropdowns();
            }
        });

        function closeAllDropdowns() {
            const selectedAll = document.querySelectorAll('.wrapper-dropdown');
            selectedAll.forEach(selected => {
                let arrow = selected.children[1];
                handleDropdown(selected, arrow, false);
            });
        }

        function handleDropdown(dropdown, arrow, open) {
            if (open) {
                arrow.classList.add('rotated');
                dropdown.classList.add('active');
            } else {
                arrow.classList.remove('rotated');
                dropdown.classList.remove('active');
            }
        }

        // Get the "Next" button
        const nextButton = document.querySelector('.primary-btn-1');

        // Add a click event listener to the "Next" button
        if (nextButton) {
            nextButton.addEventListener('click', function (event) {
                const selectedContinent = document.getElementById('continent').querySelector('.selected-display').textContent;
                const selectedCountry = document.getElementById('dropdown').querySelector('.selected-display').textContent;

                // Check if both continent and country are selected
                if (selectedContinent === 'Continent' || selectedCountry === 'Country') {
                    // Display an error message or take other appropriate action
                    alert('Please choose both a continent and a country before proceeding.');
                    event.preventDefault(); // Prevent form submission
                } else {
                    const message = `continent=${encodeURIComponent(selectedContinent)}&country=${encodeURIComponent(selectedCountry)}`;
                    const nextPageUrl = `step-2.php?${message}`;

                    window.location.href = nextPageUrl;
                }
            });
        } else {
            console.error('Next button not found');
        }
    });
</script>

  <script>
    const text = "Hi! Genie AI here, I'm here to help you for your meal plan, So are you ready?";
    const delay = 40;
    const typewriterElement = document.getElementById("typewriter");
    const containerElement = document.querySelector(".container");

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
            containerElement.style.opacity = "1";
            containerElement.style.transform = "translateY(0)";
          }, 1000);
        }
      }
      type();
    }

    typeWriter();
  </script>