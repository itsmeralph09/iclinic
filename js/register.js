const progress = (value) => {
   document.getElementsByClassName('progress-bar')[0].style.width = `${value}%`;
}

   let step = document.getElementsByClassName('step');
   let prevBtn = document.getElementById('prev-btn');
   let nextBtn = document.getElementById('next-btn');
   let submitBtn = document.getElementById('submit-btn');
   let form = document.getElementsByTagName('form')[0];
   let preloader = document.getElementById('preloader-wrapper');
   let bodyElement = document.querySelector('body');
   let succcessDiv = document.getElementById('success');
   let aoaa = document.getElementById('aoaa');
   let permitValid = false;
 
   form.onsubmit = () => { return false }

   let current_step = 0;
   let stepCount = 3
   step[current_step].classList.add('d-block');
   if(current_step == 0){
      prevBtn.classList.add('d-none');
      submitBtn.classList.add('d-none');
      nextBtn.classList.add('d-inline-block');
   }


// Function to show SweetAlert2 warning message
const showWarningMessage = (message) => {
    Swal.fire({
        icon: 'warning',
        title: 'Invalid...',
        text: message
    });
};

// Function to handle file input change event for profile picture
$('#profile').on('change', function() {
    const fileInput = $(this)[0];
    const file = fileInput.files[0];

    // Set profileValid to true when a new profile picture is selected
    permitValid = true;

    // Check if the file type is allowed
    const allowedTypes = ['image/png', 'image/jpeg', 'image/webp'];
    if (allowedTypes.includes(file.type)) {
        // Read the selected file and display the preview
        const reader = new FileReader();
        reader.onload = function(e) {
            $('#profile').attr('src', e.target.result); // Set image source to preview element
            $('input[name="profile"]').css('border', '');
        };
        reader.readAsDataURL(file);
    } else {
        // Show warning message for invalid file type
        showWarningMessage('Please select a valid image file (PNG, JPG, WEBP).');
        permitValid = false;
        $('#profile').val(''); // Clear the file input
        $('input[name="profile"]').css('border', '1px solid red');
    }
});

// Function to handle next button click
nextBtn.addEventListener('click', () => {
    // Check if any required field in the current step is empty
    const currentStepFields = step[current_step].querySelectorAll('[required]');
    let fieldsAreValid = true; // Initialize as true
    currentStepFields.forEach(field => {
        if (field.value.trim() === '') {
            fieldsAreValid = false; // Set to false if any required field is empty
            field.style.border = '1px solid red'; // Add red border to missing field
        } else {
            field.style.border = ''; // Remove red border if field is filled
        }
    });

    // Proceed to the next step if all required fields are filled
    if (fieldsAreValid) {
        if (current_step === 1) {
            const classificationSelect = document.getElementById('classification');
            const selectedClassification = classificationSelect.value;
            let numberInputName, url;
            
            if (selectedClassification === 'student') {
                numberInputName = 'student_number';
                url = './action/check_student_number.php';
            } else if (selectedClassification === 'employee') {
                numberInputName = 'employee_number';
                url = './action/check_employee_number.php';
            }

            const number = $(`input[name="${numberInputName}"]`).val();
            const formData = new FormData();
            formData.append(numberInputName, number);

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    console.log(response);
                    // Parse JSON response
                    response = JSON.parse(response);
                    if (response.hasOwnProperty('exists')) {
                        if (response.exists) {
                            showWarningMessage(`${selectedClassification.charAt(0).toUpperCase() + selectedClassification.slice(1)} number already exists. Please use a different number.`);
                            $(`input[name="${numberInputName}"]`).css('border', '1px solid red'); // Add red border to the number field
                        } else {
                            $(`input[name="${numberInputName}"]`).css('border', ''); // Remove red border if number doesn't exist
                            goToNextStep(); // Proceed to the next step if number doesn't exist
                        }
                    } else {
                        showWarningMessage('Invalid response received from server.');
                    }
                },
                error: function (xhr, status, error) {
                    showWarningMessage('Failed to check number. Please try again later.');
                    console.error(xhr.responseText);
                }
            });
        } else if (current_step === 2) {
            const emailInputName = 'email'; // Only checking the personal email
            const email = $(`input[name="${emailInputName}"]`).val();
            const formData = new FormData();
            formData.append('email', email);

            $.ajax({
                url: './action/check_personal_email.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    console.log(response);
                    // Parse JSON response
                    response = JSON.parse(response);
                    if (response.hasOwnProperty('exists')) {
                        if (response.exists) {
                            showWarningMessage('Email already exists. Please use a different email.');
                            $(`input[name="${emailInputName}"]`).css('border', '1px solid red'); // Add red border to email field
                        } else {
                            $(`input[name="${emailInputName}"]`).css('border', ''); // Remove red border if email doesn't exist
                            // Check if passwords match
                            const password = document.querySelector('input[name="password"]').value;
                            const confirmPassword = document.querySelector('input[name="confirm_password"]').value;
                            if (password !== confirmPassword) {
                                showWarningMessage("Passwords don't match. Please check and try again.");
                                document.querySelector('input[name="password"]').style.border = '1px solid red';
                                document.querySelector('input[name="confirm_password"]').style.border = '1px solid red'; // Add red border to confirm password field
                            } else {
                                document.querySelector('input[name="password"]').style.border = '';
                                document.querySelector('input[name="confirm_password"]').style.border = ''; // Remove red border if passwords match
                                goToNextStep(); // Proceed to the next step if passwords match
                            }
                        }
                    } else {
                        showWarningMessage('Invalid response received from server.');
                    }
                },
                error: function (xhr, status, error) {
                    showWarningMessage('Failed to check email. Please try again later.');
                    console.error(xhr.responseText);
                }
            });
        } else {
            // Proceed with other checks if not in the email or password step
            goToNextStep(); // Proceed to the next step directly
        }
    } else {
        // If any required field is empty, show SweetAlert2 popup
        Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: 'Please fill out all required fields.'
        });
    }
});


// Function to proceed to the next step
function goToNextStep() {
    // Proceed to the next step
    current_step++;
    let previous_step = current_step - 1;
    if ((current_step > 0) && (current_step <= stepCount)) {
        prevBtn.classList.remove('d-none');
        prevBtn.classList.add('d-inline-block');
        step[current_step].classList.remove('d-none');
        step[current_step].classList.add('d-block');
        step[previous_step].classList.remove('d-block');
        step[previous_step].classList.add('d-none');
        if (current_step == stepCount) {
            submitBtn.classList.remove('d-none');
            submitBtn.classList.add('d-inline-block');
            nextBtn.classList.remove('d-inline-block');
            nextBtn.classList.add('d-none');
        }
    } else {
        if (current_step > stepCount) {
            form.onsubmit = () => { return true; };
        }
    }
    progress((100 / stepCount) * current_step);
}

// Function to proceed to the previous step
prevBtn.addEventListener('click', () => {
    if(current_step > 0){
        current_step--;
        let previous_step = current_step + 1; 
        prevBtn.classList.add('d-none');
        prevBtn.classList.add('d-inline-block');
        step[current_step].classList.remove('d-none');
        step[current_step].classList.add('d-block')
        step[previous_step].classList.remove('d-block');
        step[previous_step].classList.add('d-none');
        if(current_step < stepCount){
           submitBtn.classList.remove('d-inline-block');
           submitBtn.classList.add('d-none');
           nextBtn.classList.remove('d-none');
           nextBtn.classList.add('d-inline-block');
           prevBtn.classList.remove('d-none');
           prevBtn.classList.add('d-inline-block');
        } 
    }

    if(current_step == 0){
        prevBtn.classList.remove('d-inline-block');
        prevBtn.classList.add('d-none');
    }
    progress((100 / stepCount) * current_step);
});


$('#submit-btn').on('click', function(event) {
    // Prevent the default form submission
    event.preventDefault();

    // Check if the checkbox is checked
    if (!$('#confirmInfo').prop('checked')) {
        // If checkbox is not checked, show SweetAlert2 popup
        Swal.fire({
            icon: 'warning',
            title: 'Invalid...',
            text: 'Please confirm that the information provided is correct.',
            confirmButtonText: 'OK',
            willClose: () => {
                $('#confirmInfo').css('border', '1px solid red'); 
                $('#confirmInfoLabel').css('color', 'red'); 
                $('#confirmInfo').focus(); // Focus on the checkbox after the SweetAlert2 popup is closed
            }
        });
        return; // Exit function if checkbox is not checked
    }

    // Perform AJAX request
    var formData = new FormData($('#form-wrapper')[0]);
    
    $.ajax({
        url: './action/register_action.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false
    })
    .then(function(response) {
        try {
            var data = JSON.parse(response);
            if (data.status === 'success') {
                // If AJAX request is successful and response indicates success, proceed to preloader and success page
                $('#preloader-wrapper').addClass('d-block');
                return new Promise(function(resolve) {
                    setTimeout(resolve, 2500);
                });
            } else {
                // If AJAX request is successful but response indicates error, show SweetAlert error message
                return Promise.reject(data.message || 'Failed to submit the form. Please try again later.');
            }
        } catch (error) {
            // If response cannot be parsed as JSON, show generic error message
            return Promise.reject('Failed to submit the form. Please try again later.');
        }
    })
    .then(function() {
        $('body').addClass('loaded');
        $('.step').eq(stepCount).removeClass('d-block').addClass('d-none');
        $('#prev-btn, #submit-btn').removeClass('d-inline-block').addClass('d-none');
        $('#success').removeClass('d-none').addClass('d-block');
        $('#aoaa').addClass('d-none');
    })
    .catch(function(error) {
        // Show SweetAlert error message
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: error
        });
        console.error(error);
    });
});
