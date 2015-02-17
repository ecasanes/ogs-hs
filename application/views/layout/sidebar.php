<?php
    $base_url = base_url();
?>
<aside id="sidebar" class="sidebar sidebar-default">

<div id="integrity_logo" style="background: white; margin-top: -5px; height: 12em;"> 
    
    <?php if(($controller == 'criticality-analysis' && $method == 'critical-equipment' ) || ($controller == 'action-tracker') || ($controller == 'criticality-analysis' && $method == 'scoring') || 
             ($controller == 'criticality-analysis' && $method == 'stage')) { ?>
        <img id="sidebar-logo" src="<?php echo base_url('theme/assets/img/cnr.png'); ?>" class="img-responsive" >
    <?php } else { ?>
        <img id="sidebar-logo" src="<?php echo base_url('theme/assets/img/logo1.png'); ?>" class="img-responsive" >
    <?php } ?>
</div>
    <div class="sidebar-profile">

        <a href="<?php echo base_url('user/my-account'); ?>">
            <img class="img-circle profile-image border-black" src="<?php echo $user_photo_url; ?>">
        </a>
        

        <div class="profile-body">
            <h5 id="no-of-followers"></h5>
            <div class="sidebar-user-links">
                <a class="btn btn-link btn-xs" href="<?php echo base_url('user/my-account'); ?>" data-placement="bottom" data-toggle="tooltip" data-original-title="My Account"><i class="fa pe-7s-user fa-lg"></i></a>
                <a class="btn btn-link btn-xs" href="<?php echo base_url('user/notifications'); ?>" data-placement="bottom" data-toggle="tooltip" data-original-title="Notifications"><i class="fa pe-7s-bell fa-lg"></i></a>
                <a class="btn btn-link btn-xs" href="<?php echo base_url('user/settings'); ?>"  data-placement="bottom" data-toggle="tooltip" data-original-title="Settings"><i class="fa pe-7s-config fa-lg"></i></a>
                <a class="btn btn-link btn-xs" href="<?php echo base_url('document/recent-document'); ?>" data-placement="bottom" data-toggle="tooltip" data-original-title="Recent Documents"><i class="fa fa-lg fa-fw fa-files-o"></i></a>
                <a class="btn btn-link btn-xs" href="<?php echo base_url('user/logout'); ?>" data-placement="bottom" data-toggle="tooltip" data-original-title="Logout"><i class="fa pe-7s-power fa-lg"></i></a>
            </div>
        </div>
    </div>
    <nav>
        <!-- <h5 class="sidebar-header">Navigation</h5> -->
        <ul class="nav nav-pills nav-stacked">
            <li <?php if($controller == 'user' && $method == 'start-activity'): ?> class="active" <?php endif; ?>>
                <a href="<?php echo $base_url; ?>">
                    <i class="fa fa-lg fa-fw fa-home"></i> Home
                </a>
            </li>
            <li class="nav-dropdown">
                <a class="dropdown-link" href="#" title="Reliability and Maintenance">
                    <i class="fa fa-lg fa-fw fa-wrench"></i> Reliability &amp; Maintenance
                </a>
                <ul class="nav-sub">
                    <li <?php if($controller == 'technical-bulletin'): ?> class="active" <?php endif; ?> >
                        <a href="<?php echo base_url('technical-bulletin/create'); ?>" title="Technical Bulletin" class="create-document" data-title="Technical Bulletin" data-name="Doc Title" data-document-type="technical-bulletin">
                            <!-- <i class="fa fa-fw fa-thumb-tack"></i> -->Technical Bulletin
                        </a>
                    </li>
                    <li <?php if($controller == 'technical-query'): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo base_url('technical-query/create'); ?>" class="create-document" data-title="Technical Query" data-name="Doc Title" data-document-type="technical-query">
                            <!-- <i class="fa fa-fw fa-undo"></i> --> Technical Query
                        </a>
                    </li>
                    <li <?php if($controller == 'ofi'): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo base_url('ofi/create'); ?>" title="Oppurtunity for Improvement" class="create-document" data-title="Opportunity for Improvement" data-name="Name" data-document-type="ofi">
                            <!-- <i class="fa fa-fw fa-road"></i> --> Opportunity for Improvement
                        </a>
                    </li>
                    <li <?php if($controller == 'basic-decf'): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo base_url('basic-decf/create'); ?>" title="Defect Elimination" class="create-document" data-title="Defect Elimination" data-name="Casefile Name" data-document-type="basic-decf">
                            <!-- <i class="fa fa-fw fa-file-text"></i> --> Defect Elimination
                        </a>
                    </li>
                    <li <?php if($controller == 'project-plan'): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo base_url('project-plan/create'); ?>" title="Project Work Pack" class="create-document" data-title="Project Work Pack" data-name="Project Name" data-document-type="project-plan">
                            <!-- <i class="fa fa-fw fa-flag"></i> --> Project Work Pack
                        </a>
                    </li>
                    <li <?php if($controller == 'reliability-maintenance' && $method == 'project-tracker'): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo base_url('reliability-maintenance/project-tracker'); ?>" title="Witness Statement">
                            <!-- <i class="fa fa-fw fa-eye"></i> --> Project Tracker
                        </a>
                    </li>
                    <li <?php if($controller == 'weekly-plan'): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo base_url('weekly-plan'); ?>" title="Weekly Plan">
                            <!-- <i class="fa fa-fw fa-calendar"></i> --> Weekly Plan
                        </a>
                    </li>
                    <li <?php if($controller == 'reliability-maintenance' && $method == 'condition-monitoring'): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo base_url('reliability-maintenance/condition-monitoring'); ?>" title="Condition Monitoring">
                            <!-- <i class="fa fa-fw fa-refresh"></i> --> Condition Monitoring
                        </a>
                    </li>
                    <li <?php if($controller == 'criticality-analysis' && $method == 'history-availability'): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo base_url('criticality-analysis/history-availability'); ?>" title="History Availability Report">
                            <!-- <i class="fa fa-fw fa-hdd-o"></i> --> History Availability Report
                        </a>
                    </li>
                </ul>
            </li>
            <li <?php if($controller == 'witness-statement'): ?> class="active" <?php endif; ?>>
                <a href="<?php echo base_url('witness-statement/create'); ?>" title="Witness Statement" class="create-document" data-title="Witness Statement" data-name="Name" data-document-type="witness-statement">
                    <i class="fa fa-lg fa-fw fa-eye"></i> Witness Statement
                </a>
            </li>
            <li class="nav-dropdown">
                <a class="dropdown-link" href="#" title="Quality Management">
                    <i class="fa fa-lg fa-fw fa-bookmark"></i> Quality Management
                </a>
                <ul class="nav-sub">
                    <li <?php if($method == 'criticality-criteria'): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo base_url('criticality-analysis/criticality-criteria'); ?>" title="Criticality Criteria">
                            <!-- <i class="fa fa-fw fa-bookmark"></i> --> Criticality Criteria
                        </a>
                    </li>
                    <li <?php if($controller == 'criticality-analysis' && $method == ''): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo base_url('criticality-analysis'); ?>" title="Profile">
                            <!-- <i class="fa fa-fw fa-bullhorn"></i> --> Criticality Analysis
                        </a>
                    </li>
                    <li <?php if($method == 'spare-analysis'): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo base_url('criticality-analysis/spare-analysis'); ?>" title="Spare Analysis">
                            <!-- <i class="fa fa-fw fa-cog"></i> --> Spare Analysis
                        </a>
                    </li>
                    <li <?php if($method == 'handover-report'): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo base_url('report/handover-report'); ?>" title="Handover Report">
                            <!-- <i class="fa fa-fw fa-list-alt"></i> --> Department Handover Report
                        </a>
                    </li>
                    <li <?php if($controller == 'quality-management' && $method == 'performance-report'): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo base_url('quality-management/performance-report'); ?>" title="Performance Report">
                            <!-- <i class="fa fa-fw fa-signal"></i> --> Performance Report
                        </a>
                    </li>
                    <li <?php if($controller == 'quality-management' && $method == 'non-compliance-report'): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo base_url('quality-management/non-compliance-report'); ?>" title="Non Compliance Report">
                            <!-- <i class="fa fa-fw fa-lock"></i> --> Non Compliance Report
                        </a>
                    </li>
                    <li <?php if($controller == 'quality-management' && $method == 'temporary-equipment'): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo base_url('quality-management/temporary-equipment'); ?>" title="Temporary Equipment">
                            Temporary Equipment
                        </a>
                    </li>
                    <li <?php if($controller == 'quality-management' && $method == 'audit-report'): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo base_url('quality-management/audit-report'); ?>" title="Audit Report">
                            Audit Report
                        </a>
                    </li>
                    <li <?php if($controller == 'quality-management' && $method == 'master-data'): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo base_url('quality-management/master-data'); ?>" title="Master Data">
                            <!-- <i class="fa fa-fw fa-flag"></i> --> Master Data
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-dropdown">
                <a class="dropdown-link" href="#" title="Performance Dashboard">
                    <i class="fa fa-lg fa-fw fa-signal"></i> Performance Dashboard
                </a>
                <ul class="nav-sub">
                    <li <?php if($controller == 'performance-dashboard' && $method == 'current-availability'): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo base_url('performance-dashboard/current-availability'); ?>" title="Availability">
                            <!-- <i class="glyphicon glyphicon-stats"></i> --> Current Availability
                        </a>
                    </li>
                    <li <?php if($controller == 'criticality-analysis' && $method == 'compliance-dashboard'): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo base_url('criticality-analysis/compliance-dashboard'); ?>" title="Compliance">
                            <!-- <i class="fa fa-fw fa-thumbs-up"></i> --> Compliance
                        </a>
                    </li>
                    <li <?php if($controller == 'criticality-analysis' && $method == 'data-input'): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo base_url('criticality-analysis/data-input'); ?>" title="Equipment Status Update">
                            <!-- <i class="fa fa-fw fa-refresh"></i> --> Equipment Status Update
                        </a>
                    </li>
                    <li <?php if($controller == 'criticality-analysis' && $method == 'single-index-of-failing-equipment'): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo base_url('criticality-analysis/single-index-of-failing-equipment'); ?>" title="Single Index of Failing Equipment">
                            <!-- <i class="fa fa-fw fa-exclamation-circle"></i> --> Single Index of Failing Equipment
                        </a>
                    </li>
                    <li <?php if($controller == 'action-tracker' && $method == ''): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo base_url('action-tracker'); ?>" title="Hub">
                            <!-- <i class="fa fa-fw fa-exclamation-circle"></i> --> Hub
                        </a>
                    </li>
                    <li <?php if($controller == 'criticality-analysis' && $method == 'failure-rate'): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo base_url('criticality-analysis/failure-rate'); ?>" title="Failure Rate">
                            <!-- <i class="fa fa-fw fa-exclamation-triangle"></i> --> Failure Rate
                        </a>
                    </li>
                    <li <?php if($controller == 'performance-dashboard' && $method == 'my-actions'): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo base_url('performance-dashboard/my-actions'); ?>" title="My Actions">
                            <!-- <i class="fa fa-fw fa-wrench"></i> --> My Actions
                        </a>
                    </li>
                    <li <?php if($controller == 'performance-dashboard' && $method == 'mcdr-register'): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo base_url('performance-dashboard/mcdr-register'); ?>" title="MCDR Register">
                            <!-- <i class="fa fa-fw fa-random"></i> --> MCDR Register
                        </a>
                    </li>
                    <li <?php if($controller == 'performance-dashboard' && $method == 'risk-register'): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo base_url('performance-dashboard/risk-register'); ?>" title="Risk Register">
                            <!-- <i class="fa fa-fw fa-random"></i> --> Risk Register
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-dropdown">
                <a class="dropdown-link" href="#" title="Integrity Management">
                    <i class="fa fa-lg fa-fw fa-cubes"></i> Integrity Management
                </a>
                <ul class="nav-sub">
                    <li <?php if($controller == 'integrity-management' && $method == 'fgas-register'): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo base_url('integrity-management/fgas-register'); ?>" title="Refrigerated Equipment">
                             F-Gas Register
                        </a>
                    </li>
                    <li <?php if($controller == 'integrity-management' && $method == 'rats'): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo base_url('integrity-management/rats'); ?>" title="Register of Alarms, Trips & Set Points">
                             RATS
                        </a>
                    </li>
                    <li <?php if($controller == 'integrity-management' && $method == 'esd-psd'): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo base_url('integrity-management/esd-psd'); ?>" title="ESD/PSD Values">
                             ESD/PSD Vaues
                        </a>
                    </li>
                    <li <?php if($controller == 'integrity-management' && $method == 'fire-dampers'): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo base_url('integrity-management/fire-dampers'); ?>" title="Fire Dampers">
                             Fire Dampers
                        </a>
                    </li>
                    <li <?php if($controller == 'integrity-management' && $method == 'critical-drainage'): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo base_url('integrity-management/critical-drainage'); ?>" title="Critical Drainage">
                             Critical Drainage
                        </a>
                    </li>
                    <li <?php if($controller == 'integrity-management' && $method == 'mcdr'): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo base_url('integrity-management/mcdr'); ?>" title="MCDR">
                             MCDR Dashboard
                        </a>
                    </li>
                    <li <?php if($controller == 'integrity-management' && $method == 'temporary-repair-register'): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo base_url('integrity-management/temporary-repair-register'); ?>" title="Temporary Repair Register">
                             Temporary Repair Register
                        </a>
                    </li>
                    <li <?php if($controller == 'integrity-management' && $method == 'temporary-refuge-and-loss-control'): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo base_url('integrity-management/temporary-refuge-and-loss-control'); ?>" title="Temporary Refuge & Loss Control">
                             Temporary Refuge &amp; Loss Control
                        </a>
                    </li>
                    <li <?php if($controller == 'integrity-management' && $method == 'psv'): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo base_url('integrity-management/psv'); ?>" title="PSV and Pressure Vessels">
                             PSV and Pressure Vessels
                        </a>
                    </li>
                    <li <?php if($controller == 'integrity-management' && $method == 'certification'): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo base_url('integrity-management/certification'); ?>" title="Certification">
                             Certification
                        </a>
                    </li>
                    <li <?php if($controller == 'integrity-management' && $method == 'flexible-hoses'): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo base_url('integrity-management/flexible-hoses'); ?>" title="Flexible Hoses">
                             Flexible hoses
                        </a>
                    </li>
                    <li <?php if($controller == 'integrity-management' && $method == 'atex'): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo base_url('integrity-management/atex'); ?>" title="ATEX">
                             ATEX
                        </a>
                    </li>
                    <li <?php if($controller == 'integrity-management' && $method == 'remedial-action-register'): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo base_url('integrity-management/remedial-action-register'); ?>" title="Remedial Action Register">
                             Remedial Action Register
                        </a>
                    </li>
                    <li <?php if($controller == 'integrity-management' && $method == 'management-of-change'): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo base_url('integrity-management/management-of-change'); ?>" title="Management of Change">
                             Management of Change
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-dropdown">
                <a class="dropdown-link" href="#" title="Criticality Analysis">
                    <i class="fa fa-lg fa-fw fa-clipboard "></i> Criticality Analysis
                </a>
                <ul class="nav-sub">
                    <li <?php if($controller == 'criticality-analysis' && $method == 'critical-equipment'): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo base_url('criticality-analysis/critical-equipment'); ?>" title="Refrigerated Equipment">
                             Critical Equipment 
                        </a>
                    </li>
                    <li <?php if($controller == 'criticality-analysis' && $method == 'criticality-analysis-stage'): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo base_url('criticality-analysis/stage'); ?>" title="Register of Alarms, Trips & Set Points">
                             Criticality Analysis
                        </a>
                    </li>
                </ul>
            </li>
            <?php if($role == 'siteadmin'): ?>
                <li class="nav-dropdown">
                    <a class="dropdown-link" href="#" title="Admin">
                        <i class="fa fa-lg fa-fw fa-desktop"></i> Admin
                        <!-- <span class="label label-success pull-right">Hot</span> -->
                    </a>
                    <ul class="nav-sub">
                        <li class="<?php if($controller == 'menu-admin'){ ?> active <?php } ?>">
                            <a href="<?php echo base_url('menu-admin'); ?>" title="Menu">
                                <i class="fa fa-fw fa-cogs"></i> Menu Admin
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('menu-category-admin'); ?>" title="Menu Category">
                                <i class="fa fa-fw fa-list-alt"></i> Menu Category
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('menu-subcategory-admin'); ?>" title="Menu Subcategory">
                                <i class="fa fa-fw fa-cog"></i> Menu Sub Category
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('menu-deep-subcategory-admin'); ?>" title="Menu Deep Subcategory">
                                <i class="fa fa-fw fa-chain"></i> Menu Deep Category
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('user/admin'); ?>" title="User">
                                <i class="fa fa-fw fa-user"></i> User Admin
                            </a>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>
            <?php if($role == 'siteadmin'): ?>
            <li class="nav-dropdown">
                    <a class="dropdown-link" href="#" title="Inspection Type">
                        <i class="fa fa-lg fa-fw fa-desktop"></i> Inspection Type
                        <!-- <span class="label label-success pull-right">Hot</span> -->
                    </a>
                    <ul class="nav-sub">
                        <li <?php if($controller == 'integrity-management' && $method == 'gip'): ?> class="active" <?php endif; ?>>
                            <a href="<?php echo base_url('integrity-management/gip'); ?>" title="Menu">
                                <i class="fa fa-fw fa-cogs"></i> General Inspection Report
                            </a>
                        </li>
                        <li <?php if($controller == 'integrity-management' && $method == 'eci'): ?> class="active" <?php endif; ?>>
                            <a href="<?php echo base_url('integrity-management/eci'); ?>" title="Menu Category">
                                <i class="fa fa-fw fa-list-alt"></i> Eddy Current Inspection Report
                            </a>
                        </li>
                        <li <?php if($controller == 'integrity-management' && $method == 'dpi'): ?> class="active" <?php endif; ?>>
                            <a href="<?php echo base_url('integrity-management/dpi'); ?>" title="Menu Subcategory">
                                <i class="fa fa-fw fa-cog"></i> Dye Penetrant Inspection Report
                            </a>
                        </li>
                        <li <?php if($controller == 'integrity-management' && $method == 'mpi'): ?> class="active" <?php endif; ?>>
                            <a href="<?php echo base_url('integrity-management/mpi'); ?>" title="Menu Deep Subcategory">
                                <i class="fa fa-fw fa-chain"></i> Magnetic Particle Inspection Report
                            </a>
                        </li>
                        <li <?php if($controller == 'integrity-management' && $method == 'ut'): ?> class="active" <?php endif; ?>>
                            <a href="<?php echo base_url('integrity-management/ut'); ?>" title="User">
                                <i class="fa fa-fw fa-user"></i> Ultrasonic Inspection Report
                            </a>
                        </li>
                    </ul>
                </li>
                <?php endif; ?>
        </ul>
    </nav>

    
</aside>