
<form>
  <div class="form-group">
    <label for="feedback">User Feedback</label>
    <br>
   <input type="number" name="rating" placeholder="Rating">
   <br>
    <br>
    <textarea class="form-control" id="example" rows="3" name="feedback" placeholder="Enter your feedback"></textarea>
    <br>
    
  	
  </div>

</form>

<a href="<?php echo base_url(); ?>">
  <button class="btn btn-primary" value="submit">Submit</button>
</a>