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
                             <input type="text" class="form-control form-control-user" id="first_name" name="first_name" placeholder="" requireda>
                             <label for="first_name">First Name</label>
                           </div>
                           <div class="form-floating mt-2">
                             <input type="text" class="form-control form-control-user" id="mid_name" name="mid_name" placeholder="">
                             <label for="mid_name">Middle Name</label>
                           </div>
                           <div class="row g-1">
                              <div class="col-lg-9 col-md-9 col-12">
                                 <div class="form-floating mt-2">
                                   <input type="text" class="form-control form-control-user" id="last_name" name="last_name" placeholder="" requireda>
                                   <label for="last_name">Last Name</label>
                                 </div>
                              </div>
                              <div class="col-lg-3 col-md-3 col-12">
                                 <div class="form-floating mt-2">
                                   <select id="ext_name" name="ext_name" class="form-control form-select" placeholder="">
                                       <option value="na" selected>N/A</option>
                                       <option value="JR">JR</option>
                                       <option value="SR">SR</option>
                                       <option value="II">II</option>
                                       <option value="III">III</option>
                                       <option value="IV">IV</option>
                                       <option value="V">V</option>
                                    </select>
                                   <label for="ext_name">Suffix</label>
                                 </div>
                              </div>
                           </div>
                           <div class="row g-1">
                              <div class="col-lg-7 col-md-7 col-12">
                                 <div class="form-floating mt-2">
                                   <input class="form-control" id="birth_date" name="birth_date" type="date" requireda>
                                   <label for="birth_date">Birthdate</label>
                                 </div>
                              </div>
                              <div class="col-lg-5 col-md-5 col-12">
                                 <div class="form-floating mt-2">
                                   <select name="sex" class="form-control form-select" id="sex" requireda>
                                       <option value="" disabled selected>Select sex</option>
                                       <option value="Male">Male</option>
                                       <option value="Female">Female</option>
                                    </select>
                                   <label for="sex">Sex</label>
                                 </div>
                              </div>
                           </div>
<!--                            <div class="row g-2">
                              <div class="col-lg-7 col-md-7 col-12">
                                 <div class="form-floating mt-2">
                                   <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="" required>
                                   <label for="email">Personal Email</label>
                                 </div>
                              </div>
                              <div class="col-lg-5 col-md-5 col-12">
                                 <div class="form-floating mt-2">
                                   <input type="number" class="form-control form-control-user" id="contact" name="contact" placeholder="" required>
                                   <label for="contact">Contact No. (11 digits)</label>
                                 </div>
                              </div>
                           </div> -->
                           <div class="row g-1">
                              <div class="col-lg-12 col-md-12 col-12">
                                 <div class="form-floating mt-2">
                                   <input type="text" class="form-control form-control-user" id="address" name="addresss" placeholder="" requireda>
                                   <label for="address">Address</label>
                                 </div>
                              </div>
                              <!-- <div class="col-lg-5 col-md-5 col-15">
                                <div class="form-floating mt-2">
                                   <select name="barangay" class="form-control form-select" id="barangay" required>
                                       <option value="" disabled selected>Select Barangay</option>
                                       <option value="Bancal">Bancal</option>
                                       <option value="Bangan">Bangan</option>
                                       <option value="Batonlapoc">Batonlapoc</option>
                                       <option value="Belbel">Belbel</option>
                                       <option value="Beneg">Beneg</option>
                                       <option value="Binuclutan">Binuclutan</option>
                                       <option value="Burgos">Burgos</option>
                                       <option value="Cabatuan">Cabatuan</option>
                                       <option value="Capayawan">Capayawan</option>
                                       <option value="Carael">Carael</option>
                                       <option value="Danacbunga">Danacbunga</option>
                                       <option value="Maguisguis">Maguisguis</option>
                                       <option value="Malomboy">Malomboy</option>
                                       <option value="Mambog">Mambog</option>
                                       <option value="Moraza">Moraza</option>
                                       <option value="Nacolcol">Nacolcol</option>
                                       <option value="Owaog-Nibloc">Owaog-Nibloc</option>
                                       <option value="Paco (poblacion)">Paco (poblacion)</option>
                                       <option value="Palis">Palis</option>
                                       <option value="Panan">Panan</option>
                                       <option value="Parel">Parel</option>
                                       <option value="Paudpod">Paudpod</option>
                                       <option value="Poonbato">Poonbato</option>
                                       <option value="Porac">Porac</option>
                                       <option value="San Isidro">San Isidro</option>
                                       <option value="San Juan">San Juan</option>
                                       <option value="San Miguel">San Miguel</option>
                                       <option value="Santiago">Santiago</option>
                                       <option value="Tampo (poblacion)">Tampo (poblacion)</option>
                                       <option value="Taugtog">Taugtog</option>
                                       <option value="Villar">Villar</option>
                                    </select>
                                   <label for="barangay">Barangay</label>
                                 </div>
                              </div> -->
                           </div>
                        </div>

                        <div class="step col-12">
                           <h4>Provide us your Resort Information:</h4>
                           <div class="form-floating mt-1">
                              <input type="text" class="form-control form-control-user" id="resort_name" name="resort_name" placeholder="" required>
                              <label for="resort_name">Resort's Name</label>
                           </div>
                           <div class="row g-2">
                              <div class="col-lg-7 col-md-7 col-12">
                                 <div class="form-floating mt-2">
                                   <input type="email" class="form-control form-control-user" id="resort_email" name="resort_email" placeholder="" required>
                                   <label for="resort_email">Resort's Email</label>
                                 </div>
                              </div>
                              <div class="col-lg-5 col-md-5 col-12">
                                 <div class="form-floating mt-2">
                                   <input type="number" limit="11" class="form-control form-control-user" id="resort_contact" name="resort_contact" placeholder="" required>
                                   <label for="resort_contact">Resort's Contact No.</label>
                                 </div>
                              </div>
                           </div>
                           <div class="row g-2">
                              <div id="nature_div" class="col-12">
                                 <div class="form-floating mt-2">
                                   <select name="resort_nature" class="form-control form-select" id="resort_nature" required>
                                       <option value="" disabled selected>Choose nature of establishment</option>
                                       <option value="Inland">Inland</option>
                                       <option value="Beach Resort">Beach Resort</option>
                                       <option value="Mountain Resort">Mountain Resort</option>
                                       <option value="Wildlife/Zoo">Wildlife/Zoo</option>
                                       <?php 
                                          
                                       ?>
                                       <option value="Other">Other</option>
                                    </select>
                                    <label for="resort_nature">Resort's Nature</label>
                                 </div>
                              </div>
                              <div id="nature_div_others" class="col-lg-5 col-md-5 col-12 d-none">
                                 <div class="form-floating mt-2">
                                    <input type="text" class="form-control form-control-user" id="resort_nature_others" name="resort_nature_others" placeholder="">
                                    <label for="resort_nature_others">Specify Resort's Nature</label>
                                 </div>
                              </div>
                           </div>
                           <div class="row g-2">
                              <div id="itemshop_div" class="col-12">
                                 <div class="form-floating mt-2">
                                   <select name="resort_itemshop" class="form-control form-select" id="resort_itemshop" required>
                                       <option value="" disabled selected>Choose shop products</option>
                                       <option value="Foods">Foods</option>
                                       <option value="Arts & Crafts">Arts & Crafts</option>
                                       <option value="Other">Other</option>
                                    </select>
                                    <label for="resort_itemshop">Resort's Product</label>
                                 </div>
                              </div>
                              <div id="itemshop_div_others" class="col-lg-5 col-md-5 col-12 d-none">
                                 <div class="form-floating mt-2">
                                    <input type="text" class="form-control form-control-user" id="resort_itemshop_others" name="resort_itemshop_others" placeholder="">
                                    <label for="resort_itemshop_others">Specify Resort's Product</label>
                                 </div>
                              </div>
                           </div>
                           <div class="row g-1">
                              <div class="col-lg-7 col-md-7 col-12">
                                 <div class="form-floating mt-2">
                                   <input type="text" class="form-control form-control-user" id="resort_address" name="resort_address" placeholder="" required>
                                   <label for="resort_address">Resort's Address (street, etc)</label>
                                 </div>
                              </div>
                              <div class="col-lg-5 col-md-5 col-15">
                                <div class="form-floating mt-2">
                                   <select name="resort_barangay" class="form-control form-select" id="resort_barangay" required>
                                       <option value="" disabled selected>Select Barangay</option>
                                       <option value="Bancal">Bancal</option>
                                       <option value="Bangan">Bangan</option>
                                       <option value="Batonlapoc">Batonlapoc</option>
                                       <option value="Belbel">Belbel</option>
                                       <option value="Beneg">Beneg</option>
                                       <option value="Binuclutan">Binuclutan</option>
                                       <option value="Burgos">Burgos</option>
                                       <option value="Cabatuan">Cabatuan</option>
                                       <option value="Capayawan">Capayawan</option>
                                       <option value="Carael">Carael</option>
                                       <option value="Danacbunga">Danacbunga</option>
                                       <option value="Maguisguis">Maguisguis</option>
                                       <option value="Malomboy">Malomboy</option>
                                       <option value="Mambog">Mambog</option>
                                       <option value="Moraza">Moraza</option>
                                       <option value="Nacolcol">Nacolcol</option>
                                       <option value="Owaog-Nibloc">Owaog-Nibloc</option>
                                       <option value="Paco (poblacion)">Paco (poblacion)</option>
                                       <option value="Palis">Palis</option>
                                       <option value="Panan">Panan</option>
                                       <option value="Parel">Parel</option>
                                       <option value="Paudpod">Paudpod</option>
                                       <option value="Poonbato">Poonbato</option>
                                       <option value="Porac">Porac</option>
                                       <option value="San Isidro">San Isidro</option>
                                       <option value="San Juan">San Juan</option>
                                       <option value="San Miguel">San Miguel</option>
                                       <option value="Santiago">Santiago</option>
                                       <option value="Tampo (poblacion)">Tampo (poblacion)</option>
                                       <option value="Taugtog">Taugtog</option>
                                       <option value="Villar">Villar</option>
                                    </select>
                                   <label for="resort_barangay">Barangay</label>
                                 </div>
                              </div>
                              <div class="form-floating mt-2">
                                   <input type="text" class="form-control form-control-user" id="resort_fb" name="resort_fb" placeholder="">
                                   <label for="resort_fb">Resort's Website / FB Page (optional)</label>
                              </div>
                           </div>
                           <div class="mt-2">
                              <label for="resort_permit" class="mb-2">Upload Your Resort's Permit</label>
                              <input class="form-control form-control-file" type="file" name="resort_permit" id="resort_permit" accept="image/png, image/gif, image/jpeg" required>
                           </div>
                        </div>

                        <div class="step col-12">
                           <h4>Provide us your Account Information:</h4>
                           <div class="form-floating mt-1">
                              <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="" required>
                              <label for="username">Account Username</label>
                           </div>
                           <div class="form-floating mt-2">
                              <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="" required>
                              <label for="username">Account Password</label>
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

         // Resort Contact Input Validation
         var resortContact = document.getElementById('resort_contact');
         resortContact.addEventListener('input', limitContactInputLength);

         // Nature Select Validation
         document.addEventListener("DOMContentLoaded", function() {
             var natureSelect = document.getElementById("resort_nature");
             var natureInputDiv = document.getElementById("nature_div");
             var otherNatureInputDiv = document.getElementById("nature_div_others");
             var otherNatureInput = document.getElementById("resort_nature_others");

             natureSelect.addEventListener("change", function() {
                 if (natureSelect.value === "Other") {
                     natureInputDiv.classList.add('col-lg-7', 'col-md-7');
                     otherNatureInputDiv.classList.remove('d-none');
                     otherNatureInput.setAttribute('required', ''); // Add the 'required' attribute
                     otherNatureInput.focus();
                 } else {
                     natureInputDiv.classList.remove('col-lg-7', 'col-md-7');
                     otherNatureInputDiv.classList.add('d-none');
                     otherNatureInput.removeAttribute('required'); // Remove the 'required' attribute
                     otherNatureInput.style.border = ''; // Removes the border style
                 }
             });
         });

         // Itemshop Select Validation
         document.addEventListener("DOMContentLoaded", function() {
             var itemshopSelect = document.getElementById("resort_itemshop");
             var itemshopDiv = document.getElementById("itemshop_div");
             var otherItemshopDiv = document.getElementById("itemshop_div_others");
             var otherItemshopInput = document.getElementById("resort_itemshop_others");

             itemshopSelect.addEventListener("change", function() {
                 if (itemshopSelect.value === "Other") {
                     itemshopDiv.classList.add('col-lg-7', 'col-md-7');
                     otherItemshopDiv.classList.remove('d-none');
                     otherItemshopInput.setAttribute('required', ''); // Add the 'required' attribute
                     otherItemshopInput.focus();
                 } else {
                     itemshopDiv.classList.remove('col-lg-7', 'col-md-7');
                     otherItemshopDiv.classList.add('d-none');
                     otherItemshopInput.removeAttribute('required'); // Remove the 'required' attribute
                     otherItemshopInput.style.border = ''; // Removes the border style
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

   <!-- email constraint -->
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

      document.getElementById('resort_email').addEventListener('change', function() {
          var email = this.value;

          // Check if "@" symbol is present in the email
          if (email.indexOf('@') === -1) {
              Swal.fire({
                  icon: 'warning',
                  title: 'Invalid...',
                  text: 'Please enter a valid email address'
              });
              $('input[name="resort_email"]').css('border', '1px solid red');
              this.value = ''; // Clear the input field
          }
      });

   </script>

   </body>
</html>