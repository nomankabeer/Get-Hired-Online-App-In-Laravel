<div id="education" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
       <form method="post" action="{{route('freelancer.add.education')}}">
           @csrf
           <input name="degree_title" required placeholder="Title" class="uk-input uk-search-input">
           <input type="date" name="start_date" required placeholder="Start Date" class="uk-input uk-search-input">
           <input type="date" name="end_date" required placeholder="End Date" class="uk-input uk-search-input">
           <textarea name="description" required placeholder="Description" class="uk-input uk-search-input"></textarea>

           <button type="submit" class="uk-button uk-button-primary">Add Education</button>
       </form>
    </div>
</div>