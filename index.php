<?php
    include "form.php";
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>DWA15 | Project 2</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!--Bootstrap 4 CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <!--Custom CSS -->
  <link rel="stylesheet" href="css/project-2.css">
</head>
<body>
  <!--Main Container -->
  <div class="container-fluid">
      <h2>Vehicle Buddy</h2>
      <p>Search for vehicle-specific services by address.</p>
      <hr>
      <form method='GET' action='' enctype='multipart/form-data'>
        <div class="form-group">
          <label for="varStreetAddress">Street Address</label>
          <input type="text" class="form-control" id="varStreetAddress" name="varStreetAddress">
        </div>
        <div class="form-group">
          <label for="varZipCode">Zip Code</label>
          <input type="text" class="form-control" id="varZipCode" name="varZipCode" >
        </div>
        <div class="form-group">
          <label for="varSicCode">Vehicle Service Station</label>
          <select class="form-control" id="varSicCode" name="varSicCode">
            <option value="none">---Select---</option>
            <option value="554101">Gas Station</option>
            <option value="554112">Electric Charging Station</option>
            <option value="753201">Auto Body Shop</option>
            <option value="754201">Car Wash</option>
          </select>
        </div>
        <div class="form-group">
          <label for="varSearchRadius">Search Radius (miles)</label>
          <input type="number" class="form-control" id="varSearchRadius" name="varSearchRadius" min="0" max="10">
        </div>
        <input class="btn btn-success" type="submit" value="Search">
      </form>
      <hr>
<div id="tblSearchResults" name="tblSearchResults" class="container-fluid" style="<?php echo $tblStyle; ?>">
      <h2>Search Results</h2>
      <p></p>
      <table class="table tbl-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>Distance (m)</th>
            <th>Name</th>
            <th>Address</th>
            <th>City</th>
            <th>State</th>
            <th>Zip Code</th>
            <th>Phone</th>
          </tr>
        </thead>
        <tbody>
          <?php echo $tblSearchResults ?? null; ?>
        </tbody>
      </table>
</div>
  </div><!--/Main Container -->
</body>
</html>
