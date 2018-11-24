<!DOCTYPE html>
<html>
<head>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<style type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"></style>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

	<title>AJAX CRUD</title>
</head>
<body>

	<div class="container">
		<br><br>
		<a onclick="addForm()" class="btn btn-sm btn-danger" style="float: right;">Add New</a>
		<table id="post-table" class="table table-bordered">
			<thead>
				<tr>
					<th width="30">ID</th>
					<th>Title</th>
					<th>Author</th>
					<th>Details</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				
			</tbody>
		</table>
	</div>






	@include('form')


	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

	<script>
		var table1 = $('#post-table').DataTable({
			processing: true,
			serverSide: true,
			ajax: "{{ route('all-post') }}",
			columns: [
				{data:'id', name:'id'},
				{data:'title', name:'title'},
				{data:'author', name:'author'},
				{data:'details', name:'details'},
				{data:'action', name:'action',orderable: false, searchable: false}
			]
		});

		function addForm()
		{
			save_method = "add";
			$('input[name=_method]').val('POST');
			$('#modal-form').modal('show');
			$('#modal-form form')[0].reset();
			$('#modal-title').text('Add Post');
			$('#insert-button').text('Add Post');
		}

		//INSERT DATA BY AJAX
		$(function(){
			$('#modal-form').on('submit',function(e)
			{
				if(!e.isDefaultPrevented()){
					var id = $('#id').val();
					if(save_method == 'add') url = "{{ url('/post') }}";
					else url = "{{ url('/post') . '/'  }}" + id;
					$.ajax({
						url : url,
						type : "POST",
						data : new FormData($("#modal-form form")[0]),
						contentType: false,
						processData: false,
						success : function(data)
						{
							$('#modal-form').modal('hide');
							table1.ajax.reload();
							swal({
								title: "Good job!",
								text: "Data inserted successfully!",
								icon: "success",
								button: "Great!",
							});
						},
						error : function(data)
						{
							swal({
								title: "Oops...",
								text: data.message,
								type: 'error',
								timer: '1500'
							});
						},
					});
					return false;
				}
			});
		});

		 //edit ajax request are here
         function editForm(id) {
         save_method = 'edit';
          $('input[name=_method]').val('PATCH');
          $('#modal-form form')[0].reset();
          $.ajax({
            url: "{{ url('/post') }}" + '/' + id + "/edit",
            type: "GET",
            dataType: "JSON",
            success: function(data) {
              $('#modal-form').modal('show');
              $('#modal-title').text('Edit Post');
              $('#insert-button').text('Update Post');
              $('#id').val(data.id);
              $('#form-title').val(data.title);
              $('#form-author').val(data.author);
              $('#form-details').val(data.details);
            },
            error : function() {
                alert("Nothing Data");
            }
          });
        } 

        //show single data ajax part here
       function showData(id) {
          $.ajax({
              url: "{{ url('post') }}" + '/' + id,
              type: "GET",
              dataType: "JSON",
            success: function(data) {
              $('#single-data').modal('show');
              $('#ModalLabel').text('Details');
              $('#contactid').text(data.id); 
              $('#fullname').text(data.title);
              $('#contactemail').text(data.author);
              $('#contactnumber').text(data.details);
            },
            error : function() {
                alert("Ghorar DIm");
            }
          });
        }

        //DELETE DATA BY AJAX
        function deleteData(id){
          var csrf_token = $('meta[name="csrf-token"]').attr('content');
          swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              $.ajax({
                  url : "{{ url('post') }}" + '/' + id,
                  type : "POST",
                  data : {'_method' : 'DELETE', '_token' : csrf_token},
                  success : function(data) {
                      table1.ajax.reload();
                      swal({
                        title: "Delete Done!",
                        text: "You clicked the button!",
                        icon: "success",
                        button: "Done",
                      });
                  },
                  error : function () {
                      swal({
                          title: 'Oops...',
                          text: data.message,
                          type: 'error',
                          timer: '1500'
                      })
                  }
              });
            } else {
              swal("Your imaginary file is safe!");
            }
          });
        }

	</script>
</body>
</html>