<div id="form-box" class="modal fade" tabindex="-1" data-width="400" style="display: none;">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">Comment & Tag</h4>
  </div>
  <div class="modal-body">
    <div class="row">
  <form role="form" id="data-form" method="" action="">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Enter name">
     </div>
    
    <div class="form-group">
        <label for="comment">Comment</label>
        <textarea class="form-control" name="comment" id="comment" rows="3" placeholder="Enter comment"></textarea>
      </div>
    <div class="form-group">
      <label for="tag">Tag(s)</label>
      <input type="text" name="tag" class="form-control" id="tag" data-url="{{ route('tags.getlist') }}" placeholder="Enter tags">
    </div>
    </div>
  </form>
  <div class="modal-footer">
    <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
    <button type="button" data-dismiss="modal" class="btn btn-primary" id="store-comment-tags" data-image-id="" data-url="{{ route('store.comment.tags') }}">Create</button>
  </div>
</div>