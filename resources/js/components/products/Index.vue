<template>


<div class="product-list">

   <div class="container">
		<div class="row">
			<div class="col-12">
				<table class="table table-image">
				<thead>
					<tr>
					<th scope="col">No</th>
					<th scope="col">Image</th>
					<th scope="col">Product Name</th>
					<th scope="col">Category</th>
					<th scope="col">Date</th>
					<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th scope="row">1</th>
						<td class="w-25">
							<img src="https://s3.eu-central-1.amazonaws.com/bootstrapbaymisc/blog/24_days_bootstrap/sheep-3.jpg" class="img-fluid img-thumbnail" alt="Sheep">
						</td>
						<td>Product 1</td>
						<td>Women</td>
						<td>20-Dec-2022</td>
						<td>
							<div class="btn-group">
								<router-link to="/admin/edit-product"><button class="btn btn-primary">Edit</button></router-link>
								<router-link to="/admin/view-product"><button class="btn btn-info">View</button></router-link>
								<button class="btn btn-danger">Delete</button>
							</div>
						</td>
					</tr>
					
				</tbody>
				</table>   
			</div>
		</div>
	</div>
</div>
</template>
<script>

export default {
  name:'Index',

}


</script>