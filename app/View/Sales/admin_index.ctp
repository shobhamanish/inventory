<?php
	$pageCount = (isset($this->params['paging']['Sale']['pageCount']) and $this->params['paging']['Sale']['pageCount'])?$this->params['paging']['Sale']['pageCount']:0;
	if($pageCount > 10){ ?>
		<style>
			.dataTables_paginate > .active{
				background: #f1f2f7 none repeat scroll 0 0;
				border: 2px solid #ddd !important;
				padding: 5px 10px;
			}
		</style><?php
	} 
	
	$status = (isset($this->params['pass'][0]))?$this->params['pass'][0]:'';	
?>

<ol class="breadcrumb">
	<li class=""><?php echo $this->Html->link('Dashboard', array('admin'=>true, 'controller'=>'admins', 'action'=>'dashboard')); ?></li>
	<li class=""><?php echo $this->Html->link($title_for_layout, "javascript:void(0);"); ?></li>
</ol>

<div class="container-fluid">   
	<div data-widget-group="group1"> 
	
		<div class="col-lg-12 p-n">
			<div class="col-lg-4 p-n">
				<div class="pageheader">
					<h2><?php echo $title_for_layout; ?></h2>
				</div>
			</div> 
		</div> 
	 

		<div class="row margin_btm10">
			<div class="col-lg-12">
				<div class="btn-group btn-group-justified"><?php
					echo $this->Html->link('Add New', array('controller'=>'sales', 'action'=>'add'), array("class"=>"btn btn-default"));
					
					$cls = ($status=="")?"active":"";
					echo $this->Html->link($all .' All Orders', array('controller'=>'sales', 'action'=>'index'), array("class"=>"btn btn-default ". $cls)); 
					
					$cls = ($status==1)?"active":"";
					echo $this->Html->link($new .' New Orders', array('controller'=>'sales', 'action'=>'index', 1), array("class"=>"btn btn-default ". $cls));
					
					$cls = ($status==2)?"active":"";
					echo $this->Html->link($packed .' Packed', array('controller'=>'sales', 'action'=>'index', 2), array("class"=>"btn btn-default ". $cls));
					
					$cls = ($status==3)?"active":"";
					echo $this->Html->link($dispached .' Dispached', array('controller'=>'sales', 'action'=>'index', 3), array("class"=>"btn btn-default ". $cls));
					
					$cls = ($status==4)?"active":"";
					echo $this->Html->link($delivered .' Delivered', array('controller'=>'sales', 'action'=>'index', 4), array("class"=>"btn btn-default ". $cls));
					
					$cls = ($status==5)?"active":"";
					echo $this->Html->link($canceled .' Canceled', array('controller'=>'sales', 'action'=>'index', 5), array("class"=>"btn btn-default ". $cls));
					
					$cls = ($status==6)?"active":"";
					echo $this->Html->link($returned .' Returned', array('controller'=>'sales', 'action'=>'index', 6), array("class"=>"btn btn-default ". $cls));?>
				</div>
			</div> 
		</div>

		<div class="row">
			<div class="col-lg-12">
				<section class="panel">
					<div class="panel-heading">
						<h2>Search</h2>
						<div class="panel-ctrls" data-actions-container="" data-action-collapse='{"target": ".panel-body"}'></div>
						<div class="options"> </div>
					</div> 
					
					<div class="panel-body"><?php
						echo $this->Form->create('Sale', array(
							'url'=>array('controller'=>'sales', 'action'=>'index', $status), 
							'class'=>'form-inline', 'role'=>'form'
						)); 
						
							$keywords  = $this->Session->read('AdminSearch'); ?>
						
							<div class="form-group" style="width:30%;">
								<label class="sr-only" for="UserFirstName">Search Keyword</label><?php
								echo $this->Form->input('keyword', array('type'=>'text', 'placeholder'=>'Search Keyword', 'div'=>false, "class"=>"form-control", 'value'=>$keywords, 'label'=>false, 'style'=>'width:100%')); ?>
							</div>&nbsp;<?php
						
							echo $this->Form->submit("Search", array("class"=>"btn btn-info", 'div'=>false)); echo "&nbsp;";
							echo $this->Html->link('Show All', array('controller'=>'sales', 'action'=>'index'), array('escape'=>false, 'class'=>'btn btn-info'));
							
						echo $this->Form->end(); ?>
					</div>
				</section>
			</div>
		</div>

		<?php //echo $this->element('Admin/paging_counter'); ?>

		<div class="row">
			<div class="col-lg-12">
				<section class="panel">
				
					<div class="panel-heading">
						<h2><?php echo $title_for_layout; ?></h2>
						<div class="panel-ctrls" data-actions-container="" data-action-collapse='{"target": ".panel-body"}'></div>
						<div class="options"> </div>
					</div> <?php
						
					if($data){ 
						$asc_desc = isset($this->params['named']['direction'])?$this->params['named']['direction']:''; 
						$sort_by  = isset($this->params['named']['sort'])?$this->params['named']['sort']:''; 
						$sort_by  = ($sort_by)?explode('.', $sort_by):''; 
						$sort_by  = isset($sort_by[1])?$sort_by[1]:''; ?>
					
						<table class="table m-n">
							<thead>
								<tr>
									<th class="sorting<?php echo ($sort_by=='order_date')?'_'.$asc_desc:''; ?> "><span class="m7"><?php echo $this->ExPaginator->sort('Sale.order_date', 'Date'); ?> </span></th>
									<th class="sorting<?php echo ($sort_by=='order_no')?'_'.$asc_desc:''; ?> "><span class="m7"><?php echo $this->ExPaginator->sort('Sale.order_no', 'Sales Order#'); ?> </span></th>
									<th class="hidden-phone sorting<?php echo ($sort_by=='reference')?'_'.$asc_desc:''; ?>"><span class="m7"><?php echo $this->ExPaginator->sort('User.reference', 'Reference#'); ?> </span></th>
									<th class="sorting<?php echo ($sort_by=='first_name')?'_'.$asc_desc:''; ?>"><span class="m7"><?php echo $this->ExPaginator->sort('Sale.first_name', 'Customer Name'); ?> </span></th>
									<th class="sorting<?php echo ($sort_by=='status')?'_'.$asc_desc:''; ?>"><span class="m7"><?php echo $this->ExPaginator->sort('Sale.status', 'Status'); ?> </span></th>
									<?php /*<th class="sorting<?php echo ($sort_by=='total_amount')?'_'.$asc_desc:''; ?>"><span class="m7"><?php echo $this->ExPaginator->sort('Sale.total_amount', 'Amount'); ?> </span></th>*/ ?>
									<th class="actionW">Action</th>
								</tr>
							</thead>
							
							<tbody><?php
								foreach($data as $value){ ?>
									<tr>
										<td><?php echo $this->Html->link(date('M d, Y', strtotime($value['Sale']['order_date'])), array('controller'=>'sales', 'action'=>'view', $value['Sale']['id'])); ?></td>
										<td><?php echo $this->Html->link($value['Sale']['order_no'], array('controller'=>'sales', 'action'=>'view', $value['Sale']['id'])); ?></td>
										<td><?php echo $this->Html->link($value['Sale']['reference'], array('controller'=>'sales', 'action'=>'view', $value['Sale']['id'])); ?></td>
										<td class="hidden-phone"><?php echo $value['User']['first_name'] .' '. $value['User']['last_name']; ?></td> 
										<td><?php
											if($value['Sale']['status']==1){
												echo $this->Html->link(Configure::read('SalesStatus.' . $value['Sale']['status']), array('action'=>'status',$value['Sale']['id']), array('title'=>'Deactivate', 'style'=>'color:#539D00;'));
											}else{
												echo $this->Html->link(Configure::read('SalesStatus.' . $value['Sale']['status']), array('action'=>'status',$value['Sale']['id']), array('title'=>'Activate', 'style'=>'color:#FF3D28;'));
											} ?>
										</td>
										<?php /*<td class="hidden-phone">$<?php echo $value['Sale']['total_amount']; ?></td>*/ ?>
										<td>									
											<div class="btn-group">
												<button type="button" class="btn btn-default dropdown-toggle btn-sm" data-toggle="dropdown">Action <span class="caret"></span></button>
												<ul class="dropdown-menu dropdown-menu-new" role="menu">
													<li><?php echo $this->Html->link('<i class="fa fa-pencil"></i> Edit', array('controller'=>'sales', 'action'=>'edit', $value['Sale']['id']), array('escape'=>false)); ?></li>
													<li><?php echo $this->Html->link('<i class="fa fa-credit-card"></i> View Details', array('controller'=>'sales', 'action'=>'view', $value['Sale']['id']), array('escape'=>false)); ?></li>
													<?php /* <li><?php echo $this->Html->link('<i class="fa fa-trash-o"></i> Delete', "#myModal2_". $value['Sale']['id'], array('data-toggle'=>'modal', 'escape'=>false)); ?></li> */ ?>
												</ul>
											</div>
										</td>
									</tr>
									
									<div class="modal fade" id="myModal2_<?php echo $value['Sale']['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
													<h3 class="modal-title">Delete!!</h3>
												</div>
												<div class="modal-body">Are you sure, you want to delete this record?</div>
												<div class="modal-footer">
													<button data-dismiss="modal" class="btn btn-default" type="button">Close</button><?php
													echo $this->Html->link('Confirm', array('controller'=>'sales', 'action'=>'delete', $value['Sale']['id']), array('data-toggle'=>'modal', 'escape'=>false, 'class'=>'btn btn-warning')) ; ?>
												</div>
											</div>
										</div>
									</div><?php
								} ?>				  
							</tbody>
						</table><?php
						
						$this->Paginator->options(array('url' => $this->passedArgs));
						echo $this->element('Admin/admin_pagination', array("paging_model_name"=>"Sale", "total_title"=>"Sale Lists")); 
					}else{ ?>			
						<div class="row">
							<div class="col-lg-12">
								<div class="alert alert-danger fade in margin0">
									No Information for Display.
								</div>
							</div>
						</div><?php
					} ?>
				</section>
			</div>
		</div>
	</div>
</div>