<div class="modal" id="modal-form" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="modal-title" class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST">
            @csrf {{ method_field('POST') }}
              <div class="form-group">
                <input type="hidden" name="id" id="id">
                <label for="form-title">Title</label>
                <input type="text" class="form-control" id="form-title" name="form_title" placeholder="Title">
              </div>

               <div class="form-group">
                <label for="form-author">Author</label>
                <input type="text" class="form-control" id="form-author" name="form_author" placeholder="Author">
              </div>
             
              <div class="form-group">
                <label for="form-details">Details</label>
                <textarea class="form-control" id="form-details" name="form_details" rows="3"></textarea>
              </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button id="insert-button" type="submit" class="btn btn-primary"></button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<!--SIngle data show are here-->
<div class="modal fade" id="single-data" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="ModalLabel" align="center"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
 
      </div>
      <div class="modal-body">
        <ul class="list-group">
      <li class="list-group-item">ID: <span class="text-danger" id="contactid"></span></li>
      <li class="list-group-item">Title: <span class="text-danger" id="fullname"></span> </li>
      <li class="list-group-item">Author: <span class="text-danger" id="contactemail"></span></li>
      <li class="list-group-item">Details: <span class="text-danger" id="contactnumber"></span></li>
    </ul>
    </div>
  </div>
</div>