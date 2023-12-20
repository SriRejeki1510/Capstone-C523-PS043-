<?php
session_start();
$title = 'rekap';
require 'functions.php';
require 'layout_header.php';
$query = 'SELECT * FROM user_data';
$data = ambildata($conn,$query);
?> 
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Rekap data</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="#"></a></li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="white-box">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button id="btn-refresh" class="btn btn-primary box-title text-right" title="Refresh Data"><i class="fa fa-refresh" id="ic-refresh"></i></button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered thead-dark" id="table">
                        <thead class="thead-dark">
                            <tr>
                                <th width="5%">#</th>
                                <th>First Name</th>
                                <th>durasi kegiatan</th>
                                <th>hari</th>
                                <th>status</th>
                              
                                <th width="15%">Detail chart</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data as $user_data): ?>
                                <tr>
                                    <td></td>
                                    <td><?= $user_data['first_name'] ?></td>
                                    <td><?= $user_data['activity_duration'] ?> jam</td>
                                    <td><?= $user_data['day_of_week'] ?></td>
                                    <td><?= $user_data['recommendation'] ?></td>
                                    <td align="center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                          <a href="user_chart.php?first_name=<?= $user_data['first_name']; ?>" data-toggle="tooltip" data-placement="bottom" title="chart" class="btn btn-success"><i class="fa fa-tachometer fa-fw"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- table -->
    <!-- ============================================================== -->
    <div class="row">
        
    </div>
</div>
<?php
require'layout_footer.php';
