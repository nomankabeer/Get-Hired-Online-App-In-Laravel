<div id="experience" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
       <form method="post" action="?saf">
           <input name="title" required placeholder="Title" class="uk-input uk-search-input">
           <div class="js-upload" uk-form-custom>
               <input type="file" multiple>
               <button class="uk-button uk-button-primary" type="button" tabindex="-1">Select Image</button>
           </div>
           <button type="submit" class="uk-button uk-button-primary">Update Profile</button>
       </form>
    </div>
</div>