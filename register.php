<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>iClinic - Registration</title>
      <!-- CSS -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

      <link href="./css/register.css" rel="stylesheet">
      <!-- FONT -->

      <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

      <!-- SweetAlert2 CSS -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">

      <!-- SweetAlert2 JavaScript -->
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

      <!-- Jquery -->
      <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

   </head>
   <body class="">
      <!-- CONTAINER -->
      <div class="container d-flex align-items-center min-vh-100">
         <div class="row g-0 justify-content-center">
            <!-- TITLE -->
            <div class="col-lg-5 offset-lg-1 mx-0 px-0">
               <div id="title-container" class="">
                  <img class="covid-image" src="./img/prmsu_cande.png">
                  <h2>iClinic</h2>
                  <h3>PRMSU Candelaria Clinic Management System</h3>
                  <p>"Welcome to the iClinic: PRMSU Candelaria Clinic Management System, your gateway to efficient healthcare management. Embrace a seamless experience where precision meets care, designed to elevate patient services and streamline clinic operations. Step into a realm of medical excellence and compassionate care, where each interaction fosters wellness and trust."</p>
               </div>
            </div>
            <!-- FORMS -->
            <div class="col-lg-7 mx-0 px-0">
               <div class="progress">
                  <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="50" class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" style="width: 0%"></div>
               </div>
               <div id="qbox-container" class="">
                  <form class="needs-validation" id="form-wrapper" method="post" name="form-wrapper" novalidate="" method="POST">
                     <div id="steps-container">

                        <div class="step col-12">
                           <h4>Provide us your Personal Information:</h4>
                           <div class="form-floating mt-1">
                             <input type="text" class="form-control form-control-user" id="first_name" name="first_name" placeholder="" required>
                             <label for="first_name">First Name</label>
                           </div>
                           <div class="form-floating mt-2">
                             <input type="text" class="form-control form-control-user" id="middle_name" name="middle_name" placeholder="">
                             <label for="middle_name">Middle Name</label>
                           </div>
                           <div class="row g-1">
                              <div class="col-lg-9 col-md-9 col-12">
                                 <div class="form-floating mt-2">
                                   <input type="text" class="form-control form-control-user" id="last_name" name="last_name" placeholder="" required>
                                   <label for="last_name">Last Name</label>
                                 </div>
                              </div>
                              <div class="col-lg-3 col-md-3 col-12">
                                 <div class="form-floating mt-2">
                                   <select id="suffix_name" name="suffix_name" class="form-control form-select" placeholder="">
                                       <option value="na" selected>N/A</option>
                                       <option value="JR">JR</option>
                                       <option value="SR">SR</option>
                                       <option value="II">II</option>
                                       <option value="III">III</option>
                                       <option value="IV">IV</option>
                                       <option value="V">V</option>
                                    </select>
                                   <label for="suffix_name">Suffix</label>
                                 </div>
                              </div>
                           </div>
                           <div class="row g-1">
                              <div class="col-lg-7 col-md-7 col-12">
                                 <div class="form-floating mt-2">
                                   <input class="form-control" id="birth_date" name="birth_date" type="date" required>
                                   <label for="birth_date">Birthdate</label>
                                 </div>
                              </div>
                              <div class="col-lg-5 col-md-5 col-12">
                                 <div class="form-floating mt-2">
                                   <select name="sex" class="form-control form-select" id="sex" required>
                                       <option value="" disabled selected>Select sex</option>
                                       <option value="male">Male</option>
                                       <option value="female">Female</option>
                                    </select>
                                   <label for="sex">Sex</label>
                                 </div>
                              </div>
                           </div>
                           <div class="row g-2">
                              <div class="col-lg-12 col-md-12 col-12">
                                 <div class="form-floating mt-2">
                                   <input type="number" class="form-control form-control-user" id="contact" name="contact" placeholder="" required>
                                   <label for="contact">Contact No. (11 digits)</label>
                                 </div>
                              </div>
                           </div>
                           <div class="row g-1">
                              <div class="col-lg-12 col-md-12 col-12">
                                 <div class="form-floating mt-2">
                                   <input type="text" class="form-control form-control-user" id="address" name="address" placeholder="" required>
                                   <label for="address">Address</label>
                                 </div>
                              </div>
                           </div>
                        </div>

                        <div class="step col-12">
                           <h4>Provide us your University Information:</h4>
                           
                           <div class="row g-2">
                              <div id="class_selection_div" class="col-12">
                                 <div class="form-floating mt-2 mb-2">
                                    <select name="classification" class="form-control form-select" id="classification" required>
                                       <option value="" disabled selected>Select classification</option>
                                       <option value="student">Student</option>
                                       <option value="employee">Employee</option>
                                    </select>
                                    <label for="classification">Classification</label>
                                 </div>
                              </div>
                              <div id="employee_number_div" class="col-lg-6 col-md-6 col-12 d-none">
                                 <div class="form-floating mt-2 mb-2">
                                    <input type="text" class="form-control form-control-user" id="employee_number" name="employee_number" placeholder="">
                                    <label for="employee_number">Employee Number</label>
                                 </div>
                              </div>
                              <div id="student_number_div" class="col-lg-6 col-md-6 col-12 d-none">
                                 <div class="form-floating mt-2 mb-2">
                                    <input type="text" class="form-control form-control-user" id="student_number" name="student_number" placeholder="">
                                    <label for="student_number">Student Number</label>
                                 </div>
                              </div>
                           </div>

                           <div class="row g-2">
                              <div id="course_selection" class="col-lg-6 col-md-6 col-12 d-none">
                                 <div class="form-floating">
                                   <select name="course" class="form-control form-select" id="course">
                                       <option value="" disabled selected>Select course</option>
                                       <option value="BSIT">Bachelor of Science in Information Technology</option>
                                       <option value="BSFi">Bachelor of Science in Fisheries</option>
                                    </select>
                                    <label for="course">Course</label>
                                 </div>
                              </div>
                              <div id="year_selection" class="col-lg-6 col-md-6 col-12 d-none">
                                 <div class="form-floating">
                                    <select name="year_level" class="form-control form-select" id="year_level">
                                       <option value="" disabled selected>Select year level</option>
                                       <option value="1">1st Year</option>
                                       <option value="2">2nd Year</option>
                                       <option value="3">3rd Year</option>
                                       <option value="4">4th Year</option>
                                    </select>
                                    <label for="year_level">Year Level</label>
                                 </div>
                              </div>
                              <div id="occupation_input" class="col-lg-12 col-md-12 col-12 d-none">
                                 <div class="form-floating">
                                    <input type="text" class="form-control form-control-user" id="occupation" name="occupation" placeholder="">
                                    <label for="occupation">Occupation</label>
                                 </div>
                              </div>
                           </div>

                           <hr class="my-2">

                           <div class="row g-1">
                              <div class="col-lg-12 col-md-12 col-12">
                                 <div class="form-floating">
                                   <input type="text" class="form-control form-control-user" id="emergency_person" name="emergency_person" placeholder="" required>
                                   <label for="emergency_person">Emergency Contact Name</label>
                                 </div>
                              </div>
                           </div>

                           <div class="row g-1">
                              <div class="col-lg-12 col-md-12 col-12">
                                 <div class="form-floating mt-2">
                                   <input type="number" class="form-control form-control-user" id="emergency_contact" name="emergency_contact" placeholder="" required>
                                   <label for="emergency_contact">Emergency Contact No. (11 digits)</label>
                                 </div>
                              </div>
                           </div>

                           <div class="row g-1">
                              <div class="col-lg-12 col-md-12 col-12">
                                 <div class="form-floating mt-2">
                                   <input type="text" class="form-control form-control-user" id="emergency_address" name="emergency_address" placeholder="" required>
                                   <label for="emergency_address">Emergency Contact Address (street, etc)</label>
                                 </div>
                              </div>
                           </div>
                           <hr class="my-2">
                           <div class="">
                              <label for="profile" class="mb-2">Upload Your Recent Profile Picture</label>
                              <input class="form-control form-control-file" type="file" name="profile" id="profile" accept="image/png, image/gif, image/jpeg" required>
                           </div>
                        </div>

                        <div class="step col-12">
                           <h4>Provide us your Account Information:</h4>
                           <div class="form-floating mt-1">
                              <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="" required>
                              <label for="email">Email</label>
                           </div>
                           <div class="form-floating mt-2">
                              <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="" required>
                              <label for="password">Account Password</label>
                           </div>
                           <div class="form-floating mt-2">
                              <input type="password" class="form-control form-control-user" id="confirm_password" name="confirm_password" placeholder="" required>
                              <label for="confirm_password">Confirm Account Password</label>
                           </div>
                        </div>

                        <div class="step col-12">
                           <div class="mt-1">
                              <div class="closing-text">
                                 <h4>That's it!</h4>
                                 <p class="my-1">Kindly double check your informations before proceeding.</p>
                                 <p class="my-1">Tick the checkbox then click on the <span class="fst-italic">SUBMIT</span> button to continue.</p>
                              </div>
                              <div class="form-check mt-3">
                                   <input class="form-check-input" type="checkbox" id="confirmInfo">
                                   <label class="form-check-label" for="confirmInfo" id="confirmInfoLabel">
                                     I hereby declare that the informations I provided is true.
                                   </label>
                              </div>
                           </div>
                        </div>

                        <div id="success">
                           <div class="mt-5">
                              <h4>Registration complete! Kindly wait for approval.</h4>
                              <p>Give us enough time to evaluate your informations so we can approve your account. A message will be sent to your email once your account is ready. Thank you!</p>
                              <a class="back-link" href="login.php">Go to login page. ➜</a>
                           </div>
                        </div>
                     </div>
                     <div id="q-box__buttons" class="d-flex justify-content-between mt-3">
                        <button id="prev-btn" type="button" class="">Previous</button> 
                        <button id="next-btn" type="button" class="">Next</button> 
                        <button id="submit-btn" type="submit">Submit</button>
                     </div>
                  </form>
                  <hr>
                  <p class="text-center" id="aoaa">Already own an account? <span><a href="login.php">Login!</a></span></p>
               </div>
            </div>
         </div>
      </div>

      <div id="preloader-wrapper">
         <div id="preloader"></div>
         <div class="preloader-section section-left"></div>
         <div class="preloader-section section-right"></div>
      </div>

      <script src="./js/register.js"></script>

      <script>
         // Birth Date Validation
         document.getElementById('birth_date').addEventListener('change', function() {
             var inputDate = new Date(this.value);
             var currentDate = new Date();

             // Check if the input date is set and not in the future
             if (!this.value || inputDate > currentDate) {
                 Swal.fire({
                     icon: 'warning',
                     title: 'Invalid...',
                     text: 'Please select a valid birthdate'
                 });
                 $('input[name="birth_date"]').css('border', '1px solid red');
                 this.value = ''; // Clear the input field
             } else if (inputDate.getMonth() === currentDate.getMonth() && inputDate.getDate() === currentDate.getDate() && inputDate.getFullYear() === currentDate.getFullYear()) {
                 Swal.fire({
                     icon: 'warning',
                     title: 'Invalid...',
                     text: 'Please do not select the current date'
                 });
                 $('input[name="birth_date"]').css('border', '1px solid red');
                 this.value = ''; // Clear the input field
             }
         });

         // Input Element for Contact Number
         function limitContactInputLength(event) {
             // Remove non-digit characters
             var inputValue = event.target.value.replace(/\D/g, '');

             // Limit the length to 11 digits
             if (inputValue.length > 11) {
                 inputValue = inputValue.slice(0, 11);
             }

             // Update the input value
             event.target.value = inputValue;
         }

         // Contact Input Validation
         var contactInput = document.getElementById('contact');
         contactInput.addEventListener('input', limitContactInputLength);

         // Emergency Contact Input Validation
         var emergencyContact = document.getElementById('emergency_contact');
         emergencyContact.addEventListener('input', limitContactInputLength);


         // Classification Select Validation
         document.addEventListener("DOMContentLoaded", function() {
             var classificationSelectDiv = document.getElementById("class_selection_div");
             var classificationSelect = document.getElementById("classification");

             var employeeNoDiv = document.getElementById("employee_number_div");
             var studentNoDiv = document.getElementById("student_number_div");

             var employeeNoInput = document.getElementById("employee_number");
             var studentNoInput = document.getElementById("student_number");

             var courseSelectDiv = document.getElementById("course_selection");
             var courseSelect = document.getElementById("course");

             var yearSelectDiv = document.getElementById("year_selection");
             var yearSelect = document.getElementById("year_level");

             var occupationDiv = document.getElementById("occupation_input");
             var occupationInput = document.getElementById("occupation");

             classificationSelect.addEventListener("change", function() {
                 if (classificationSelect.value === "student") {
                     // show student number field
                     classificationSelectDiv.classList.add('col-lg-6', 'col-md-6');
                     studentNoDiv.classList.remove('d-none');
                     studentNoInput.setAttribute('required', '');

                     // show course and year fields
                     courseSelectDiv.classList.remove('d-none');
                     courseSelect.setAttribute('required', '');
                     yearSelectDiv.classList.remove('d-none');
                     yearSelect.setAttribute('required', '');

                     // hide employee number field
                     employeeNoDiv.classList.add('d-none');
                     employeeNoInput.removeAttribute('required');

                     // hide occupation field
                     occupationDiv.classList.add('d-none');
                     occupationInput.removeAttribute('required');

                     // focus to course selection
                     studentNoInput.focus();

                     // remove borders
                     courseSelect.style.border = '';
                     yearSelect.style.border = '';
                     occupationInput.style.border = '';
                     studentNoInput.style.border = '';
                     employeeNoInput.style.border = '';
                 } else if (classificationSelect.value === "employee") {
                     // show employee number field
                     classificationSelectDiv.classList.add('col-lg-6', 'col-md-6');
                     employeeNoDiv.classList.remove('d-none');
                     employeeNoInput.setAttribute('required', '');

                     // hide course and year fields
                     courseSelectDiv.classList.add('d-none');
                     courseSelect.removeAttribute('required');
                     yearSelectDiv.classList.add('d-none');
                     yearSelect.removeAttribute('required');

                     // hide student number field
                     studentNoDiv.classList.add('d-none');
                     studentNoInput.removeAttribute('required');

                     // show occupation field
                     occupationDiv.classList.remove('d-none');
                     occupationInput.setAttribute('required', '');

                     // focus to occupation input
                     employeeNoInput.focus();

                     // remove borders
                     courseSelect.style.border = '';
                     yearSelect.style.border = '';
                     occupationInput.style.border = '';
                     studentNoInput.style.border = '';
                     employeeNoInput.style.border = '';
                 }
             });
         });

         // Get the form element
         const formElement = document.getElementById('form-wrapper');

         // Add event listener for keydown event
         formElement.addEventListener('keydown', function(event) {
             // Check if the pressed key is Enter (key code 13)
             if (event.keyCode === 13) {
                 // Prevent default form submission behavior
                 event.preventDefault();
             }
         });
      </script>

      <script>
         document.getElementById('email').addEventListener('change', function() {
             var email = this.value;

             // Check if "@" symbol is present in the email
             if (email.indexOf('@') === -1) {
                 Swal.fire({
                     icon: 'warning',
                     title: 'Invalid...',
                     text: 'Please enter a valid email address'
                 });
                 $('input[name="email"]').css('border', '1px solid red');
                 this.value = ''; // Clear the input field
             }
         });
      </script>

   </body>
</html>