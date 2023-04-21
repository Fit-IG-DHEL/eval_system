<?php
include '../db_connect.php';
if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM academic_list where id={$_GET['id']}")->fetch_array();
	foreach($qry as $k => $v){
		$$k = $v;
	}
}
?>
<div class="container-fluid">
	<form action="" id="manage-academic">
		<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
		<div id="msg" class="form-group"></div>
		
		<div class="form-group">
		<label for="year" class="control-label">Year:</label>
    <select  class="form-control form-control-sm" id="myYear" name="year" >
    
    </select>
	</div>
		<div class="form-group">
    <label for="semester" class="control-label">Semester</label>
    <select class="form-control form-control-sm" name="semester" id="semester" required>
        <option value="1" <?php if(isset($semester) && $semester == '1') echo 'selected'; ?>>Semester 1</option>
        <option value="2" <?php if(isset($semester) && $semester == '2') echo 'selected'; ?>>Semester 2</option>
		<option value="Summer" <?php if(isset($semester) && $semester == 'Summer') echo 'selected'; ?>>Summer</option>
    </select>
</div>
           
		<?php if(isset($status)): ?>
		<div class="form-group">
			<label for="" class="control-label">Status</label>
			<select name="status" id="status" class="form-control form-control-sm">
				<option value="0" <?php echo $status == 0 ? "selected" : "" ?>>Pending</option>
				<option value="1" <?php echo $status == 1 ? "selected" : "" ?>>Started</option>
				<option value="2" <?php echo $status == 2 ? "selected" : "" ?>>Closed</option>
			</select>
		</div>
		<a href="index.php?page=teacher_list">To Assign subjects click here!</a>

		<?php endif; ?>
	</form>
</div>
<script>
  if(typeof yearindatabse === 'undefined'){
	let yearindatabase = '';
}
	
	</script>
<?php echo isset($year) ? '<script> yearindatabse = "'.$year.'"</script>' : "<script> yearindatabse = ''</script>" ?>

<script>
	
	$(document).ready(function(){
		$('#manage-academic').submit(function(e){
			e.preventDefault();
			start_load()
			$('#msg').html('')
			$.ajax({

				url:'ajax.php?action=save_academic',
				method:'POST',
				data:$(this).serialize(),
				success:function(resp){
					if(resp == 1){

						alert_toast("Data successfully saved.","success");
						setTimeout(function(){
							location.reload()	
						},1750)
					}else if(resp == 2){
						$('#msg').html('<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Academic code already exist.</div>')
						end_load()
					}
				}
			})
		})

		function updateSchoolYear() {
      // Get the selected year from the input field
      let year = document.getElementById("myYear").value;
      
      // Update the input field to show the school year range
      let startYear = parseInt(year);
      let schoolYear = startYear + "-" + (startYear + 1);
      document.getElementById("myYear").value = schoolYear;
    }
 
	
    // Generate options for the next 10 school years
    for (let i = 0; i < 10; i++) {
      
      
      let startYear = (new Date().getFullYear() - 1) + i;
      let schoolYear = startYear + "-" + (startYear + 1);
	  let flag = false;
	  if(yearindatabse ==  schoolYear) {
		
		 flag = true;
	}
      let option = new Option(schoolYear, schoolYear,flag,flag);
      
    

      document.getElementById("myYear").add(option);
    }
    
    // Listen for the "change" event on the input field
    document.getElementById("myYear").addEventListener("change", updateSchoolYear);


	})

</script>