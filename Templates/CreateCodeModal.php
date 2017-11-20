<div class="modal fade" id="createCodeModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
				<h4 class="modal-title"><b>Create Discount Code</b></h4>
			</div>
				<div class="modal-body">
				<div class="form-group">
					<label for="exampleInputEmail1">Code</label>
					<input type="text" class="form-control" id="codename" value=""> </div>
					<div class="form-group">
					<label for="exampleInputEmail1">Amount</label>
					<input type="text" class="form-control" id="codeamount" value=""> </div>
				</div>
			<div class="modal-footer">
			<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			<button type="button" class="btn btn-success" onclick="createcode()">Create</button>
			</div>
		</div>
	</div>
</div>

<script>
function createcode(){
	var codename = $("#codename").val();
	var codeamount = $("#codeamount").val();
	if(codename && codeamount) {
		$.ajax({
			url:"/createcode?codename="+codename+"&codeamount="+codeamount,
			success:function(data){		
				try{
					data = JSON.parse(data);
					console.log(data);
					if(data.success){
						bootbox.alert("Success! You have created the code "+codename+" for "+codeamount+" credits.");					
					}else{
						bootbox.alert(data.error);
					}
				}catch(err){
					bootbox.alert("Javascript error: "+err);
				}
			},
			error:function(err){
				bootbox.alert("AJAX error: "+err);
			}
		});
	} else {
		bootbox.alert("Complete both fields!");
	}
}
</script>