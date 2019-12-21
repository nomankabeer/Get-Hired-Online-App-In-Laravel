<div id="update-profile" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
       <form method="post" action="{{route('freelancer.update.title.and.profile.image')}}" enctype="multipart/form-data">
           @csrf
           <input name="first_name" required value="{{Auth::user()->userDetail->first_name}}" placeholder="First Name" class="uk-input uk-search-input">
           <input name="last_name" required value="{{Auth::user()->userDetail->last_name}}" placeholder="Last Name" class="uk-input uk-search-input">
           <input name="title" required value="{{Auth::user()->userDetail->title}}" placeholder="Title" class="uk-input uk-search-input">
           <div class="js-upload" uk-form-custom>
               <input type="file" name="image" multiple>
               <button class="uk-button uk-button-primary" type="button" tabindex="-1">Select Image</button>
           </div>
           <button type="submit" class="uk-button uk-button-primary">Update Profile</button>
       </form>
    </div>
</div>