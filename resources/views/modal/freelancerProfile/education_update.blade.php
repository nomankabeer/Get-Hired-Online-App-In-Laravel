<div id="education_update" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
       <form method="post" id="education_update_form" action="{{route('freelancer.update.education')}}" >
           @csrf
           @method('PUT')
           <input name="id" type="hidden">
           <input name="degree_title" required placeholder="Title" class="uk-input uk-search-input">
           <input type="date" name="start_date" required placeholder="Start Date" class="uk-input uk-search-input">
           <input type="date" name="end_date" required placeholder="End Date" class="uk-input uk-search-input">
           <textarea name="description" required placeholder="Description" class="uk-input uk-search-input"></textarea>
           <button type="submit" class="uk-button uk-button-primary">Add Education</button>
       </form>
    </div>
</div>
@push('script')
    <script>
        function edit_data(htmlid){
            var id = $('#'+htmlid).attr('edit_record_id');
            var degree_title = $('#'+htmlid).attr('degree_title');
            var start_date = $('#'+htmlid).attr('start_date');
            var end_date = $('#'+htmlid).attr('end_date');
            var description = $('#'+htmlid).attr('description');
            $('input[name="id"]').val(id);
            $('input[name="degree_title"]').val(degree_title);
            $('input[name="start_date"]').val(start_date);
            $('input[name="end_date"]').val(end_date);
            $('textarea[name="description"]').text(description);
        }
    </script>
@endpush