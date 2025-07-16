$(document).ready(function () {
  var baseURL = jQuery("#appBaseUrl").val();
  // Get the URL parameter "time"
  const urlParams = new URLSearchParams(window.location.search);
  const time = urlParams.get("time"); // e.g., '1pm' or '8pm'
  console.log(time);

  if (time === "1pm" || time === "8pm") {
    // Loop through radio inputs
    $(".form-selectgroup .select-input").each(function () {
      const labelText = $(this).val().toLowerCase();
      if (labelText.includes(time)) {
        $(this).prop("checked", true);
      }
    });
  }

  // Store used numbers for each section to avoid duplicates
  let usedNumbers = {
    section2: new Set(),
    section3: new Set(),
    section4: new Set(),
    section5: new Set(),
  };

  // Helper function to generate random number in range
  function getRandomNumber(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
  }

  // Helper function to generate unique numbers for a section
  function generateUniqueNumbers(section, count, digits) {
    let numbers = [];
    let attempts = 0;
    const maxAttempts = 1000; // Prevent infinite loops

    while (numbers.length < count && attempts < maxAttempts) {
      let num;
      if (section === "section5") {
        // For section 5, generate numbers from 0000-9999 (4 digits with leading zeros)
        num = getRandomNumber(0, 9999);
      } else {
        // For other sections, generate based on digit count
        const min = Math.pow(10, digits - 1);
        const max = Math.pow(10, digits) - 1;
        num = getRandomNumber(min, max);
      }

      // Check if number is already used in this section
      if (!usedNumbers[section].has(num)) {
        numbers.push(num);
        usedNumbers[section].add(num);
      }
      attempts++;
    }

    // Sort numbers in ascending order
    return numbers.sort((a, b) => a - b);
  }

  // Section 1 Generator (28V 12345 format)
  $("#generateSection1").click(function () {
    const letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    const randomLetter = letters[getRandomNumber(0, 25)];
    const randomNumber = getRandomNumber(10000, 99999);
    const result = `${getRandomNumber(10, 99)}${randomLetter} ${randomNumber}`;

    $(".section1-input").val(result);
  });

  // Section 2 Generator (5 digits, 10 numbers)
  $("#generateSection2").click(function () {
    usedNumbers.section2.clear(); // Clear previous numbers
    const numbers = generateUniqueNumbers("section2", 10, 5);

    $(".section2-input").each(function (index) {
      if (index < numbers.length) {
        $(this).val(numbers[index].toString().padStart(5, "0"));
      }
    });
  });

  // Section 3 Generator (4 digits, 10 numbers)
  $("#generateSection3").click(function () {
    usedNumbers.section3.clear(); // Clear previous numbers
    const numbers = generateUniqueNumbers("section3", 10, 4);

    $(".section3-input").each(function (index) {
      if (index < numbers.length) {
        $(this).val(numbers[index].toString().padStart(4, "0"));
      }
    });
  });

  // Section 4 Generator (4 digits, 10 numbers)
  $("#generateSection4").click(function () {
    usedNumbers.section4.clear(); // Clear previous numbers
    const numbers = generateUniqueNumbers("section4", 10, 4);

    $(".section4-input").each(function (index) {
      if (index < numbers.length) {
        $(this).val(numbers[index].toString().padStart(4, "0"));
      }
    });
  });

  // Section 5 Generator (4 digits, 100 numbers in ranges)
  $("#generateSection5").click(function () {
    usedNumbers.section5.clear(); // Clear previous numbers
    const numbers = generateUniqueNumbers("section5", 100, 4);

    $(".section5-input").each(function (index) {
      if (index < numbers.length) {
        $(this).val(numbers[index].toString().padStart(4, "0"));
      }
    });
  });

  // Function to validate all fields are filled
  function validateAllFields() {
    let errors = [];

    // Check Section 1 (should have 1 field)
    let section1Count = 0;
    $(".section1-input").each(function () {
      if ($(this).val().trim() !== "") {
        section1Count++;
      }
    });
    if (section1Count === 0) {
      errors.push("Section 1 (1st Prize) must have at least 1 value");
    }

    // Check Section 2 (should have 10 fields)
    let section2Count = 0;
    $(".section2-input").each(function () {
      if ($(this).val().trim() !== "") {
        section2Count++;
      }
    });
    if (section2Count === 0) {
      errors.push("Section 2 (2nd Prize) must have at least 1 value");
    }

    // Check Section 3 (should have 10 fields)
    let section3Count = 0;
    $(".section3-input").each(function () {
      if ($(this).val().trim() !== "") {
        section3Count++;
      }
    });
    if (section3Count === 0) {
      errors.push("Section 3 (3rd Prize) must have at least 1 value");
    }

    // Check Section 4 (should have 10 fields)
    let section4Count = 0;
    $(".section4-input").each(function () {
      if ($(this).val().trim() !== "") {
        section4Count++;
      }
    });
    if (section4Count === 0) {
      errors.push("Section 4 (4th Prize) must have at least 1 value");
    }

    // Check Section 5 (should have 100 fields)
    let section5Count = 0;
    $(".section5-input").each(function () {
      if ($(this).val().trim() !== "") {
        section5Count++;
      }
    });
    if (section5Count === 0) {
      errors.push("Section 5 (5th Prize) must have at least 1 value");
    }

    // Check if draw time is selected
    if (!$('input[name="select-options"]:checked').length) {
      errors.push("Please select a draw time");
    }

    // Check if date is available
    if (!$("#date-display").text().trim()) {
      errors.push("Draw date is not available");
    }

    return errors;
  }

  // Function to get all values from each section as arrays (only non-empty values)
  function getAllSectionValues() {
    let sectionData = {
      section1: [],
      section2: [],
      section3: [],
      section4: [],
      section5: [],
    };

    // Get Section 1 values
    $(".section1-input").each(function () {
      let value = $(this).val().trim();
      if (value !== "") {
        sectionData.section1.push(value);
      }
    });

    // Get Section 2 values
    $(".section2-input").each(function () {
      let value = $(this).val().trim();
      if (value !== "") {
        sectionData.section2.push(value);
      }
    });

    // Get Section 3 values
    $(".section3-input").each(function () {
      let value = $(this).val().trim();
      if (value !== "") {
        sectionData.section3.push(value);
      }
    });

    // Get Section 4 values
    $(".section4-input").each(function () {
      let value = $(this).val().trim();
      if (value !== "") {
        sectionData.section4.push(value);
      }
    });

    // Get Section 5 values
    $(".section5-input").each(function () {
      let value = $(this).val().trim();
      if (value !== "") {
        sectionData.section5.push(value);
      }
    });

    return sectionData;
  }

  // Function to get specific section values
  function getSectionValues(sectionNumber) {
    let values = [];
    $(`.section${sectionNumber}-input`).each(function () {
      let value = $(this).val().trim();
      if (value !== "") {
        values.push(value);
      }
    });
    return values;
  }

  // Function to send data via AJAX
  function sendLotteryData() {
    // First validate all fields
    let validationErrors = validateAllFields();

    if (validationErrors.length > 0) {
      let errorMessage = "Please fix the following errors:\n\n";
      validationErrors.forEach(function (error, index) {
        errorMessage += index + 1 + ". " + error + "\n";
      });
      alert(errorMessage);
      return false; // Stop execution
    }

    let allData = getAllSectionValues();

    // Double check that we have data for all sections
    if (
      allData.section1.length === 0 ||
      allData.section2.length === 0 ||
      allData.section3.length === 0 ||
      allData.section4.length === 0 ||
      allData.section5.length === 0
    ) {
      alert("All sections must have at least one value before saving!");
      return false;
    }

    let data = {
      lottery_data: allData,
      draw_time: $('input[name="select-options"]:checked').next().text().trim(),
      draw_date: $("#date-display").text().trim(),
    };

    console.log("Sending data:", data);

    // Show loading message
    $("#saveLotteryResultBtn, #saveLotteryResultBtnBottom")
      .prop("disabled", true)
      .text("Saving...");

    // AJAX call
    $.ajax({
      url: baseURL + "save-lottery-results",
      type: "POST",
      data: {
        lottery_data: allData,
        draw_time: $('input[name="select-options"]:checked')
          .next()
          .text()
          .trim(),
        draw_date: $("#date-display").text().trim(),
      },
      success: function (response) {
        console.log("Success:", response);
        alert("Lottery results saved successfully!");
        var resultId = response.data.result_id;
        window.location.href = baseURL + "admin/view-result/" + resultId;
        // Optional: Clear form after successful save
        // $('#clearAll').click();
      },
      error: function (xhr, status, error) {
        console.log("Error:", error);
        console.log("Response:", xhr.responseText);
        alert("Error saving lottery results! Please try again.");
      },
      complete: function () {
        // Re-enable save buttons
        // $('#saveLotteryResultBtn, #saveLotteryResultBtnBottom').prop('disabled', false)
        //     .text('Save Results');
      },
    });
  }

  // Update the save button to use the new function
  $("#saveLotteryResultBtn, #saveLotteryResultBtnBottom").click(function () {
    sendLotteryData();
  });

  // Optional: Clear all sections
  $("#clearAll").click(function () {
    if (confirm("Are you sure you want to clear all sections?")) {
      $(
        ".section1-input, .section2-input, .section3-input, .section4-input, .section5-input"
      ).val("");
      // Clear used numbers
      Object.keys(usedNumbers).forEach((section) => {
        usedNumbers[section].clear();
      });
    }
  });
});
