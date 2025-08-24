
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<?php $__env->startSection('content'); ?>

<div class="app-content content">
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>
  <div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body">
      <section id="dashboard-ecommerce">
        <div class="dashboard-boxes">
          <div class="row">
            <div class="col-md-3">
              <div class="card card-statistics">
                <div class="boxes-block">
                  <a href="#">
                   <i class="fa-brands fa-product-hunt"></i>
                    <h4><span>120K</span> Total Products</h4>
                  </a>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card card-statistics">
                <div class="boxes-block">
                  <a href="#">
                    <i class="fa-solid fa-users"></i>
                    <h4><span>234</span> Customers </h4>
                  </a>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card card-statistics">
                <div class="boxes-block">
                  <a href="#">
                    <i class="fa-solid fa-receipt"></i>
                    <h4><span>34</span> Quotes Request</h4>
                  </a>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card card-statistics">
                <div class="boxes-block">
                  <a href="#">
                    <i class="fa-solid fa-money-bill"></i>
                    <h4><span>£ 987654</span> Quotes Estimation</h4>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row match-height">
          <div class="col-lg-8 col-12">
            <div class="card card-revenue-budget">
              <div class="row mx-0">
                <div class="col-md-8 col-12 revenue-report-wrapper">
                  <div class="d-sm-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title mb-50 mb-sm-0">Quotation Report</h4>
                    <!--<div class="d-flex align-items-center">-->
                    <!--  <div class="d-flex align-items-center mr-2">-->
                    <!--    <span class="bullet bullet-primary font-small-3 mr-50 cursor-pointer"></span>-->
                    <!--    <span>Earningss</span>-->
                    <!--  </div>-->
                    <!--  <div class="d-flex align-items-center ml-75">-->
                    <!--    <span class="bullet bullet-warning font-small-3 mr-50 cursor-pointer"></span>-->
                    <!--    <span>Refund</span>-->
                    <!--  </div>-->
                    <!--</div>-->
                  </div>
                  <div id="revenue-report-chart"></div>
                </div>
                <div class="col-md-4 col-12 budget-wrapper">
                  <div class="btn-group">
                    <button type="button" class="btn btn-outline-primary btn-sm dropdown-toggle budget-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          2025
                        </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="javascript:void(0);">2020</a>
                      <a class="dropdown-item" href="javascript:void(0);">2019</a>
                      <a class="dropdown-item" href="javascript:void(0);">2018</a>
                    </div>
                  </div>
                  <h2 class="mb-25">£ 25852000</h2>
                  <div class="d-flex justify-content-center">
                    <span class="font-weight-bolder mr-25"> Last Month:</span>
                    <span>£ 445354</span>
                  </div>
                  <div id="budget-chart"></div>
                  <button type="button" class="btn btn-primary">View Quote Request</button>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-12">
            <div class="row match-height">
              <div class="col-lg-6 col-md-3 col-6">
                <div class="card">
                  <div class="card-body pb-50">
                    <h6>Customers</h6>
                    <h2 class="font-weight-bolder mb-1">2,76k</h2>
                    <div id="statistics-order-chart"></div>
                  </div>
                </div>
              </div>

              <div class="col-lg-6 col-md-3 col-6">
                <div class="card card-tiny-line-stats">
                  <div class="card-body pb-50">
                    <h6>Quote Request
</h6>
                    <h2 class="font-weight-bolder mb-1">6,24k</h2>
                    <div id="statistics-profit-chart"></div>
                  </div>
                </div>
              </div>

              <div class="col-lg-12 col-md-6 col-12">
                <div class="card earnings-card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-6">
                        <h4 class="card-title mb-1">Quote Estimates</h4>
                        <div class="font-small-2">This Month</div>
                        <h5 class="mb-1">£ 405545</h5>
                        <p class="card-text text-muted font-small-2">
                          <span class="font-weight-bolder">68.2%</span><span> more earnings than last month.</span>
                        </p>
                      </div>
                      <div class="col-6">
                        <div id="earnings-chart"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

       <div class="row match-height">
  <div class="col-xl-12 col-md-12 col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Recent Quote Requests</h4>
      </div>
      <div class="card-body">
        <ul class="nav nav-tabs" id="quoteTabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="seven-days-tab" data-toggle="tab" href="#seven-days" role="tab" aria-controls="seven-days" aria-selected="true">7 Days</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="fifteen-days-tab" data-toggle="tab" href="#fifteen-days" role="tab" aria-controls="fifteen-days" aria-selected="false">15 Days</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="thirty-days-tab" data-toggle="tab" href="#thirty-days" role="tab" aria-controls="thirty-days" aria-selected="false">30 Days</a>
          </li>
          <li class="nav-item ml-auto">
            <button class="btn btn-primary">Show All</button>
          </li>
        </ul>
        <div class="tab-content mt-2">
          <div class="tab-pane active" id="seven-days" role="tabpanel" aria-labelledby="seven-days-tab">
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Date & Time</th>
                    <th>Quote Number</th>
                    <th>Customer Info</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>2025-07-10 14:30</td>
                    <td>#345446<br>Books > Comics Book</td>
                    <td>John Doe<br>john.doe@example.com<br>+1-555-123-4567</td>
                    <td><button class="btn btn-sm btn-info">Show Detail</button></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="tab-pane" id="fifteen-days" role="tabpanel" aria-labelledby="fifteen-days-tab">
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Date & Time</th>
                    <th>Quote Number</th>
                    <th>Customer Info</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>2025-07-05 09:15</td>
                    <td>#345447<br>Books > Graphic Novels</td>
                    <td>Jane Smith<br>jane.smith@example.com<br>+1-555-987-6543</td>
                    <td><button class="btn btn-sm btn-info">Show Detail</button></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="tab-pane" id="thirty-days" role="tabpanel" aria-labelledby="thirty-days-tab">
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Date & Time</th>
                    <th>Quote Number</th>
                    <th>Customer Info</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>2025-06-25 16:45</td>
                    <td>#345448<br>Books > Manga</td>
                    <td>Alice Brown<br>alice.brown@example.com<br>+1-555-456-7890</td>
                    <td><button class="btn btn-sm btn-info">Show Detail</button></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
      </section>

    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\new\resources\views/home.blade.php ENDPATH**/ ?>