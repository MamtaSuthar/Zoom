<?php 

require_once(dirname(__FILE__).'/manager/session_manager.php');
require_once(dirname(__FILE__).'/includes/config.php');
isSessionValid(true);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include(dirname(__FILE__).'/components/header.php'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo url ?>/customecss/css/select2.min.css">
   <link rel="stylesheet" type="text/css" href="<?php echo url ?>/customecss/css/style.min.css">
   <link rel="stylesheet" type="text/css" href="<?php echo url ?>/customecss/css/dataTables.foundation.min.css">
   <style>
    .table-bordered{
        border: 1px solid #dee2e6 !important;
    }
    .apexcharts-legend .apexcharts-legend-series:last-child {
        display: none !important;
    }
   </style>
</head>

<body class="layout-boxed alt-menu">
    <!-- BEGIN LOADER -->
    <div id="load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->
    <?php include(dirname(__FILE__).'/components/navbar.php'); ?>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        <?php include(dirname(__FILE__).'/components/sidebar.php'); ?>
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">

        <div id="main-wrapper">

            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 ms-2 d-flex no-block align-items-center">
                        <h4 class="page-title">User Dashboard</h4>
                    </div>
                </div>
            </div>

            <div class="layout-px-spacing">
                <div class="middle-content container-xxl p-0">
                    <div class="row layout-top-spacing">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <h5 class="card-title">User Dashboard</h5>
                                            <div class="col-sm-12 col-lg-4">
                                                <h1 class="font-bold mb-1" id="past_camp_last_week">9</h1>
                                                <h6 class="mb-3">Emails Delivered (Past Week)</h6>
                                                <p>A weekly aggregation of all phishing emails delivered across all
                                                    active campaigns. Metrics are updated nightly.</p>
                                                <a class="mt-3 btn btn-lg btn-info"
                                                    href="<?=base_url?>mailcmpdashboard">View Detailed Reports</a>
                                            </div>

                                            <div class="col-sm-12 col-lg-8 border-left m-t-15 d-none d-md-block">

                                                <!-- <h5 class="card-subtitle">Statistics over the last 12 months (Updated Daily)</h5> -->
                                                <div id="dashboardchartmail">
                                                </div>
                                            </div>
                                            <div class="card-body border-top">
                                                <div class="row mb-0">
                                                    <!-- col -->
                                                    <div class="col-lg-3 col-md-6">
                                                        <div class="d-flex align-items-center">
                                                            <div class="mr-2"><span class="text-danger display-5"><i
                                                                        class="mdi mdi-email-fast-outline"></i></span>
                                                            </div>
                                                            <div>
                                                                <span>Active Campaigns</span>
                                                                <h3 class="font-medium mb-0" id="act_camp">0</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- col -->
                                                    <!-- col -->
                                                    <div class="col-lg-3 col-md-6">
                                                        <div class="d-flex align-items-center">
                                                            <div class="mr-2"><span class="text-info display-5"><i
                                                                        class="mdi mdi-email"></i></span></div>
                                                            <div>
                                                                <span>Emails Delivered</span>
                                                                <h3 class="font-medium mb-0" id='userDelMail'></h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- col -->
                                                    <!-- col -->
                                                    <div class="col-lg-3 col-md-6">
                                                        <div class="d-flex align-items-center">
                                                            <div class="mr-2"><span class="text-primary display-5"><i
                                                                        class="mdi mdi-web"></i></span></div>
                                                            <div>
                                                                <span>Past Campaigns</span>
                                                                <h3 class="font-medium mb-0" id="past_comp">0</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- col -->
                                                    <!-- col -->
                                                    <div class="col-lg-3 col-md-6">
                                                        <div class="d-flex align-items-center">
                                                            <div class="mr-2"><span class="text-cyan display-5"><i
                                                                        class="mdi mdi-school"></i></span></div>
                                                            <div>
                                                                <span>Training Modules</span>
                                                                <h3 class="font-medium mb-0">0</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- col -->
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <h5 class="card-title">Phishing Campaign Success</h5>
                                            <h6>Overview of Phishing Campaign Interactions (Past Week)</h6>
                                            <div class="col-sm-12 col-lg-12 m-t-15 d-none d-md-block">
                                                <div style="text-align:center;">
                                                    <h1 class="font-bold mb-1" id="mail_open"></h1>
                                                    <h6 class="mb-3">Phishing Email Interactions</h6>
                                                </div>
                                                <div id="roundchartmail">
                                                </div>
                                            </div>
                                            <!-- <div class="col-sm-12 col-lg-4">
                                                <h1 class="font-bold mb-1" id="mail_open"></h1>
                                                <h6 class="mb-3">Phishing Email Interactions</h6>
                                            </div> -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <h5 class="card-title">Employee Reported Phishing</h5>
                                            <div class="row">
                                                <div class="col-md-12 m-t-20">
                                                    <div class="row">
                                                        <div class="table-responsive">
                                                            <table id="table_mail_report_list" class="table table-bordered w-100 style-3 dt-table-hover dataTable no-footer">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Reported By</th>
                                                                        <th>Report Date</th>
                                                                        <th>Attribution</th>
                                                                        <th>Actions</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <h5 class="card-title">Domain Tool Search History</h5>
                                            <div class="row">
                                                <div class="col-md-12 m-t-20">
                                                    <div class="row">
                                                        <div class="table-responsive">
                                                            <table id="table_mail_search_history_list" class="table table-bordered w-100 style-3 dt-table-hover dataTable no-footer">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Domain Name</th>
                                                                        <th>Mail Gateway</th>
                                                                        <th>Spam Filter</th>
                                                                        <th>Malware Filter</th>
                                                                        <th>Mail Sender Status</th>
                                                                        <th>Mail Receiver Status</th>
                                                                        <th>Last Searched</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                            <div class="widget widget-six">
                                <div class="widget-heading">
                                    <h6 class="">Statisticsdcdcd</h6>
                                    <div class="task-action">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle" href="#" role="button" id="statistics"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-more-horizontal">
                                                    <circle cx="12" cy="12" r="1"></circle>
                                                    <circle cx="19" cy="12" r="1"></circle>
                                                    <circle cx="5" cy="12" r="1"></circle>
                                                </svg>
                                            </a>

                                            <div class="dropdown-menu left" aria-labelledby="statistics"
                                                style="will-change: transform;">
                                                <a class="dropdown-item" href="javascript:void(0);">View</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Download</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-chart">
                                    <div class="w-chart-section">
                                        <div class="w-detail">
                                            <p class="w-title">Total Visits</p>
                                            <p class="w-stats">423,964</p>
                                        </div>
                                        <div class="w-chart-render-one">
                                            <div id="total-users"></div>
                                        </div>
                                    </div>

                                    <div class="w-chart-section">
                                        <div class="w-detail">
                                            <p class="w-title">Paid Visits</p>
                                            <p class="w-stats">7,929</p>
                                        </div>
                                        <div class="w-chart-render-one">
                                            <div id="paid-visits"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div> -->


                        <!-- <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <h4 class="card-title">Phishing Success</h4>
                                            <h5 class="card-subtitle">Statistics over the last 12 months (Updated Daily)
                                            </h5>
                                            <div id="chartmail">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                        <!-- <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                            <div class="widget widget-card-five">
                                <div class="widget-content">
                                    <div class="account-box">

                                        <div class="info-box">
                                            <div class="icon">
                                                <span>
                                                    <img src="<?php echo url?>/src/assets/img/money-bag.png"
                                                        alt="money-bag">
                                                </span>
                                            </div>

                                            <div class="balance-info">
                                                <h6>Total Balance</h6>
                                                <p>$41,741.42</p>
                                            </div>
                                        </div>

                                        <div class="card-bottom-section">
                                            <div><span class="badge badge-light-success">+ 13.6% <svg
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-trending-up">
                                                        <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                                        <polyline points="17 6 23 6 23 12"></polyline>
                                                    </svg></span></div>
                                            <a href="javascript:void(0);" class="">View Report</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                        <!-- <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                            <div class="widget widget-chart-three">
                                <div class="widget-heading">
                                    <div class="">
                                        <h5 class="">User Dashboard</h5>
                                    </div>

                                    <div class="task-action">
                                        <div class="dropdown ">
                                            <a class="dropdown-toggle" href="#" role="button" id="uniqueVisitors"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                               <div>
                                                User > Dashboard
                                               </div>
                                            </a>

                                            <div class="dropdown-menu left" aria-labelledby="uniqueVisitors">
                                                <a class="dropdown-item" href="javascript:void(0);">View</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Update</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Download</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="widget-content">
                                    <div id="uniqueVisits"></div>
                                </div>
                            </div>
                        </div> -->

                        <!-- <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                            <div class="widget widget-activity-five">

                                <div class="widget-heading">
                                    <h5 class="">Activity Log</h5>

                                    <div class="task-action">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle" href="#" role="button" id="activitylog"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-more-horizontal">
                                                    <circle cx="12" cy="12" r="1"></circle>
                                                    <circle cx="19" cy="12" r="1"></circle>
                                                    <circle cx="5" cy="12" r="1"></circle>
                                                </svg>
                                            </a>

                                            <div class="dropdown-menu left" aria-labelledby="activitylog"
                                                style="will-change: transform;">
                                                <a class="dropdown-item" href="javascript:void(0);">View All</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Mark as Read</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="widget-content">

                                    <div class="w-shadow-top"></div>

                                    <div class="mt-container mx-auto">
                                        <div class="timeline-line">

                                            <div class="item-timeline timeline-new">
                                                <div class="t-dot">
                                                    <div class="t-secondary"><svg xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            class="feather feather-plus">
                                                            <line x1="12" y1="5" x2="12" y2="19"></line>
                                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                                        </svg></div>
                                                </div>
                                                <div class="t-content">
                                                    <div class="t-uppercontent">
                                                        <h5>New project created : <a
                                                                href="javscript:void(0);"><span>[Cork Admin]</span></a>
                                                        </h5>
                                                    </div>
                                                    <p>07 May, 2022</p>
                                                </div>
                                            </div>

                                            <div class="item-timeline timeline-new">
                                                <div class="t-dot">
                                                    <div class="t-success"><svg xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            class="feather feather-mail">
                                                            <path
                                                                d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                                            </path>
                                                            <polyline points="22,6 12,13 2,6"></polyline>
                                                        </svg></div>
                                                </div>
                                                <div class="t-content">
                                                    <div class="t-uppercontent">
                                                        <h5>Mail sent to <a href="javascript:void(0);">HR</a> and <a
                                                                href="javascript:void(0);">Admin</a></h5>
                                                    </div>
                                                    <p>06 May, 2022</p>
                                                </div>
                                            </div>

                                            <div class="item-timeline timeline-new">
                                                <div class="t-dot">
                                                    <div class="t-primary"><svg xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            class="feather feather-check">
                                                            <polyline points="20 6 9 17 4 12"></polyline>
                                                        </svg></div>
                                                </div>
                                                <div class="t-content">
                                                    <div class="t-uppercontent">
                                                        <h5>Server Logs Updated</h5>
                                                    </div>
                                                    <p>01 May, 2022</p>
                                                </div>
                                            </div>

                                            <div class="item-timeline timeline-new">
                                                <div class="t-dot">
                                                    <div class="t-danger"><svg xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            class="feather feather-check">
                                                            <polyline points="20 6 9 17 4 12"></polyline>
                                                        </svg></div>
                                                </div>
                                                <div class="t-content">
                                                    <div class="t-uppercontent">
                                                        <h5>Task Completed : <a href="javscript:void(0);"><span>[Backup
                                                                    Files EOD]</span></a></h5>
                                                    </div>
                                                    <p>30 Apr, 2022</p>
                                                </div>
                                            </div>

                                            <div class="item-timeline timeline-new">
                                                <div class="t-dot">
                                                    <div class="t-warning"><svg xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            class="feather feather-file">
                                                            <path
                                                                d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z">
                                                            </path>
                                                            <polyline points="13 2 13 9 20 9"></polyline>
                                                        </svg></div>
                                                </div>
                                                <div class="t-content">
                                                    <div class="t-uppercontent">
                                                        <h5>Documents Submitted from <a
                                                                href="javascript:void(0);">Sara</a></h5>
                                                        <span class=""></span>
                                                    </div>
                                                    <p>25 Apr, 2022</p>
                                                </div>
                                            </div>

                                            <div class="item-timeline timeline-new">
                                                <div class="t-dot">
                                                    <div class="t-dark"><svg xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            class="feather feather-server">
                                                            <rect x="2" y="2" width="20" height="8" rx="2" ry="2">
                                                            </rect>
                                                            <rect x="2" y="14" width="20" height="8" rx="2" ry="2">
                                                            </rect>
                                                            <line x1="6" y1="6" x2="6" y2="6"></line>
                                                            <line x1="6" y1="18" x2="6" y2="18"></line>
                                                        </svg></div>
                                                </div>
                                                <div class="t-content">
                                                    <div class="t-uppercontent">
                                                        <h5>Server rebooted successfully</h5>
                                                        <span class=""></span>
                                                    </div>
                                                    <p>10 Apr, 2022</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="w-shadow-bottom"></div>
                                </div>
                            </div>
                        </div> -->

                        <!-- <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                            <div class="widget-four">
                                <div class="widget-heading">
                                    <h5 class="">Visitors by Browser</h5>
                                </div>
                                <div class="widget-content">
                                    <div class="vistorsBrowser">
                                        <div class="browser-list">
                                            <div class="w-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-chrome">
                                                    <circle cx="12" cy="12" r="10"></circle>
                                                    <circle cx="12" cy="12" r="4"></circle>
                                                    <line x1="21.17" y1="8" x2="12" y2="8"></line>
                                                    <line x1="3.95" y1="6.06" x2="8.54" y2="14"></line>
                                                    <line x1="10.88" y1="21.94" x2="15.46" y2="14"></line>
                                                </svg>
                                            </div>
                                            <div class="w-browser-details">
                                                <div class="w-browser-info">
                                                    <h6>Chrome</h6>
                                                    <p class="browser-count">65%</p>
                                                </div>
                                                <div class="w-browser-stats">
                                                    <div class="progress">
                                                        <div class="progress-bar bg-gradient-primary" role="progressbar"
                                                            style="width: 65%" aria-valuenow="90" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="browser-list">
                                            <div class="w-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-compass">
                                                    <circle cx="12" cy="12" r="10"></circle>
                                                    <polygon
                                                        points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76">
                                                    </polygon>
                                                </svg>
                                            </div>
                                            <div class="w-browser-details">

                                                <div class="w-browser-info">
                                                    <h6>Safari</h6>
                                                    <p class="browser-count">25%</p>
                                                </div>

                                                <div class="w-browser-stats">
                                                    <div class="progress">
                                                        <div class="progress-bar bg-gradient-danger" role="progressbar"
                                                            style="width: 35%" aria-valuenow="65" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="browser-list">
                                            <div class="w-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-globe">
                                                    <circle cx="12" cy="12" r="10"></circle>
                                                    <line x1="2" y1="12" x2="22" y2="12"></line>
                                                    <path
                                                        d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="w-browser-details">

                                                <div class="w-browser-info">
                                                    <h6>Others</h6>
                                                    <p class="browser-count">15%</p>
                                                </div>

                                                <div class="w-browser-stats">
                                                    <div class="progress">
                                                        <div class="progress-bar bg-gradient-warning" role="progressbar"
                                                            style="width: 15%" aria-valuenow="15" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div> -->

                        <!-- <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="row widget-statistic">
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 layout-spacing">
                                    <div class="widget widget-one_hybrid widget-followers">
                                        <div class="widget-heading">
                                            <div class="w-title">
                                                <div class="w-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-users">
                                                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                                        <circle cx="9" cy="7" r="4"></circle>
                                                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                                    </svg>
                                                </div>
                                                <div class="">
                                                    <p class="w-value">31.6K</p>
                                                    <h5 class="">Followers</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="widget-content">
                                            <div class="w-chart">
                                                <div id="hybrid_followers"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 layout-spacing">
                                    <div class="widget widget-one_hybrid widget-referral">
                                        <div class="widget-heading">
                                            <div class="w-title">
                                                <div class="w-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-link">
                                                        <path
                                                            d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71">
                                                        </path>
                                                        <path
                                                            d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71">
                                                        </path>
                                                    </svg>
                                                </div>
                                                <div class="">
                                                    <p class="w-value">1,900</p>
                                                    <h5 class="">Referral</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="widget-content">
                                            <div class="w-chart">
                                                <div id="hybrid_followers1"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 layout-spacing">
                                    <div class="widget widget-one_hybrid widget-engagement">
                                        <div class="widget-heading">
                                            <div class="w-title">
                                                <div class="w-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-message-circle">
                                                        <path
                                                            d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z">
                                                        </path>
                                                    </svg>
                                                </div>
                                                <div class="">
                                                    <p class="w-value">18.2%</p>
                                                    <h5 class="">Engagement</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="widget-content">
                                            <div class="w-chart">
                                                <div id="hybrid_followers3"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                        <!-- <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                            <div class="widget widget-five">

                                <div class="widget-heading">

                                    <a href="javascript:void(0)" class="task-info">

                                        <div class="usr-avatar">
                                            <span>FD</span>
                                        </div>

                                        <div class="w-title">

                                            <h5>Figma Design</h5>
                                            <span>Design Project</span>

                                        </div>

                                    </a>

                                    <div class="task-action">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle" href="#" role="button" id="pendingTask"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-more-horizontal">
                                                    <circle cx="12" cy="12" r="1"></circle>
                                                    <circle cx="19" cy="12" r="1"></circle>
                                                    <circle cx="5" cy="12" r="1"></circle>
                                                </svg>
                                            </a>

                                            <div class="dropdown-menu left" aria-labelledby="pendingTask"
                                                style="will-change: transform;">
                                                <a class="dropdown-item" href="javascript:void(0);">View Project</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Edit Project</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Mark as Done</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>


                                <div class="widget-content">

                                    <p>Doloribus nisi vel suscipit modi, optio ex repudiandae voluptatibus officiis
                                        commodi.</p>

                                    <div class="progress-data">

                                        <div class="progress-info">
                                            <div class="task-count"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-check-square">
                                                    <polyline points="9 11 12 14 22 4"></polyline>
                                                    <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11">
                                                    </path>
                                                </svg>
                                                <p>5 Tasks</p>
                                            </div>
                                            <div class="progress-stats">
                                                <p>86.2%</p>
                                            </div>
                                        </div>

                                        <div class="progress">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 65%"
                                                aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>

                                    </div>

                                    <div class="meta-info">

                                        <div class="due-time">
                                            <p><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-clock">
                                                    <circle cx="12" cy="12" r="10"></circle>
                                                    <polyline points="12 6 12 12 16 14"></polyline>
                                                </svg> 3 Days Left</p>
                                        </div>


                                        <div class="avatar--group">

                                            <div class="avatar translateY-axis more-group">
                                                <span class="avatar-title">+6</span>
                                            </div>
                                            <div class="avatar translateY-axis">
                                                <img alt="avatar"
                                                    src="<?php echo url?>/src/assets/img/profile-8.jpeg" />
                                            </div>
                                            <div class="avatar translateY-axis">
                                                <img alt="avatar"
                                                    src="<?php echo url?>/src/assets/img/profile-12.jpeg" />
                                            </div>
                                            <div class="avatar translateY-axis">
                                                <img alt="avatar"
                                                    src="<?php echo url?>/src/assets/img/profile-19.jpeg" />
                                            </div>

                                        </div>

                                    </div>


                                </div>

                            </div>

                        </div> -->

                        <!-- <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                            <div class="widget widget-card-one">
                                <div class="widget-content">

                                    <div class="media">
                                        <div class="w-img">
                                            <img src="<?php echo url?>/src/assets/img/profile-19.jpeg" alt="avatar">
                                        </div>
                                        <div class="media-body">
                                            <h6>Jimmy Turner</h6>
                                            <p class="meta-date-time">Monday, May 18</p>
                                        </div>
                                    </div>

                                    <p>"Duis aute irure dolor" in reprehenderit in voluptate velit esse cillum "dolore
                                        eu fugiat" nulla pariatur. Excepteur sint occaecat cupidatat non proident.</p>

                                    <div class="w-action">
                                        <div class="card-like">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-thumbs-up">
                                                <path
                                                    d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3">
                                                </path>
                                            </svg>
                                            <span>551 Likes</span>
                                        </div>

                                        <div class="read-more">
                                            <a href="javascript:void(0);">Read More <svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-chevrons-right">
                                                    <polyline points="13 17 18 12 13 7"></polyline>
                                                    <polyline points="6 17 11 12 6 7"></polyline>
                                                </svg></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                        <!-- <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                            <div class="widget widget-card-two">
                                <div class="widget-content">

                                    <div class="media">
                                        <div class="w-img">
                                            <img src="<?php echo url?>/src/assets/img/g-8.png" alt="avatar">
                                        </div>
                                        <div class="media-body">
                                            <h6>Dev Summit - New York</h6>
                                            <p class="meta-date-time">Bronx, NY</p>
                                        </div>
                                    </div>

                                    <div class="card-bottom-section">
                                        <h5>4 Members Going</h5>
                                        <div class="img-group">
                                            <img src="<?php echo url?>/src/assets/img/profile-19.jpeg" alt="avatar">
                                            <img src="<?php echo url?>/src/assets/img/profile-6.jpeg" alt="avatar">
                                            <img src="<?php echo url?>/src/assets/img/profile-8.jpeg" alt="avatar">
                                            <img src="<?php echo url?>/src/assets/img/profile-3.jpeg" alt="avatar">
                                        </div>
                                        <a href="javascript:void(0);" class="btn">View Details</a>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                    </div>
                </div>
            </div>

            <?php include(dirname(__FILE__).'/components/foot.php'); ?>

        </div>
        <!--  END CONTENT AREA  -->

    </div>
    <!-- END MAIN CONTAINER -->

    <?php include(dirname(__FILE__).'/components/script.php'); ?>

    <script src="<?php echo url ?>/js/mail_campaign_dashboard.js"></script>
    <script src="<?php echo url ?>/js/libs/apexcharts.js"></script>


    <script src="<?php echo url ?>/js/libs/js.cookie.min.js"></script>
      <!-- Bootstrap tether Core JavaScript -->
      <script src="<?php echo url ?>/js/libs/popper.min.js"></script>
      <script src="<?php echo url ?>/js/libs/bootstrap.min.js"></script>
      <!--Menu sidebar -->
      <!-- <script src="<?php echo url ?>/js/libs/perfect-scrollbar.jquery.min.js"></script> -->
      <!--Custom JavaScript -->
      <script src="<?php echo url ?>/js/libs/custom.min.js"></script>
      <!-- this page js -->   
      <script src="<?php echo url ?>/js/common_scripts.js"></script>
      <!-- Employee List libraries -->
      <script src="https://www.virtuosoft.eu/code/bootstrap-duallistbox/bootstrap-duallistbox/v3.0.2/jquery.bootstrap-duallistbox.js"></script>
      <!-- Employee List libraries -->

      <script defer src="<?php echo url ?>/js/libs/sidebarmenu.js"></script>
      <script defer src="<?php echo url ?>/js/libs/jquery/datatables.js"></script> 
      <script defer src="<?php echo url ?>/js/libs/select2.min.js"></script>
      <script defer src="<?php echo url ?>/js/libs/moment.min.js"></script>
      <script defer src="<?php echo url ?>/js/libs/bootstrap-datetimepicker.min.js"></script>
      <script defer src="<?php echo url ?>/js/libs/moment.min.js"></script>
      <script defer src="<?php echo url ?>/js/libs/moment-timezone-with-data.min.js"></script>

      
      <script>
        loadEmpReportData();
        loadTableCampaignResultAccToWeek();
    </script>

</body>

</html>