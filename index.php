
<?php require_once 'includes/header.php'; ?>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 text-center">
      <h1>Tickets</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-md-3">
      <h2>Add new ticket</h2>
      <form id="ticket-form">
        <div class="form-group">
          <label for="formGroupExampleInput">Name</label>
          <input type="text" class="form-control" id="Name" placeholder="Example input">
        </div>
        <div class="form-group">
          <label for="exampleFormControlTextarea1">Description</label>
          <textarea class="form-control" id="Description" rows="3"></textarea>
        </div>
        <div class="form-group" id="company-form-group">
 
        </div>
        <div class="form-group">
          <label for="formGroupExampleInput">Date</label>
          <input type="date" class="form-control" id="Date" placeholder="Example input">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
    <div class="col-md-9">
      <table class="table table-bordered" >
        <thead>
          <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Company</th>
            <th>Date Due</th>
            <th>Completed</th>
            <th colspan="2">Controls</th>
          </tr>
        </thead>
        <tbody id="table-body">

        </tbody>
      </div>
    </div>
    
  </div>

</div>





<?php require_once 'includes/footer.php'; ?>