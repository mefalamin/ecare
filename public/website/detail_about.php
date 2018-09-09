

<div id="home" class="tab-pane fade in <?php if(!isset($_GET['search_doctor']) ) echo "active"  ?>">

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <br>
                        <div class="content">

                            <div class="row">
                                <div class="col-md-8">
                                    <h1 style="font-size: 40px"><?php echo $hospital['name'] ?></h1>
                                  <p style="font-size: large">Our Speciality:<?php echo $hospital['speciality'] ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7">
                                    <p style="font-size: large">Address: <?php echo $hospital['address'] ?></p>
                                </div>
                                <div class="col-md-4">
                                    <button class="button">See in Map</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-9">
                                    <p style="font-size: large">Contact us : <?php echo $hospital['phone'] ?></p>
                                    <p style="font-size: large">Fax:  <?php echo $hospital['fax'] ?> </p>
                                    <p style="font-size: large;color: red">Emergency : <?php echo $hospital['emergency'] ?> </p>
                                </div>
                            </div>

                        </div>
                    </div> <br>
                </div>


            </div>
        </div>


</div>