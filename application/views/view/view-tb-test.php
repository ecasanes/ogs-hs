<?php

	$id = $this->uri->segment(3);
	$edit_form = base_url('technical-bulletin/edit/'.$id);
	$cover_title = "Technical Bulletin";

?>

<section id="main-content">
	<div class="container">

		<div class="row hidden-print">
			<div class="col-xs-12">
				<div class="page-header">
					<div class="row">
						<div class="col-xs-3">
							<h1 class="content-title">Technical Bulletin</h1>
						</div>
						<div class="col-xs-9 text-right">
							<p class="btn btn-print">Page 1 of 1</p>
							<a href="<?php echo $edit_form.'/0'; ?>" class="btn btn-primary" data-toggle="tooltip" data-placement="left" title="Edit Technical Bulletin"><span class="glyphicon glyphicon-pencil"></span></a>
						</div>
					</div>
				</div>
			</div>
		</div>



		<div class="row">
			<div class="col-xs-12">
				<div class="page-header">
					<div class="row">
						<div class="col-xs-3">
							<h1 class="content-title visible-print">Technical Bulletin</h1>
						</div>
						<div class="col-xs-9 text-right">
							<p class="btn btn-print">Page 1 of 1</p>
							<a href="<?php echo $edit_form.'/0'; ?>" class="btn btn-primary" data-toggle="tooltip" data-placement="left" title="Edit Technical Bulletin"><span class="glyphicon glyphicon-pencil"></span></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="row-table table-responsive">
			<table class="table view-casefile">
				<tbody>
					<tr>
						<td class="table-label label-medium" colspan="4">Equipment Profile</td>
					</tr>
					<tr>
						<td class="table-label label-medium" colspan="2">1</td>
						<td class="table-label label-medium" colspan="2"></td>
					</tr>
					<tr>
						<td class="table-label label-medium" colspan="2">2</td>
						<td class="table-label label-medium" colspan="2"></td>
					</tr>
					<tr>
						<td class="table-label label-medium" colspan="2">3</td>
						<td class="table-label label-medium" colspan="2"></td>
					</tr>
					<tr>
						<td class="table-label label-medium" colspan="2">4</td>
						<td class="table-label label-medium" colspan="2"></td>
					</tr>
				
				</tbody>
			</table>
		</div>

		
		
	<div class="row">
		<div class="col-xs-12">

			<h4 class="content-title ">Purpose </h4>
			<p align="justify">
				The purpose of this bulletin is to share information about a turbine driven alternator 
				on Tiffany removed from service due to water ingress and salt deposit build up. In order 
				to prevent reoccurrence, similar equipment outage and reinstatement costs being incurred, 
				please communicate this to relevant persons onboard
			</p>

			<div class="pull-right tb-image">
				<p>
					1,2) Images showing similar pipe entering the compartment (yellow circle) and wear 
					on the sacrificial sleeve that has been fitted and magnified.
				</p>
				<img src="<?php echo base_url('images/tb-image-1.png'); ?>">
				<img src="<?php echo base_url('images/tb-image-2.png'); ?>" id="tb-image-2">
			</div>

		<h4 class="content-title ">Relevance  </h4>
		<p align="justify">
			This is of relevance to all power generation alternators and in particular those either 
			containing sea water as a coolant or are exposed to sea water ingress
		</p>
		</br>

		<h4 class="content-title ">Summary of Events and Findings  </h4>
		<p>
			After investigation, regarding the alternator failure two points worth consideration 
			were established prior to the alternator’s retirement for overhaul;
		</p>
		<ol>
			<li>Pinhole leak had resulted in failure of alternator</li>
			<li>Pinhole leak had resulted in failure of alternator</li>
		</ol>
		</br>

		<h4 class="content-title ">Alternator Failure</h4>
		<p align="justify">
			Small bore piping feeding the coolers above the turbine package had failed with 
			small pinhole leak. This was caused by friction between the turbine compartment 
			(stainless steel sheet) and the pipe (stainless steel small bore). Subsequently 
			resulting in sea water build up within the compartment, this evaporated and 
			resulted in a buildup of crystalised salt coating on pipework, valves, controls 
			and the internal windings which has ultimately resulted in the removal of the 
			alternator from the platform
		</p>
		</br>

		<h4 class="content-title ">Surrounding Area </h4>
		<p align="justify">
			The area surrounding the turbines had repeat instances of sea water (SW) 
			cooling leaks resulting from failing cunifer pipework. This also resulted in 
			a portion of the compartment being exposed to sea water. Although this was 
			restricted to the externals, the situation contributed to the acceptance of 
			sea water pooling in and around the GTAs. 
		</p>
		<p align="justify">
			There is fittings (untagged) indicating possible housings for sacrificial anodes 
			within the cunifer piping however this is unconfirmed at this time.  
		</p>
		</br>

		<h4 class="content-title ">Recommendations </h4>
		<p align="justify">
			Please take the necessary actions to ensure this will not be 
			repeated on your asset by completing the following recommendations.
		</p>
		<ol>
			<li>
				Survey all pipework entering the turbine package for signs of;
				<ol type="a">
					<li>Leakage </li>
					<li>Friction</li>
				</ol>
			</li>
			<li>
				Where pipes come into contact with the compartment walls ensure 
				there is a sacrificial sleeve fitted in place, intact and secured.
			</li>
			<li>
				Ensure the turbine packages are inspected on a daily routine by
				 an operators or electrician or other responsible party.
			</li>
			<li>
				If there is water within the turbine packages it must be
				 removed and the compartment dried until all moisture is removed.
			</li>
			<li>
				If there is evidence of possible sacrificial anodes being fitted 
				please notify the Integrity Engineer on board and the author/ focal 
				point for this bulletin. 
			</li>
		</ol>
		</br>

		<h4 class="content-title ">Next Steps </h4>
		<p align="justify">
			Please revert back to the author or the designated Mechanical Technical 
			Authority with details of any similar findings with particular emphasis 
			on possible sacrificial anodes to enable a full understanding of these points. 
		</p>

		</div>
	</div>

		<div class="row">
				<div class="col-sm-12">
					<div class="row">
						<div class="col-sm-4">
							<img src="<?php echo base_url('images/tb-image-3.png'); ?>" id="tb-image-2">
							<p id="tb-image-3">
								3) Possible fitting for sacrificial anode on turbine package lube oil filter outlet. (Red Circle)
							</p>
						</div>
						<div class="col-sm-4">
							<img src="<?php echo base_url('images/tb-image-4.png'); ?>" id="tb-image-2">
							<p id="tb-image-3">
								4) Possible fitting for sacrificial anode on turbine package lube oil filter inlet. (Red Circle)
							</p>
						</div>
						<div class="col-sm-4">
							<img src="<?php echo base_url('images/tb-image-5.png'); ?>" id="tb-image-2">
							<p id="tb-image-3">
								5) Images showing a sample of salt deposit in turbine package.
							</p>
						</div>
					</div>
				</div>
		</div>

	</div>

</section>