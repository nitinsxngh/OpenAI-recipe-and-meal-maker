<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./index.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@500;700&display=swap">
  <script src="index.js"></script>
  <style>


    /* Add the following CSS for the loader style */
    .loader {
      display: none;
      border: 16px solid #f3f3f3; /* Light grey */
      border-top: 16px solid #3498db; /* Blue */
      border-radius: 50%;
      width: 80px;
      height: 80px;
      background-color: #fff;
      animation: spin 1s linear infinite;
      position: fixed;
      top: 50%;
      left: 50%;
      margin-top: -40px; /* Half of the height */
      margin-left: -40px; /* Half of the width */
      z-index: 1000; /* Ensure it's above other elements */
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }


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
  margin: 0 auto 0 auto;
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
  margin-left: 20px !important;
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
  width: 100%; !important;
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

<div id="loader" class="loader"></div>


  <div class="upload-container-2">
    <div class="frame-container">
      <div class="header-container">
        <!--<img class="header-icon" alt="" src="./public/continent-img-big.png" /> -->
        <!--
        <b class="step-counter" id="stepCounter"><span class="currentStep">4</span>/4</b>
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


    <div class="center" style="margin-top: 50px;">
      <div class="container">

        <!-- Cooking Type Dropdown -->
        <div class="setting-description">
          <div class="setting-description-text">
            <h10>Choose Cooking Type</h10>
          </div>
        </div>
        <div id="cookingDropdown" class="wrapper-dropdown">
          <span class="selected-display" id="cookingType">Any Cooking Type</span>
          <svg class="arrow" id="cooking-arrow" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M7 14.5l5-5 5 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
          </svg>
          <ul class="dropdown"></ul>
        </div>

        <!-- Add some space between the dropdowns -->
        <br>

        <!-- Taste Type Dropdown -->
        <div class="setting-description">
          <div class="setting-description-text">
            <h10>Choose Taste Type</h10>
          </div>
        </div>
        <div id="tasteDropdown" class="wrapper-dropdown">
          <span class="selected-display" id="tasteType">Any Taste Type</span>
          <svg class="arrow" id="taste-arrow" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M7 14.5l5-5 5 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
          </svg>
          <ul class="dropdown"></ul>
        </div>

      </div>
    </div>



        <div style="display: none;" class="spacing-line"></div>
      </div>
      <div class="pad-container" style="text-align: center;">
        <div class="primary-container" style="width: 330px;">
          <button class="primary-btn-1" id="generate-ingridients">
            <b class="back-txt">Generate Ingridients</b>
          </button>
        </div>
      </div>
    </div>
  </div>
</body>
</html>


<script type="text/javascript" defer>

document.addEventListener('DOMContentLoaded', function () {
  const typeAndTaste = {
    cooking: ["Fry", "Bake", "Toast", "Saute"],
    taste: ["Spicy", "Bitter", "Salty", "Sweet"],
  };

  function createDropdownItems(items, dropdown) {
    const dropdownList = dropdown.querySelector('.dropdown');
    if (!dropdownList) {
      console.error(`Dropdown list not found in element with ID: ${dropdown.id}`);
      return;
    }

    dropdownList.innerHTML = '';

    if (Array.isArray(items)) {
      items.forEach(item => {
        const li = document.createElement('li');
        li.classList.add('item');
        li.textContent = item;
        li.addEventListener('click', () => {
          dropdown.querySelector('.selected-display').textContent = item;
        });
        dropdownList.appendChild(li);
      });
    } else {
      console.error('Invalid or undefined items array:', items);
    }
  }

  const cookingDropdown = document.getElementById('cookingDropdown');
  const tasteDropdown = document.getElementById('tasteDropdown');

  if (cookingDropdown && tasteDropdown) {
    createDropdownItems(typeAndTaste.cooking, cookingDropdown);
    createDropdownItems(typeAndTaste.taste, tasteDropdown);
  } else {
    console.error('Element with ID "cookingDropdown" or "tasteDropdown" not found');
  }

  cookingDropdown.addEventListener('click', () => {
    createDropdownItems(typeAndTaste.cooking, cookingDropdown);
  });

  tasteDropdown.addEventListener('click', () => {
    createDropdownItems(typeAndTaste.taste, tasteDropdown);
  });

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

  function getQueryString() {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.toString();
  }

  function toggleLoader(showLoader) {
    const loader = document.getElementById('loader');
    if (loader) {
      loader.style.display = showLoader ? 'block' : 'none';
    }
  }

  const generateIngredientsBtn = document.getElementById('generate-ingridients');
  generateIngredientsBtn.addEventListener('click', function () {
    const selectedCooking = document.getElementById('cookingType').textContent;
    const selectedTaste = document.getElementById('tasteType').textContent;

    updateUrlAndNavigate(selectedCooking, selectedTaste);
  });

  function updateUrlAndNavigate(selectedCooking, selectedTaste) {
    toggleLoader(true); // Show the loader

    const queryString = getQueryString();
    const newParams = [];

    if (selectedCooking) {
      newParams.push(`cooking=${encodeURIComponent(selectedCooking)}`);
    }

    if (selectedTaste) {
      newParams.push(`taste=${encodeURIComponent(selectedTaste)}`);
    }

    const newQueryString = newParams.join('&');
    const updatedUrl = `ingridients.php?${queryString}${queryString ? '&' : ''}${newQueryString}`;

    setTimeout(() => {
      window.location.href = updatedUrl;
      toggleLoader(false); // Hide the loader after navigation
    }, 2000);
  }
});


</script>

  <script>
    const text = "Great! We are here at last step, I'd like to know your taste and cooking preferences.";
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