<div id="about-me" class="uk-modal-container" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <form method="post" action="{{route('freelancer.update.about_me')}}">
            @csrf
        <textarea class="content" name="about">{{Auth::user()->userDetail->about_me}}</textarea>
        <button type="submit" class="uk-button uk-button-primary">Update Profile</button>
        </form>
    </div>
</div>