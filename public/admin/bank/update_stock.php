

<?php
include "header.php";

include '../../../includes/db_connection.php';
$sql="";

?>

    
		<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Blood Stock</h4>
                            </div>
                            <div class="content">
                                <form method="get">

  <table id="box-table-a">
    <thead>
      <tr>

        <th>Blood Group</th>
          <th>Low</th>
          <th>Max</th>
          <th>Optimum</th>
          <th>Available</th>
        
      </tr>
    </thead>
      <form>
    <tbody>
      <tr>
          <td>A+</td>
          <td> <input type="number" required class="form-control" placeholder="no.of bags" value='' name="A+ low"></td>
          <td> <input type="number" required class="form-control" placeholder="no.of bags" value='' name="A+ max"></td>
          <td> <input type="number" required class="form-control" placeholder="no.of bags" value='' name="A+ optimum"></td>
          <td> <input type="number" required class="form-control" placeholder="no.of bags" value='' name="A+ optimum"></td>
      </tr>





    

       </tbody>
      </form>
      </table>


		        <br>

                <button type="submit" name="update_stock" class="btn btn-info btn-fill pull-right">Update Stock</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    

                </div>
            </div>
        </div>


<?php
include "footer.php";
?>
		
		

