<!DOCTYPE html>
<html>
<head>
  <title>Bootstrap 4 Alerts on Button Click (addEventListener)</title>
  <!-- Include Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-5">
    <!-- Button to show the alert -->
    <button type="button" class="btn btn-primary" id="showAlertBtn">
      Show Alert
    </button>

    <!-- Alert (hidden by default) -->
    <div class="alert alert-success mt-3" role="alert" id="myAlert" style="display: none;">
      This is a Bootstrap 4 alert!
      <button type="button" class="close" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  </div>

  <!-- Include Bootstrap JS -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    // Function to show the alert
    function showAlert() {
      const alertElement = document.getElementById('myAlert');
      alertElement.style.display = 'block';
    }

    // Function to hide the alert
    function hideAlert() {
      const alertElement = document.getElementById('myAlert');
      alertElement.style.display = 'none';
    }

    // Bind the click event to the button to show the alert
    const showAlertBtn = document.getElementById('showAlertBtn');
    showAlertBtn.addEventListener('click', showAlert);

    // Bind the click event to the close button of the alert to hide it
    const closeButton = document.querySelector('#myAlert .close');
    closeButton.addEventListener('click', hideAlert);
  </script>
</body>
</html>
