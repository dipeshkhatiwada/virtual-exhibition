<button class="tutorial" type="button" data-toggle="modal" data-target="#tutorialModal"><i class="fas fa-video"></i> How to Apply</button>
<div class="modal fade bd-example-modal-lg" id="tutorialModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      
      <div class="modal-body">
          <div class="col-12" style="position: relative;padding-bottom: 56.25%; padding-top: 25px;height: 0;">
 <iframe id="cartoonVideo" src="https://www.youtube.com/embed/wiIyJvHtELE?autoplay=1" frameborder="0" style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;"></iframe>
</div>
      </div>
     
    </div>
  </div>
</div>
<script>
$(document).ready(function(){
    /* Get iframe src attribute value i.e. YouTube video url
    and store it in a variable */
    var url = $("#cartoonVideo").attr('src');
    
    /* Remove iframe src attribute on page load to
    prevent autoplay in background */
    $("#cartoonVideo").attr('src', '');
  
  /* Assign the initially stored url back to the iframe src
    attribute when modal is displayed */
    $("#tutorialModal").on('shown.bs.modal', function(){
        $("#cartoonVideo").attr('src', url);
    });
    
    /* Assign empty url value to the iframe src attribute when
    modal hide, which stop the video playing */
    $("#tutorialModal").on('hide.bs.modal', function(){
        $("#cartoonVideo").attr('src', '');
    });
});
</script>