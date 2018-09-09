

<?php
require('header.php');
?>

		<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Add Event</h4>
                            </div>

		                <div class="content">
                                <form>
                                    <div class="row">
                                         <div class="col-md-7">
                                            <div class="form-group">
                                                <label>Blood Bank Name (disabled)</label>
                                                <input type="text" class="form-control" disabled placeholder="Company" value="Abc">
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Contact</label>
                                                <input type="text" class="form-control" placeholder="phone no" value="">
                                            </div>
                                        </div>
										
                                        
                                    </div>
                                    
								     <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Event Address</label>
                                                <input type="text" class="form-control" placeholder="House no Road no" value="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Area</label>
                                                <input type="text" class="form-control" placeholder="Area" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>City</label>
                                                <input type="text" class="form-control" placeholder="City" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>District</label>
                                                <input type="text" class="form-control" placeholder="District">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
									    <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Day</label>
                                                <input type="date" class="form-control" placeholder="Speciality" value="Cardiac">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Start time</label>
                                                <input type="time" class="form-control" placeholder="start time" value="">
                                            </div>
                                        </div>
										
										<div class="col-md-4">
                                            <div class="form-group">
                                                <label>End Time</label>
                                                <input type="time" class="form-control" placeholder="end time" value="">
                                            </div>
                                        </div>
										
                                        
                                    </div>

                                   

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Event Description</label>
                                                <textarea rows="5" class="form-control" placeholder="Details" value=""></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-info btn-fill pull-right">Submit</button>
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
		
